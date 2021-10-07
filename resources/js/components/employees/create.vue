<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
        </div>
        <div class="row">
            <div class="card mx-auto">
                <div class="card-header">
                    Create New Employee

                    <router-link
                        :to="{ name: 'EmployeesIndex' }"
                        class="float-right btn btn-primary"
                        >Back</router-link
                    >
                </div>

                <div class="card-body" style="width: 700px">
                    <form @submit.prevent="storeEmployee()">
                        <div class="form-group row">
                            <label
                                for="first_name"
                                class="col-md-4 col-form-label text-md-right"
                                >Fisrt Name</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="first_name"
                                    type="text"
                                    class="form-control "
                                    name="first_name"
                                    value=""
                                    placeholder="Please Enter the First Name"
                                    required
                                    autocomplete="first_name"
                                    autofocus
                                    v-model="form.first_name"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="middle_name"
                                class="col-md-4 col-form-label text-md-right"
                                >Middle Name</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="middle_name"
                                    type="text"
                                    class="form-control "
                                    name="middle_name"
                                    value=""
                                    placeholder="Please Enter the Middle Name"
                                    required
                                    autocomplete="middle_name"
                                    autofocus
                                    v-model="form.middle_name"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="last_name"
                                class="col-md-4 col-form-label text-md-right"
                                >Last Name</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="last_name"
                                    type="text"
                                    class="form-control "
                                    name="last_name"
                                    value=""
                                    placeholder="Please Enter the Last Name"
                                    required
                                    autocomplete="last_name"
                                    autofocus
                                    v-model="form.last_name"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="address"
                                class="col-md-4 col-form-label text-md-right"
                                >Address</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="address"
                                    type="text"
                                    class="form-control "
                                    name="address"
                                    value=""
                                    placeholder="Please Enter the Address"
                                    required
                                    autocomplete="address"
                                    autofocus
                                    v-model="form.address"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="department_id"
                                class="col-md-4 col-form-label text-md-right"
                                >Department</label
                            >

                            <div class="col-md-6">
                                <select
                                    id="department_id"
                                    class="form-control"
                                    name="department_id"
                                    required
                                    autocomplete="department_id"
                                    autofocus
                                    v-model="form.department_id"
                                >
                                    <option value="" disabled
                                        >Choose a Department</option
                                    >
                                    <option
                                        v-for="department in departments"
                                        :key="department.id"
                                        :value="department.id"
                                        >{{ department.name }}</option
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="country_id"
                                class="col-md-4 col-form-label text-md-right"
                                >Country Code</label
                            >

                            <div class="col-md-6">
                                <select
                                    id="country_id"
                                    class="form-control"
                                    name="country_id"
                                    required
                                    autocomplete="country_id"
                                    autofocus
                                    v-model="form.country_id"
                                    @change="getStates()"
                                >
                                    <option value="" disabled
                                        >Choose a Country</option
                                    >
                                    <option
                                        v-for="country in countries"
                                        :key="country.id"
                                        :value="country.id"
                                        >{{ country.country_code }}</option
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="state_id"
                                class="col-md-4 col-form-label text-md-right"
                                >State</label
                            >

                            <div class="col-md-6">
                                <select
                                    id="state_id"
                                    class="form-control"
                                    name="state_id"
                                    required
                                    autocomplete="state_id"
                                    autofocus
                                    v-model="form.state_id"
                                    @change="getCities()"
                                >
                                    <option value="" disabled
                                        >Choose a State</option
                                    >
                                    <option
                                        v-for="state in states"
                                        :key="state.id"
                                        :value="state.id"
                                        >{{ state.name }}</option
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="city_id"
                                class="col-md-4 col-form-label text-md-right"
                                >City</label
                            >

                            <div class="col-md-6">
                                <select
                                    id="city_id"
                                    class="form-control"
                                    name="city_id"
                                    required
                                    autocomplete="city_id"
                                    autofocus
                                    v-model="form.city_id"
                                >
                                    <option value="" disabled
                                        >Choose a City</option
                                    >
                                    <option
                                        v-for="city in cities"
                                        :key="city.id"
                                        :value="city.id"
                                        >{{ city.name }}</option
                                    >
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="zip_code"
                                class="col-md-4 col-form-label text-md-right"
                                >Zip Code</label
                            >

                            <div class="col-md-6">
                                <input
                                    id="zip_code"
                                    class="form-control"
                                    name="zip_code"
                                    type="text"
                                    placeholder="Please Enter the Zip Code"
                                    required
                                    autocomplete="zip_code"
                                    autofocus
                                    v-model="form.zip_code"
                                />
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="birth_date"
                                class="col-md-4 col-form-label text-md-right"
                                >Birth date</label
                            >
                            <div class="col-md-6">
                                <Datepicker
                                    v-model="form.birth_date"
                                    input-class="form-control"
                                ></Datepicker>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label
                                for="date_hired"
                                class="col-md-4 col-form-label text-md-right"
                                >Date hired</label
                            >

                            <div class="col-md-6">
                                <Datepicker
                                    v-model="form.date_hired"
                                    input-class="form-control"
                                ></Datepicker>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Employee
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";
export default {
    components: {
        Datepicker
    },

    data() {
        return {
            countries: [],
            states: [],
            cities: [],
            departments: [],
            form: {
                first_name: "",
                middle_name: "",
                last_name: "",
                address: "",
                department_id: "",
                country_id: "",
                state_id: "",
                city_id: "",
                zip_code: "",
                birth_date: null,
                date_hired: null
            }
        };
    },
    created() {
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        getCountries() {
            axios
                .get("/api/employee/getCountries")
                .then(res => {
                    if (res.status == 200) {
                        this.countries = res.data;
                    }
                })
                .catch(err => console.error(err));
        },

        getStates() {
            let country = this.form.country_id;

            axios
                .get(`/api/employee/${country}/getStates`)
                .then(res => {
                    if (res.status == 200) {
                        this.states = res.data;
                    }
                })
                .catch(err => console.error(err));
        },

        getCities() {
            let country = this.form.country_id;
            let state = this.form.state_id;

            axios
                .get(`/api/employee/${country}/${state}/getCities`)
                .then(res => {
                    if (res.status == 200) {
                        this.cities = res.data;
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

        storeEmployee() {
            axios
                .post("/api/employee/store", {
                    first_name: this.form.first_name,
                    last_name: this.form.last_name,
                    middle_name: this.form.middle_name,
                    address: this.form.address,
                    department_id: this.form.department_id,
                    country_id: this.form.country_id,
                    state_id: this.form.state_id,
                    city_id: this.form.city_id,
                    zip_code: this.form.zip_code,
                    birth_date: this.format_date(this.form.birth_date),
                    date_hired: this.format_date(this.form.date_hired)
                })
                .then(res => {
                    if (res.status == 201) {
                        this.$router.push({
                            name: "EmployeesIndex",
                            
                        });
                    }
                })
                .catch(err => console.error(err));
        },

        format_date(value) {
            if (value) {
                return moment(String(value)).format("YYYYMMDD");
            }
        }
    }
};
</script>

<style></style>
