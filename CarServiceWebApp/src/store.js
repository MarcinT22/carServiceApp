import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token') || null,
        user: null,
        status: null,



    },

    mutations: {
        AUTH_REQUEST(state) {
            state.status = 'loading'
        },
        LOGIN_SUCCESS(state, token) {
            state.status = 'success'
            state.token = token
        },
        LOGIN_ERROR(state) {
            state.status = 'error'
        },
        LOGOUT(state) {
            state.status = ''
            state.token = ''
        },

    },

    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('AUTH_REQUEST')
                axios.post('/login', user)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
                        commit('LOGIN_SUCCESS', token)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('LOGIN_ERROR')
                        localStorage.removeItem('token')
                        reject(error)
                    })
            })

        },

        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('LOGOUT');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })

        },




    },

    getters: {
        isUserLogged: state => !!state.token,
        authStatus: state => state.status,


    }
})
