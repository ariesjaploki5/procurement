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
        }

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
        }

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

    }
};