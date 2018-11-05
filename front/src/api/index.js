import { bar } from './bar'
import { user } from './user'
import { keyword } from './keyword'

const api = {
  ...bar,
  ...user,
  ...keyword
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
