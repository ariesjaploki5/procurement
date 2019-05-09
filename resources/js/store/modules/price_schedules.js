import axios from 'axios';

const state = {
  price_schedules: []
};

const getters = {
  price_schedules(state) {
            return state.price_schedules;
        }
};

const actions = {
    get_price_schedules(context) {
        axios.get('../api/price_schedules')
        .then(({data}) => {
            context.commit('set_price_schedules', data);
        })
    }
};

const mutations = {
    set_price_schedules(state, payload) {
        state.price_schedules = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};