import axios from 'axios'

export const bar = {
  getBars () {
    return axios.get('/api/bars')
      .then(res => res.data)
  }
}
