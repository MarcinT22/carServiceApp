import Vue from 'vue'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)
export default new Vuex.Store({
    state: {
        token: localStorage.getItem('token') || null,
        user: null,
        status: null,
        events: [],
        message: null,
        isMessage: false,
        statusesList: [],
        sheduledEvents: [],
        acceptedReportedCars: [],
        isLoading: true,
        acceptedAlerts: [],
        showAcceptedAlerts:false,
        users:[],
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
        MESSAGE_SUCCESS(state, message) {
            state.status = 'success'
            state.message = message
            state.isMessage = true
            setTimeout(() => {
                state.isMessage = false
                state.message = null
            }, 4000)
        },
        GET_STATUS_LIST_SUCCESS(state, statusesList) {
            state.statusesList = statusesList
            state.isLoading = false
        },
        GET_STATUS_LIST_ERROR(state) {
            state.status = 'error'
        },
        GET_SHEDULED_EVENTS_SUCCESS(state, sheduledEvents) {
            state.sheduledEvents = sheduledEvents
            state.isLoading = false
        },
        GET_SHEDULED_EVENTS_ERROR(state) {
            state.status = 'error'
            state.isLoading = false
        },

        GET_ACCEPTED_REPORTED_CARS_SUCCESS(state, acceptedReportedCars) {
            state.acceptedReportedCars = acceptedReportedCars
            state.isLoading = false
        },
        GET_ACCEPTED_REPORTED_CARS_ERROR(state) {
            state.status = 'error'
            state.isLoading = false
        },

        SEND_ALERT_SUCCESS(state, alert) {
            state.status = 'success'
        },
        SEND_ALERT_ERROR(state) {
            state.status = 'error'
        },
        GET_ACCEPTED_ALERTS_SUCCESS(state,acceptedAlerts)
        {
            state.status = 'success'
            state.acceptedAlerts = acceptedAlerts
            if (acceptedAlerts.length > 0) {
                state.showAcceptedAlerts = true
            }
        },
        GET_ACCEPTED_ALERTS_ERROR(state)
        {
            state.status = 'error'
        },

        GET_USERS_SUCCESS(state, users) {
            state.users = users
            state.isLoading = false
        },
        GET_USERS_ERROR(state) {
            state.status = 'error'
            state.isLoading = false
        },

        DELETE_USER_SUCCESS(state) {
            state.status = 'success'
        },
        DELETE_USER_ERROR(state) {
            state.status = 'error'

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
                        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;
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

        message({commit}, message) {
            return new Promise((resolve, reject) => {
                commit('MESSAGE_SUCCESS', message)
                resolve()
            })
        },

        getStatusList({commit}) {
            return new Promise((resolve, reject) => {
                axios.get('/statuses')
                    .then(response => {
                        let statusesList = response.data.data
                        commit('GET_STATUS_LIST_SUCCESS', statusesList)
                        resolve(response)
                    })
                    .catch(error => {
                        commit('GET_STATUS_LIST_ERROR')
                        reject(error)
                    })

            })
        },


        getSheduledEvents({commit}) {
            this.state.isLoading = true
            return new Promise((resolve, reject) => {
                axios.get('/getSheduledEvents')
                    .then(response => {
                        let events = response.data.data;
                        let sheduledEvents = [];
                        events.forEach((value, index) => {
                            let event = {
                                id: value.id,
                                title: value.title,
                                start: value.start,
                                backgroundColor: value.status.color,
                                allDetails: value
                            }
                            sheduledEvents.push(event);
                        });
                        commit('GET_SHEDULED_EVENTS_SUCCESS', sheduledEvents)
                        resolve(response)


                    })
                    .catch(error => {
                        commit('GET_SHEDULED_EVENTS_ERROR')
                        reject(error)
                    })

            })
        },

        getAcceptedReportedCars({commit}) {
            this.state.isLoading = true
            return new Promise((resolve, reject) => {
                axios.get('/getAcceptedReportedCars')
                    .then(response => {
                        let events = response.data.data.reportedCars;
                        let acceptedReportedCars = [];
                        events.forEach((value, index) => {
                            let event = {
                                id: value.id,
                                title: value.car.brand + ' ' + value.car.model + ' ' + value.car.registration_number,
                                start: value.new_reported_car_date || value.reported_car_date,
                                allDetails: value
                            }
                            acceptedReportedCars.push(event);
                        });
                        commit('GET_ACCEPTED_REPORTED_CARS_SUCCESS', acceptedReportedCars)
                        resolve(response)


                    })
                    .catch(error => {
                        commit('GET_ACCEPTED_REPORTED_CARS_ERROR')
                        reject(error)
                    })

            })
        },

        sendAlert({commit}, data) {
            return new Promise((resolve, reject) => {
                axios.post('/alerts', data)
                    .then(response => {
                        commit('SEND_ALERT_SUCCESS')
                        resolve(response)
                    })
                    .catch(error => {
                        commit('SEND_ALERT_ERROR')
                        reject(error)
                    })
            })

        },

        getAcceptedAlert({commit},event_id) {
            return new Promise((resolve, reject) => {
                axios.get('/getAcceptedAlerts/'+event_id)
                    .then(response => {
                        let acceptedAlerts = response.data.data;
                        commit('GET_ACCEPTED_ALERTS_SUCCESS', acceptedAlerts)
                        resolve(response)


                    })
                    .catch(error => {
                        commit('GET_ACCEPTED_ALERTS_ERROR')
                        reject(error)
                    })

            })
        },


        getUsers({commit}) {
            this.state.isLoading = true
            return new Promise((resolve, reject) => {
                axios.get('/getUsers/')
                    .then(response => {
                        let users = response.data.users;
                        commit('GET_USERS_SUCCESS', users)
                        resolve(response)


                    })
                    .catch(error => {
                        commit('GET_USERS_ERROR')
                        reject(error)
                    })

            })
        },

        deleteUser({commit}, {id, index}) {
            return new Promise((resolve, reject) => {
                axios.delete('/deleteUser/'+id)
                    .then(response => {
                        commit('DELETE_USER_SUCCESS')
                        this.state.users.splice(index, 1)
                        resolve(response)
                    })
                    .catch(error => {
                        commit('DELETE_USER_ERROR')
                        reject(error)
                    })

            })
        },




    },

    getters: {
        isUserLogged: state => !!state.token,
        authStatus:
            state => state.status,
        getMessage:
            state => state.message,
        isMessage:
            state => state.isMessage,
        getStatusesList: state => state.statusesList,
        getSheduledEvents: state => state.sheduledEvents,
        getAcceptedReportedCars: state => state.acceptedReportedCars,
        isLoading: state => state.isLoading,
        getAcceptedAlerts: state => state.acceptedAlerts,
        showAcceptedAlerts: state=>state.showAcceptedAlerts,
        getUsers:state=>state.users


    }
})
