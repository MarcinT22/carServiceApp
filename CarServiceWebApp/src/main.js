// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import store from './store'
import axios from 'axios'
import moment from 'moment'


axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const token = localStorage.getItem('token')
if (token) {
  axios.defaults.headers.common['Authorization'] = token
}


Vue.prototype.$formatDate = function (date) {
  return moment(String(date)).format('DD.MM.YYYY')
};



/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
