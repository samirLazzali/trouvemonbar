import { bar } from './bar'
import { user } from './user'
import { admin } from './admin'

const api = {
  ...bar,
  ...user,
  ...admin
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
