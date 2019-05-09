import axios from 'axios';

const state = {
  users: []
};

const getters = {
  users(state) {
            return state.users;
        }
};

const actions = {
    get_users(context) {
        axios.get('../api/users')
        .then(({data}) => {
            context.commit('set_users', data);
        })
    }
};

const mutations = {
    set_users(state, payload) {
        state.users = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};