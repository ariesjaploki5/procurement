import axios from 'axios';

const state = {
  suppliers: []
};

const getters = {
  suppliers(state) {
            return state.suppliers;
        }
};

const actions = {
    get_suppliers(context) {
        axios.get('../api/suppliers')
        .then(({data}) => {
            context.commit('set_suppliers', data);
        })
    }
};

const mutations = {
    set_suppliers(state, payload) {
        state.suppliers = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};