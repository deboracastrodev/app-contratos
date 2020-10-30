require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import VueTheMask from 'vue-the-mask';

import 'sweetalert2/dist/sweetalert2.min.css';
import {routes} from './routes';

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);
Vue.use(VueTheMask);

const router = new VueRouter({
  mode: 'history',
  routes: routes
});

let app = new Vue({
  el: '#app',
  router: router,
  render: h => h(App),
});