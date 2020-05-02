import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/components/Home'
import Login from '@/components/Login'
import Status from '@/components/Status'
import Visit from '@/components/Visit'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Home',
      component: Home
    },
    {
      path: '/login',
      name: 'Login',
      component: Login
    },
    {
      path: '/status',
      name: 'Status',
      component: Status
    },
    {
      path: '/visit',
      name: 'Visit',
      component: Visit
    }
  ]
})
