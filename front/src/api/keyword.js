import axios from 'axios'

export const keyword = {
  getKeywords () {
    return axios.get('/api/keywords')
      .then(res => res.data)
  }
}
