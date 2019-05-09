
import { get_local_user } from "./helpers/auth";
const user = get_local_user();

const state = {
    current_user: user,
    isLoggedIn: !!user,
};

const getters = {
    isLoading(state) {
        return state.loading;
    },
    isLoggedIn(state) {
        return state.isLoggedIn;
    },
    current_user(state) {
        return state.current_user;
    },
};

const actions = {
    login(context) {
        context.commit("login");
    },
};

const mutations = {
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
};

export default {
  state,
  getters,
  actions,
  mutations
};