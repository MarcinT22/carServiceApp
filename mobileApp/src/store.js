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
        eventDetails:null,
        eventStatus: null,
        isLoading: true,
        zone: null,
        blur: false,
        messageType:null,
        alerts:null,
        numberOfAlerts:0,
        showAlerts:false,

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

        setStatus(state, eventStatus) {
            state.eventStatus = eventStatus

        },
        setEventDetails(state,eventDetails)
        {
            state.eventDetails = eventDetails
        },
        setStatusError() {
            state.status = 'error'
        },

        setAlerts(state,alerts)
        {
            state.alerts = alerts
            state.numberOfAlerts =  alerts.length
            if (alerts.length != 0)
            {
                state.showAlerts = true
            }


        },
        setAlertsError(state) {
            state.status = 'error'
        },
        acceptAlert(state)
        {
            state.status = 'success'
        },

        acceptAlertError(state)
        {
            state.status = 'error'
        },

        notAcceptAlert(state)
        {
            state.status = 'success'
        },
        notAcceptAlertError(state)
        {
            state.status = 'error'
        }


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
                        commit('setStatus', response.data.data.status)
                        commit('setEventDetails',  response.data.data.eventDetails)
                        resolve(response)

                    })
                    .catch(error => {
                        commit('setStatusError')
                        reject(error)
                    })
            })

        },

        getAlerts({commit}, reported_car_id)
        {
            return new Promise((resolve, reject) => {
                axios.get('/getNewAlerts/' + reported_car_id)
                    .then(response => {
                        commit('setAlerts', response.data.alerts)
                        resolve(response)
                    })
                    .catch(error => {
                        commit('setAlertsError')
                        reject(error)
                    })
            })
        },

        acceptAlert({commit}, id)
        {
            return new Promise((resolve, reject) => {
                axios.put('/acceptAlert/' + id)
                    .then(response => {
                        commit('acceptAlert')
                        resolve(response)
                    })
                    .catch(error => {
                        commit('acceptAlertError')
                        reject(error)
                    })
            })
        },

        notAcceptAlert({commit}, id)
        {
            return new Promise((resolve, reject) => {
                axios.put('/notAcceptAlert/' + id)
                    .then(response => {
                        commit('notAcceptAlert')
                        resolve(response)
                    })
                    .catch(error => {
                        commit('notAcceptAlertError')
                        reject(error)
                    })
            })
        }


    },

    getters: {
        isCarLogged: state => !!state.token,
        getZone: state => state.zone,
        getCar: state => state.car,
        getEventStatus: state => state.eventStatus,
        getEventDetails: state => state.eventDetails,
        getReportedCar: state => state.reportedCar,
        isLoading: state => state.isLoading,
        getMessageType: state => state.messageType,
        getAlerts: state=>state.alerts,
        getNumberOfAlerts: state=>state.numberOfAlerts,
        showAlerts:state => state.showAlerts

    }
})
