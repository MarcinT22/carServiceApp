import Vue from 'vue'
import Router from 'vue-router'
import store from './../store'

import Login from '@/components/Login'
import Home from '@/components/Home'
import Visit from '@/components/Visit'
import NewCarVisit from '@/components/NewCarVisit'
import Status from '@/components/Status'
import Message from '@/components/Message'
import NotConnection from '@/components/NotConnection'
import Alerts from '@/components/Alerts'

Vue.use(Router)

let router = new Router({
  linkExactActiveClass: 'active',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login,
      meta:{
        auth: false
      }
    },
    {
      path: '/',
      name: 'Home',
      component: Home,
      meta:{
        auth: false
      }
    },
    {
      path: '/visit',
      name: 'Visit',
      component: Visit,
      meta:{
        auth: true
      }
    },
    {
      path: '/newCarVisit',
      name: 'NewCarVisit',
      component: NewCarVisit,
      meta:{
        auth: false
      }
    },
    {
      path: '/status',
      name: 'Status',
      component: Status,
      meta:{
        auth: true
      }
    },
    {
          path: '/message',
          name: 'Message',
          component: Message,
          meta:{
              auth: false
          }
      },
      {
          path: '/notConnection',
          name: 'NotConnection',
          component: NotConnection,
          meta:{
              auth: false
          }
      },
    {
      path: '/alerts',
      name: 'Alerts',
      component: Alerts,
      meta:{
        auth: true
      }
    },
    { path: "*",
      component: Home
    }
  ]
})



router.beforeEach((to, from, next)=>{
  if (to.matched.some(record => record.meta.auth)){
    if (!store.getters.isCarLogged){
      next({name:'Login'})
    }
    else{
      next()
    }
  }else{
    next()
  }
})

export default router
