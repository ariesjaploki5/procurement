import axios from 'axios';

const state = {
  manufacturers: []
};

const getters = {
  manufacturers(state) {
            return state.manufacturers;
        }
};

const actions = {
    get_manufacturers(context) {
        axios.get('../api/manufacturers')
        .then(({data}) => {
            context.commit('set_manufacturers', data);
        })
    }
};

const mutations = {
    set_manufacturers(state, payload) {
        state.manufacturers = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};