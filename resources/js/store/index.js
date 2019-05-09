

import Vue from 'vue';
import Vuex from 'vuex';

import brands from './modules/brands';
import categories from './modules/categories';
import login from './modules/login';
import manufacturers from './modules/manufacturers';
import modes from './modules/modes';

import price_schedules from './modules/price_schedules';
import purchase_orders from './modules/purchase_orders';
import purchase_requests from './modules/purchase_requests';


import suppliers from './modules/suppliers';
import users from './modules/users';

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({

  modules: {
    brands,
    categories,

    login,
    manufacturers,
    modes,

    price_schedules,
    purchase_orders,
    purchase_requests,
    suppliers,
    users,

    
  }
});