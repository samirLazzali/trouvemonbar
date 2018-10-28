import { bar } from './bar'
import { keyword } from './keyword'
import { signup } from './signup'

const api = {
  ...bar,
  ...keyword,
  ...signup
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
