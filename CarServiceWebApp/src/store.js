import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)


export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token') || '',
        user: {},
        status: ''
    },

    mutations: {
        authRequest(state) {
            state.status = 'loading'
        },
        authSuccess(state, token) {
            state.status = 'success'
            state.token = token
        },
        authError(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = ''
            state.token = ''
        }
    },

    actions: {
        login({commit}, user) {
            return new Promise((resolve, reject) => {
                commit('authRequest')
                axios.post('/login',user)
                .then(response => {
                    const token = response.data.access_token;

                    localStorage.setItem('token', token)
                    axios.defaults.headers.common['Authorization'] = token;
                    commit('authSuccess', token)
                    resolve(response)
                })
                    .catch(error => {
                        commit('authError')
                        localStorage.removeItem('token')
                        reject(error)
                    })
            })
        },

        logout({commit}) {
            return new Promise((resolve, reject) => {
                commit('logout');
                localStorage.removeItem('token');
                delete axios.defaults.headers.common['Authorization']
                resolve()
            })

        }
    },

    getters: {
        isUserLogged: state => !!state.token,
        authStatus: state => state.status
    }
})