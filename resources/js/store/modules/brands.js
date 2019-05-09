import axios from 'axios';

const state = {
  brands: []
};

const getters = {
  brands(state) {
            return state.brands;
        }
};

const actions = {
    get_brands(context) {
        axios.get('../api/brands')
        .then(({data}) => {
            context.commit('set_brands', data);
        })
    }
};

const mutations = {
    set_brands(state, payload) {
        state.brands = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};