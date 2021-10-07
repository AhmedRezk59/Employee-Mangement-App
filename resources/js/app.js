
require('./bootstrap');

window.Vue = require('vue').default;

import VueRouter from 'vue-router'


import router from './routes';

Vue.use(VueRouter);

import Gate from './gate'
import Vue from 'vue';

Vue.prototype.$gate = new Gate(window.user)


const app = new Vue({
    el: '#app',
    router: router
});
