import axios from 'axios'

export const keyword = {
  getKeywords () {
    return axios.get('/api/keywords')
      .then(res => res.data)
      .then(keywords => {
        return keywords
          .map(k => k.name)
          .map(name => name.charAt(0).toUpperCase() + name.slice(1))
          .sort((a, b) => a.localeCompare(b))
      })
  }
}
