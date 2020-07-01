import Vue from 'vue'
import Router from 'vue-router'
import store from './../store'

import Login from '@/components/Login'
import Home from '@/components/Home'
import Error from '@/components/Error'
import ReportedCars from '@/components/ReportedCars'



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
        auth: true
      }
    },
    {
      path: '/reported-cars',
      name: 'ReportedCars',
      component: ReportedCars,
      meta:{
        auth: true
      }
    },

    { path: "*",
      component: Error
    }
  ]
})



router.beforeEach((to, from, next)=>{
  if (to.matched.some(record => record.meta.auth)){
    if (!store.getters.isUserLogged){

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
