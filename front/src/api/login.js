import axios from 'axios'

export const login = {
  login (user) {
    return axios.post('/api/login', user)
  }
}
