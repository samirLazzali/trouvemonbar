import axios from 'axios'

export const keyword = {
  addKeywords (keywords) {
    return axios.post(`/api/keywords`, {
      keywords: keywords
    })
  }
}
