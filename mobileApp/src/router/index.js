import Vue from 'vue'
import Router from 'vue-router'
import store from './../store'

import Login from '@/components/Login'
import Home from '@/components/Home'
import Visit from '@/components/Visit'
import Status from '@/components/Status'
import Message from '@/components/Message'

Vue.use(Router)

let router = new Router({
  mode: 'history',
  linkExactActiveClass: 'active',
  routes: [
    {
      path: '/login',
      name: 'Login',
      component: Login
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