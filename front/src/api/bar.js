import axios from 'axios'

export const bar = {
  getBars (query) {
    var kw = JSON.stringify(query.q).replace('"', '')
    return axios.get('/api/bars', {
      params: {
        keywords: kw.replace('"', '')
      }

    }).then(res => res.data)
  },
  getBar (id) {
    return axios.get('/api/bars/' + id)
      .then(res => res.data)
  },
  addComment (idBar, comment) {
    return axios.post(`/api/bars/${idBar}/comments`, comment)
  },
  deleteComment (id) {
    return axios.delete(`/api/comments/${id}`)
  }
}
