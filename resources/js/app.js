require('./bootstrap');
window.Vue = require('vue');

import App from './App.vue';

import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import VueSweetalert2 from 'vue-sweetalert2';
import VueTheMask from 'vue-the-mask';

import 'epic-spinners/dist/lib/epic-spinners.min.css'
import 'sweetalert2/dist/sweetalert2.min.css';

import {routes} from './routes';
import Loading from "./components/layout/Loading"

Vue.use(VueRouter);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2);
Vue.use(VueTheMask);

Vue.component("loading-overlay", Loading)

Vue.filter('documentBr', (documentId) => {
  documentId = typeof documentId != 'string' ? documentId.toString() : documentId;
  if (documentId.length == 14) {
    documentId = documentId.padStart(14, '0');
    documentId = documentId.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
  } else {
    documentId = documentId.padStart(11, '0');
    documentId = documentId.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
  }
  return documentId;
})

const router = new VueRouter({
  mode: 'history',
  routes: routes
});

let app = new Vue({
  el: '#app',
  router: router,
  render: h => h(App),
});