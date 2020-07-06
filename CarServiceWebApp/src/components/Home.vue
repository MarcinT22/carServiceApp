<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <div class="dashboard__row">
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zgłoszenia oczekujące:
                        </h2>
                        <div class="loading" v-if="isLoading"></div>
                        <div class="loadingContainer" :class="{active:!isLoading}">
                        <div class="block__count">
                            {{amountNotAcceptedReportedCars}}
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
                            {{amountTodayDeliveries}}
                            <span class="block__text block__text--light">
                                Łącznie: {{amountAcceptedReportedCars}}
                            </span>
                        </div>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
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
                            {{amountDeliveredReportedCars}}
                        </div>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
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
                            ---
                            <span class="block__text block__text--light">
                                Łącznie: {{amountEvents}} <span>|</span>W trakcie: {{ amountInProgressEvents}}
                            </span>
                        </div>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
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
                            {{amountReadyCars}}
                        </div>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
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
                amountNotAcceptedReportedCars: 0,
                amountAcceptedReportedCars: 0,
                amountTodayDeliveries:0,
                amountDeliveredReportedCars: 0,
                amountEvents: 0,
                amountInProgressEvents: 0,
                amountReadyCars: 0,
                isLoading: true
            }
        },
        mounted() {
            axios.get('/getStatistics')
                .then(response => {
                    this.amountNotAcceptedReportedCars = response.data.amountNotAcceptedReportedCars
                    this.amountAcceptedReportedCars = response.data.amountAcceptedReportedCars
                    this.amountTodayDeliveries = response.data.amountTodayDeliveries
                    this.amountDeliveredReportedCars = response.data.amountDeliveredReportedCars
                    this.amountEvents = response.data.amountEvents
                    this.amountInProgressEvents = response.data.amountInProgressEvents
                    this.amountReadyCars = response.data.amountReadyCars
                    this.isLoading=false
                })
                .catch(error => {
                    console.log(error)
                })
        }


    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";


</style>
