import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token') || null,
        car: null,
        status: null,
        isLoading:true,
        zone:null

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

        REPORTED_CAR_SUCCESS(state) {
            state.status = 'success'
        },
        REPORTED_CAR_ERROR(state) {
            state.status = 'error'
        },

        CHANGE_ZONE(state, zone){
            state.zone = zone
        },

        SET_CAR(state, car)
        {
            state.car = car
        }


    },

    actions: {
        login({commit}, car) {
            return new Promise((resolve, reject) => {
                commit('AUTH_REQUEST')
                axios.post('/cars/login', car)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
                        commit('LOGIN_SUCCESS', token)
                        console.log(response.data.car)
                        commit('SET_CAR', response.data.car)
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

        setVisitWithMyCar({commit}, data) {
            return new Promise((resolve, reject) => {
                commit('AUTH_REQUEST')
                axios.post('/reportedMyCar', data)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
                        commit('REPORTED_CAR_SUCCESS')
                        resolve(response)

                    })
                    .catch(error => {
                        commit('REPORTED_CAR_ERROR')
                        reject(error)
                    })
            })

        },

        setVisitWithNewCar({commit}, data) {
            return new Promise((resolve, reject) => {
                commit('AUTH_REQUEST')
                axios.post('/reportedNewCar', data)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer '+token;
                        commit('REPORTED_CAR_SUCCESS')
                        resolve(response)

                    })
                    .catch(error => {
                        commit('REPORTED_CAR_ERROR')
                        reject(error)
                    })
            })

        },


    },

    getters: {
        isCarLogged: state => !!state.token,
        authStatus: state => state.status,
        getZone: state => state.zone,
        getCar:state => state.car

    }
})