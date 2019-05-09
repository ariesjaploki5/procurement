import axios from 'axios';

const state = {
  purchase_orders: []
};

const getters = {
  purchase_orders(state) {
            return state.purchase_orders;
        }
};

const actions = {
    get_purchase_orders(context) {
        axios.get('../api/purchase_orders')
        .then(({data}) => {
            context.commit('set_purchase_orders', data);
        })
    }
};

const mutations = {
    set_purchase_orders(state, payload) {
        state.purchase_orders = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};