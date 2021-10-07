<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        </div>
        <div class="row" v-if="$gate.can('show employees')">
            <div class="card mx-auto">
                <div v-if="showMessage" class="alert alert-success">
                    {{ message }}
                </div>

                <div class="card-header">
                    <form class="d-inline" @submit.prevent="getEmployees()" v-if="$gate.can('search employees')">
                        <div class="input-group rounded w-50 float-left">
                            <input
                                type="search"
                                name="search"
                                class="form-control rounded "
                                placeholder="Search"
                                aria-label="Search"
                                aria-describedby="search-addon"
                                v-model="search"
                            />
                            <select
                                name="search"
                                class="form-control rounded "
                                aria-describedby="search-addon"
                                v-model="selectedDepartment"
                            >
                                <option value="" disabled selected
                                    >Please choose a department</option
                                >
                                <option
                                    v-for="department in departments"
                                    :key="department.id"
                                    :value="department.id"
                                    >{{ department.name }}</option
                                >
                            </select>
                            <button
                                type="submit"
                                style="outline: none;border: none"
                            >
                                <span
                                    class="input-group-text border-0"
                                    id="search-addon"
                                >
                                    <i class="fas fa-search"></i>
                                </span>
                            </button>
                        </div>
                    </form>
                    <router-link
                        :to="{ name: 'EmployeesCreate' }"
                        class="float-right btn btn-primary"
                        v-if="$gate.can('create employee')"
                        >Create</router-link
                    >
                </div>

                <div class="card-body">
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Middle Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Department</th>
                                <th scope="col">Address</th>
                                <th scope="col">Country</th>
                                <th scope="col">State</th>
                                <th scope="col">City</th>
                                <th scope="col">Zip Code</th>
                                <th scope="col">Birth date</th>
                                <th scope="col">Date Hired</th>
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody v-if="employees">
                            <tr
                                v-for="employee in employees"
                                :key="employee.id"
                            >
                                <td scope="row">
                                    {{ employees.indexOf(employee) + 1 }}
                                </td>
                                <td scope="row">{{ employee.first_name }}</td>
                                <td scope="row">{{ employee.middle_name }}</td>
                                <td scope="row">{{ employee.last_name }}</td>
                                <td scope="row">
                                    {{ employee.department_id }}
                                </td>
                                <td scope="row">{{ employee.address }}</td>
                                <td scope="row">{{ employee.country_id }}</td>
                                <td scope="row">{{ employee.state_id }}</td>
                                <td scope="row">{{ employee.city_id }}</td>
                                <td scope="row">{{ employee.zip_code }}</td>
                                <td scope="row">{{ employee.birth_date }}</td>
                                <td scope="row">{{ employee.date_hired }}</td>
                                <td>
                                    <router-link
                                        :to="{
                                            name: 'EmployeesEdit',
                                            params: { id: employee.id }
                                        }"
                                        class="btn btn-primary"
                                        v-if="$gate.can('edit employee')"
                                        >Edit</router-link
                                    >

                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        data-toggle="modal"
                                        data-target="#DeleteModal"
                                        @click="insertDeleteId(employee.id)"
                                        v-if="$gate.can('delete employee')"
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modal -->
            <div
                class="modal fade"
                id="DeleteModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Are you sure you want to delete this Employee?
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal_body">
                            <form @submit.prevent="deleteEmployee()">
                                <input type="hidden" id="id" name="id" />

                                <input
                                    type="submit"
                                    class="btn btn-danger w-25 btn-block mx-auto"
                                    value="Yes ,Delete!"
                                />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end modal -->
    </div>
    <!-- end row -->
</template>

<script>
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            message: "",
            departments: [],
            search: null,
            selectedDepartment: null
        };
    },

    created() {
        this.getEmployees();
        this.getDepartments();
    },
        watch : {
            search(){
                this.getEmployees();
            },
            selectedDepartment(){
                this.getEmployees();
            }
        },
    methods: {
        getEmployees() {
            axios
                .get("/api/employees" , {
                    params :{
                        search : this.search ,
                        department_id : this.selectedDepartment
                    }
                })
                .then(res => {
                    if (res.status == 200) {
                        this.employees = res.data;
                    }
                })
                .catch(err => console.error(err));
        },
        getDepartments() {
            axios
                .get(`/api/employee/getDepartments`)
                .then(res => {
                    if (res.status == 200) {
                        this.departments = res.data;
                    }
                })
                .catch(err => console.error(err));
        },

        insertDeleteId(id) {
            document.getElementById("id").value = id;
        },

        deleteEmployee() {
            axios
                .delete(
                    `/api/employee/${
                        document.getElementById("id").value
                    }/delete`
                )
                .then(res => {
                    if (res.status == 200) {
                        this.showMessage = true;
                        this.message = res.data;
                    }
                })
                .catch(err => console.error(err));

            $("#DeleteModal").modal("hide");
            this.getEmployees();
        },


    }
};
</script>

<style></style>
