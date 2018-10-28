import { bar } from './bar'
import { keyword } from './keyword'
import { users } from './users'

const api = {
  ...bar,
  ...keyword,
  ...users
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
