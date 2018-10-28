import axios from 'axios'

export const signup = {
  singup (user) {
    return axios.post('/api/signup', user)
  }
}
