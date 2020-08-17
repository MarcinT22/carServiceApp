<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
               Pulpit {{name}}
            </h1>
            <div class="dashboard__row">
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zgłoszenia oczekujące:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            {{numberOfNotAcceptedReportedCars}}
                        </div>
                        </div>
                        <router-link :to="{ name: 'ReportedCars' }">
                            Zarządzaj
                        </router-link>

                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Przyjęcia pojazdów:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                            {{numberOfTodayDeliveries}}
                            <span class="block__text block__text--light">
                                Łącznie: {{numberOfAcceptedReportedCars}}
                            </span>
                        </div>
                        </div>
                        <router-link :to="{ name: 'CarDeliveries' }">
                            Zarządzaj
                        </router-link>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Nowe zlecenia:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            {{numberOfNewEvents}}
                        </div>
                        </div>
                        <router-link :to="{ name: 'NewEvents' }">
                            Zarządzaj
                        </router-link>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zaplanowane naprawy:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                           {{numberOfTodayEvents}}
                            <span class="block__text block__text--light">
                                Łącznie: {{numberOfAllEvents}} <span>|</span>W trakcie: {{ numberOfInProgressEvents}}
                            </span>
                        </div>
                        </div>
                        <router-link :to="{ name: 'RepairCalendar' }">
                            Zarządzaj
                        </router-link>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Pojazdy do wydania:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            {{numberOfReadyCars}}
                        </div>
                        </div>
                        <router-link :to="{ name: 'ReadyCars' }">
                            Zarządzaj
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    const headers = {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
    import axios from 'axios'

    export default {
        name: "Home",
        data() {
            return {
                numberOfNotAcceptedReportedCars: 0,
                numberOfAcceptedReportedCars: 0,
                numberOfTodayDeliveries:0,
                numberOfNewEvents: 0,
                numberOfAllEvents: 0,
                numberOfTodayEvents: 0,
                numberOfInProgressEvents: 0,
                numberOfReadyCars: 0,
                isLoading: true,
                name:localStorage.user
            }
        },
        mounted() {
            axios.get('/getStatistics')
                .then(response => {
                    this.numberOfNotAcceptedReportedCars = response.data.numberOfNotAcceptedReportedCars
                    this.numberOfAcceptedReportedCars = response.data.numberOfAcceptedReportedCars
                    this.numberOfTodayDeliveries = response.data.numberOfTodayDeliveries
                    this.numberOfNewEvents = response.data.numberOfNewEvents
                    this.numberOfAllEvents = response.data.numberOfAllEvents
                    this.numberOfTodayEvents = response.data.numberOfTodayEvents
                    this.numberOfInProgressEvents = response.data.numberOfInProgressEvents
                    this.numberOfReadyCars = response.data.numberOfReadyCars
                    this.isLoading=false
                })
                .catch(error => {
                    console.log(error)
                })
            console.log(localStorage.user['name'])
        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";


</style>
