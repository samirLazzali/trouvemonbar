import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    keywords: [],
    bars: []
  },

  mutations: {
    KEYWORDS: (state, data) => {
      console.log(data)
      state.keywords = data
    },
    SEARCH_RESULT: (state, data) => {
      console.log(data)
      state.bars = data
    }
  },

  actions: {
    SEARCH_REQUEST: ({ commit }, keywords) => {
      commit('KEYWORDS', keywords)

      return new Promise((resolve) => {
        setTimeout(resolve, 1000, commit('SEARCH_RESULT', [
          {
            id: 1,
            name: 'La Frange',
            address: '1 rue'
          },
          {
            id: 2,
            name: 'PMU',
            address: '1 rue'
          },
          {
            id: 3,
            name: 'Tmux',
            address: '1 rue'
          }
        ]))
      })
    }
  }
})

export { store }
