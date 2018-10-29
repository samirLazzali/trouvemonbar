import { bar } from './bar'
import { user } from './user'

const api = {
  ...bar,
  ...user
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
