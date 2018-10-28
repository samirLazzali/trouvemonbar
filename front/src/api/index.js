import { bar } from './bar'
import { keyword } from './keyword'

const api = {
  ...bar,
  ...keyword,

  searchRequest (query) {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        bar.getBars()
          .then(bars => {
            resolve(bars.filter(b => b.keywords.some(k => {
              return query.q.includes(k)
            })))
          })
          .catch(reject)
      }, 1000)
    })
  }
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
