import Vue from 'vue'
import Router from 'vue-router'
import store from './../store'

import Login from '@/components/Login'
import Home from '@/components/Home'
import Error from '@/components/Error'
import ReportedCars from '@/components/ReportedCars'
import CarDeliveries from '@/components/CarDeliveries'
import CarDeliveriesCalendar from '@/components/CarDeliveriesCalendar'
import NewEvents from '@/components/NewEvents'
import RepairCalendar from '@/components/RepairCalendar'
import ReadyCars from '@/components/ReadyCars'
import Settings from '@/components/Settings'
import StatusList from '@/components/StatusList'
import Users from '@/components/Users'
import AddUser from '@/components/AddUser'
import EditUser from '@/components/EditUser'
import NewReportedCar from '@/components/NewReportedCar'
import AddCar from '@/components/AddCar'


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
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/reported-cars',
            name: 'ReportedCars',
            component: ReportedCars,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },

        {
            path: '/car-deliveries',
            name: 'CarDeliveries',
            component: CarDeliveries,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/car-deliveries-calendar',
            name: 'CarDeliveriesCalendar',
            component: CarDeliveriesCalendar,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/new-events',
            name: 'NewEvents',
            component: NewEvents,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/repair-calendar',
            name: 'RepairCalendar',
            component: RepairCalendar,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/read-cars',
            name: 'ReadyCars',
            component: ReadyCars,
            meta: {
                auth: true,
                isAdmin: 0

            }
        },
        {
            path: '/settings',
            name: 'Settings',
            component: Settings,
            meta: {
                auth: true,
                isAdmin: 1
            }
        },
        {
            path: '/status-list',
            name: 'StatusList',
            component: StatusList,
            meta: {
                auth: true,
                isAdmin: 1
            }
        },
        {
            path: '/users',
            name: 'Users',
            component: Users,
            meta: {
                auth: true,
                isAdmin: 1
            }
        },
        {
            path: '/add-user',
            name: 'AddUser',
            component: AddUser,
            meta: {
                auth: true,
                isAdmin: 1
            }
        },
        {
            path: '/edit-user/:id',
            name: 'EditUser',
            component: EditUser,
            meta: {
                auth: true,
                isAdmin: 1
            }
        },
        {
            path: '/new-reported-car',
            name: 'NewReportedCar',
            component: NewReportedCar,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },
        {
            path: '/add-car',
            name: 'AddCar',
            component: AddCar,
            meta: {
                auth: true,
                isAdmin: 0
            }
        },

        {
            path: "*",
            component: Error
        }
    ],

})


router.beforeEach((to, from, next) => {

    if (to.matched.some(record => record.meta.auth)) {
        const record = to.matched.find(record => record.meta);
        if (!store.getters.isUserLogged) {

            next({name: 'Login'})

        } else {
            if (record.meta.isAdmin == 1) {
                if (record.meta.isAdmin == JSON.parse(localStorage.getItem('user')).is_admin) {
                    next();
                } else {
                    next({name: 'Home'})
                }
            } else {
                next();
            }

        }

    } else {
        next()
    }
})

export default router
