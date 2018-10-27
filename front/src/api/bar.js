import axios from 'axios'

export const bar = {
  getBars (query) {
    var kw = JSON.stringify(query.q).replace('"', '')
    return axios.get('/api/bars', {
      params: {
        keywords: kw.replace('"', '')
      }

    }).then(res => res.data)
  }
}
