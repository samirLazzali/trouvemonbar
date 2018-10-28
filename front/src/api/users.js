import axios from 'axios'

export const users = {
  signup (user) {
    return axios.post('/api/users', user)
  }
}
