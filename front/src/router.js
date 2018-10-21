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
      path: '/search',
      name: 'search',
      component: () => import('./views/TheSearch.vue')
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('./views/TheUsers.vue')
    }
  ]
})
