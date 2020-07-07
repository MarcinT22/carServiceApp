import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token') || null,
        car: null,
        reportedCar: null,
        status: null,
        eventStatus: null,
        isLoading: true,
        zone: null,
        blur: false,

    },

    mutations: {
        authRequest(state) {
            state.status = 'loading'
        },
        loginSuccess(state, token) {
            state.status = 'success'
            state.token = token
        },
        loginError(state) {
            state.status = 'error'
        },
        logout(state) {
            state.status = null
            state.token = null
            state.car = null
            state.reportedCar = null
            state.eventStatus = null
            state.zone = null
        },

        reportedCarSuccess(state) {
            state.status = 'success'
        },
        reportedCarError(state) {
            state.status = 'error'
        },

        changeZone(state, zone) {
            state.zone = zone
        },

        setCar(state, car) {
            state.car = car
        },

        setReportedCar(state, reportedCar) {
            state.reportedCar = reportedCar
        },

        setStatus(state, status) {
            state.eventStatus = status
        },

        setStatusError() {
            state.status = 'error'
        },


    },

    actions: {
        login({commit}, car) {
            return new Promise((resolve, reject) => {
                commit('authRequest')
                axios.post('/cars/login', car)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                        commit('loginSuccess', token)
                        commit('setCar', response.data.car)
                        commit('setReportedCar', response.data.car.reported_cars[0])
                        resolve(response)

                    })
                    .catch(error => {
                        commit('loginError')
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

        },

        setVisitWithMyCar({commit}, data) {
            return new Promise((resolve, reject) => {
                commit('authRequest')
                axios.post('/reportedMyCar', data)
                    .then(response => {
                        const token = response.data.access_token;
                        localStorage.setItem('token', token)
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
                        commit('reportedCarSuccess')
                        resolve(response)

                    })
                    .catch(error => {
                        commit('reportedCarError')
                        reject(error)
                    })
            })

        },

        setVisitWithNewCar({commit}, data) {
            return new Promise((resolve, reject) => {
                commit('authRequest')
                axios.post('/reportedNewCar', data)
                    .then(response => {
                        commit('reportedCarSuccess')
                        resolve(response)
                    })
                    .catch(error => {
                        commit('reportedCarError')
                        reject(error)
                    })
            })

        },

        getStatus({commit}, reportedCarId) {
            return new Promise((resolve, reject) => {
                axios.get('/getEventStatus/' + reportedCarId)
                    .then(response => {
                        commit('setStatus', response.data[0])
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setStatusError')
                        reject(error)
                    })
            })

        },


    },

    getters: {
        isCarLogged: state => !!state.token,
        getZone: state => state.zone,
        getCar: state => state.car,
        getEventStatus: state => state.eventStatus,
        getReportedCar: state => state.reportedCar,
        isLoading: state => state.isLoading

    }
})