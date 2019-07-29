
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';

import { Form, HasError, AlertError } from 'vform';
import accounting from 'accounting-js';
import appvue from './app.vue';
import moment from 'moment';
import numeral from 'numeral';
import converter from 'number-to-words';
import Swal from 'sweetalert2';
import VueProgressBar from 'vue-progressbar';

window.Swal = Swal;

import {routes} from './routes.js';
import StoreData from './store.js';
import {initialize} from './store/helpers/general';

window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
Vue.use(VueRouter);
Vue.use(Vuex);

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
window.toast = toast;

Vue.filter('upText', function(text){return text.charAt(0).toUpperCase() + text.slice(1);});

Vue.filter('time1', function(val){return moment(val).format('LT');});
Vue.filter('date1', function(val){return moment(val).format('l');});
Vue.filter('myDate', function(val){return moment(val).format('YYYY - MM');});
Vue.filter('myDate2', function(val){return moment(val).format("YYYY - M");});
Vue.filter('myDate3', function(val){return moment(val).format("MMMM D, YYYY");});
Vue.filter('myDate4', function(val){return moment(val).format('L');});
Vue.filter('myDate5', function(val){return moment(val).format('LTS');});

Vue.filter('numeral1', function(val){return numeral(val).format('000');});
Vue.filter('numeral2', function(val){return numeral(val).format('0000');});
Vue.filter('numeral3', function(val){return numeral(val).format('0,0');});

Vue.filter('num_words', function(val){return converter.toWords(val);});

Vue.filter('currency', function(val){return accounting.formatMoney(val, {symbol: '',});});
Vue.filter('currency2', function(val){return accounting.formatMoney(val, {symbol: '₱ ',decimals: 2,});});
Vue.filter('decimal_to_whole', function(val){return accounting.formatMoney(val, {symbol: '',precision: 0,});});

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '5px'
});

let Fire = new Vue();

window.Fire = Fire;

const store = new Vuex.Store(StoreData);

const router = new VueRouter({
    routes,
    mode: 'history',
});

initialize(store, router);

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        appvue
    }
});

