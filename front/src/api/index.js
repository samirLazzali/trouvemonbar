import { bar } from './bar'
import { keyword } from './keyword'
import { user } from './user'

const api = {
  ...bar,
  ...keyword,
  ...user
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
