import axios from 'axios';

const state = {
  categories: []
};

const getters = {
  categories(state) {
            return state.categories;
        }
};

const actions = {
    get_categories(context) {
        axios.get('../api/categories')
        .then(({data}) => {
            context.commit('set_categories', data);
        })
    }
};

const mutations = {
    set_categories(state, payload) {
        state.categories = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};