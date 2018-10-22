import axios from 'axios'

export const user = {
  async getUsers () {
    return axios.get('/api/users')
      .then(res => res.data)
  }
}
