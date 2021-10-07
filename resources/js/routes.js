import VueRouter from 'vue-router'

import employeeIndex from "./components/employees/index"
import employeeCreate from "./components/employees/create"
import employeeEdit from "./components/employees/edit"


const routes = [

    {
        path: '/employees',
        name: 'EmployeesIndex',
        component: employeeIndex,
        
    },

    {
        path: '/employees/create',
        name: 'EmployeesCreate',
        component: employeeCreate
    },

    {
        path: '/employees/:id',
        name: 'EmployeesEdit',
        component: employeeEdit
    },
];

export default new VueRouter({
    mode: 'history',
    routes,
})