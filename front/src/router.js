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
      props: route => ({ query: route.query }),
      component: () => import('./views/TheSearch.vue'),
      beforeEnter: (to, _, next) => {
        const query = to.query.q

        if (query && query.trim()) {
          next()
        } else {
          next('/')
        }
      }
    },
    {
      path: '/users',
      name: 'users',
      component: () => import('./views/TheUsers.vue')
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('./views/TheSignIn.vue')
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('./views/TheSignUp.vue')
    }
  ]
})
