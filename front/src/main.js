import Vue from 'vue'
import App from './App.vue'
import router from './router'
import Api from './api'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import 'material-design-icons-iconfont/dist/material-design-icons.css'

Vue.config.productionTip = false

Vue.use(Api)
Vue.use(Vuetify)

new Vue({
  router,
  render: h => h(App)
}).$mount('#app')
