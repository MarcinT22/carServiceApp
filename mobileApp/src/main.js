// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import store from './store'
import axios from 'axios'


axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

const token = localStorage.getItem('token')
if (token) {
  axios.defaults.headers.common['Authorization'] = 'Bearer '+token
}


Vue.prototype.$disabledDates = function (date) {
  const today = new Date();
  const newDate = new Date(today);
  newDate.setDate(newDate.getDate() + 1)
  const day = new Date(date).getDay()
  return day === 0 || day === 6 || date < newDate;
};

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
