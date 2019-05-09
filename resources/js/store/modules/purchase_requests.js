import axios from 'axios';

const state = {
  purchase_requests: []
};

const getters = {
  purchase_requests(state) {
            return state.purchase_requests;
        }
};

const actions = {
    get_purchase_requests(context) {
        axios.get('../api/purchase_requests')
        .then(({data}) => {
            context.commit('set_purchase_requests', data);
        })
    }
};

const mutations = {
    set_purchase_requests(state, payload) {
        state.purchase_requests = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};