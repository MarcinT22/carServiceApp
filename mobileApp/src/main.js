// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import store from './store'
import axios from 'axios'


axios.defaults.baseURL = 'http://api.car-service.marcin-topolski.pl/api';

const token = localStorage.getItem('token')
if (token) {
  axios.defaults.headers.common['Authorization'] = token
}

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
