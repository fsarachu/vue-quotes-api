import Vue from 'vue';
import VueRouter from 'vue-router';
import Axios from 'axios';

window.Vue = Vue;

Vue.use(VueRouter);

window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';