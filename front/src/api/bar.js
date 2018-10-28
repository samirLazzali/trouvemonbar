import axios from 'axios'

export const bar = {
  getBars () {
    return axios.get('/api/bars/')
      .then(res => res.data)
  },
  getBar (id) {
    return axios.get('/api/bars/' + id)
      .then(res => res.data)
  }
}
