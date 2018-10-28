import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

const token = localStorage.getItem('user-token')
if (token) axios.defaults.headers.common['Authorization'] = token

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    user: JSON.parse(localStorage.getItem('user')),
    keywords: null
  },

  getters: {
    isAuthenticated: state => !!state.user
  },

  mutations: {
    user (state, user) {
      state.user = user
    },
    keywords (state, keywords) {
      state.keywords = keywords
    }
  },

  actions: {
    login ({ commit }, user) {
      return new Promise((resolve, reject) => {
        axios.post('/api/login', user)
          .then(res => {
            const token = res.headers.authorization
            localStorage.setItem('user-token', token)
            localStorage.setItem('user', JSON.stringify(res.data))
            commit('user', res.data)
            axios.defaults.headers.common['Authorization'] = token
            resolve()
          })
          .catch(err => {
            localStorage.removeItem('user-token')
            localStorage.removeItem('user')
            reject(err)
          })
      })
    },

    logout ({ commit }) {
      commit('user', null)
      localStorage.removeItem('user-token')
      localStorage.removeItem('user')
      delete axios.defaults.headers.common['Authorization']
    },

    keywords ({ commit, state }) {
      if (state.keywords) return

      return new Promise((resolve, reject) => {
        axios.get('/api/keywords')
          .then(res => {
            commit('keywords', res.data)
            resolve()
          })
          .catch(reject)
      })
    }
  }
})
