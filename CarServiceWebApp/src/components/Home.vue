<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <div class="dashboard__row">
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zgłoszenia oczekujące:
                        </h2>
                        <div class="block__count">
                            {{data.amountNotAcceptedReportedCars}}
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
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                            ---
                            <span class="block__text block__text--light">
                                Łącznie: {{data.amountAcceptedReportedCars}}
                            </span>
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
                        <div class="block__count">
                            {{data.amountDeliveredReportedCars}}
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
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                            ---
                            <span class="block__text block__text--light">
                                Łącznie: {{data.amountEvents}} <span>|</span>W trakcie: {{ data.amountInProgressEvents}}
                            </span>
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
                        <div class="block__count">
                            {{data.amountReadyCars}}
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
    import axios from 'axios'

    const headers = {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
    export default {
        name: "Home",
        data() {
            return {
                data: {
                    amountNotAcceptedReportedCars: 0,
                    amountAcceptedReportedCars: 0,
                    amountDeliveredReportedCars: 0,
                    amountEvents: 0,
                    amountInProgressEvents: 0,
                    amountReadyCars: 0,
                }
            }
        },
        mounted() {
            axios.get('/getStatistics')
                .then(response => {
                    this.data.amountNotAcceptedReportedCars=response.data.amountNotAcceptedReportedCars
                    this.data.amountAcceptedReportedCars=response.data.amountAcceptedReportedCars
                    this.data.amountDeliveredReportedCars=response.data.amountDeliveredReportedCars
                    this.data.amountEvents=response.data.amountEvents
                    this.data.amountInProgressEvents=response.data.amountInProgressEvents
                    this.data.amountReadyCars=response.data.amountReadyCars
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
