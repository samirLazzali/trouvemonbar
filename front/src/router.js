import Vue from 'vue'
import Router from 'vue-router'
import TheHome from './views/TheHome.vue'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: TheHome
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('./components/TheUsers.vue')
    }
  ]
})
