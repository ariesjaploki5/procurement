import axios from 'axios';

const state = {
  modes: []
};

const getters = {
  modes(state) {
            return state.modes;
        }
};

const actions = {
    get_modes(context) {
        axios.get('../api/modes')
        .then(({data}) => {
            context.commit('set_modes', data);
        })
    }
};

const mutations = {
    set_modes(state, payload) {
        state.modes = payload;
    }
};

export default {
  state,
  getters,
  actions,
  mutations
};