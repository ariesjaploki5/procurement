import { get_local_user } from "./store/helpers/auth";
import axios from 'axios';

const user = get_local_user();

export default {
    state: {
        current_user: user,
        isLoggedIn: !!user,
        modes: {},
        categories: {},
        price_schedules: {},
        item_price_schedules: {},
        suppliers: {},
        manufacturers: {},
        brands: {},
        packagings: {},
        countries: {},
        apps: {},
        units: {},
        users: {},
        fund_source_codes: {},
    },
    getters: {
        isLoading(state) {
            return state.loading;
        },
        isLoggedIn(state) {
            return state.isLoggedIn;
        },
        current_user(state) {
            return state.current_user;
        },
        categories(state){
            return state.categories;
        },
        modes(state){
            return state.modes;
        },
        price_schedules(state){
            return state.price_schedules;
        },
        suppliers(state){
            return state.suppliers;
        },
        brands(state){
            return state.brands;
        },
        packagings(state){
            return state.packagings;
        },
        manufacturers(state){
            return state.manufacturers;
        },
        countries(state){
            return state.countries;
        },
        apps(state){
            return state.apps;
        },
        units(state){
            return state.units;
        },
        users(state){
            return state.users;
        },
        fund_source_codes(state){
            return state.fund_source_codes;
        },
    },
    mutations: {
        login(state) {
            state.loading = true;
            state.auth_error = null;
        },
        loginSuccess(state, payload) {
            state.auth_error = null;
            state.isLoggedIn = true;
            state.loading = false;
            state.current_user = Object.assign({}, payload.user, {
                token: payload.access_token
            });

            localStorage.setItem("user", JSON.stringify(state.current_user));
        },
        loginFailed(state, payload) {
            state.loading = false;
            state.auth_error = payload.error;
        },
        logout(state) {
            localStorage.removeItem("user");
            state.isLoggedIn = false;
            state.current_user = null;
        },
        set_categories(state, payload){
            state.categories = payload;
        },
        set_modes(state, payload){
            state.modes = payload;
        },
        set_price_schedules(state, payload){
            state.price_schedules = payload;
        },
        set_item_price_schedules(state, payload){
            state.price_schedules = payload;
        },
        set_suppliers(state, payload){
            state.suppliers = payload;
        },
        set_brands(state, payload){
            state.brands = payload;
        },
        set_packagings(state, payload){
            state.packagings = payload;
        },
        set_manufacturers(state, payload){
            state.manufacturers = payload;
        },
        set_countries(state, payload){
            state.countries = payload;
        },
        set_apps(state, payload){
            state.apps = payload;
        },
        set_units(state, payload){
            state.units = payload;
        },
        set_users(state, payload){
            state.users = payload;
        },
        set_fund_source_codes(state, payload){
            state.fund_source_codes = payload;
        },
    },
    actions: {
        login(context) {
            context.commit("login");
        },
        get_categories(context){
            axios.get('../../api/category').then(({data}) => {
                context.commit('set_categories', data);
            })
        },
        get_modes(context){
            axios.get('../../api/mode').then(({data}) => {
                context.commit('set_modes', data);
            })
        },
        get_price_schedules(context){
            axios.get('../../api/price_schedule').then(({data}) => {
                context.commit('set_price_schedules', data);
            })
        },
        get_suppliers(context){
            axios.get('../../api/supplier').then(({data}) => {
                context.commit('set_suppliers', data);
            })
        },
        get_brands(context){
            axios.get('../../api/brand').then(({data}) => {
                context.commit('set_brands', data);
            })
        },
        get_packagings(context){
            axios.get('../../api/packaging').then(({data}) => {
                context.commit('set_packagings', data);
            })
        },
        get_manufacturers(context){
            axios.get('../../api/manufacturer').then(({data}) => {
                context.commit('set_manufacturers', data);
            })
        },
        get_countries(context){
            axios.get('../../api/country').then(({data}) => {
                context.commit('set_countries', data);
            })
        },
        get_apps(context){
            axios.get('../../api/app').then(({data}) => {
                context.commit('set_apps', data);
            })
        },
        get_units(context){
            axios.get('../../api/unit').then(({data}) => {
                context.commit('set_units', data);
            })
        },
        get_users(context){
            axios.get('../../api/user').then(({data}) => {
                context.commit('set_users', data);
            })
        },
        get_fund_source_codes(context){
            axios.get('../../api/fund_source_code').then(({data}) => {
                context.commit('set_fund_source_codes', data);
            })
        },
    }
};