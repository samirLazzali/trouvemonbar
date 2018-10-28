import { bar } from './bar'
import { keyword } from './keyword'

const api = {
  ...bar,
  ...keyword
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
