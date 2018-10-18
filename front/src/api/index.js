import axios from 'axios'

export default {
  install (Vue) {
    Vue.prototype.$api = {
      async getUsers () {
        return axios.get('/api/users')
          .then(res => res.data)
      }
    }
  }
}
