import { bar } from './bar'
import { user } from './user'
import { barList } from './barList'

const api = {
  ...bar,
  ...user,
  ...barList
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
