<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Zgłoszenia oczekujące <span v-if="reportedCars.length">({{reportedCars.length}})</span>
            </h1>
            <div class="message" :class="{active:showMessage}">
                <div class="message__icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <div class="message__text">
                    {{message}}
                </div>
            </div>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div v-if="reportedCars.length == 0" class="dashboard__empty">Brak</div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(reportedCar, index) in reportedCars">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <div class="block__data">
                                <table>
                                    <tr>
                                        <td class="bold">Model:</td>
                                        <td> {{reportedCar.car.brand}} {{reportedCar.car.model}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{reportedCar.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{reportedCar.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{reportedCar.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="block__text">
                                    <strong>Data dostarczenia pojazdu:</strong><br/>
                                    {{$formatDate(reportedCar.reported_car_date)}}

                                </div>
                                <hr>
                                <div class="block__text">
                                    <strong>Opis usterki:</strong><br/>
                                    {{reportedCar.description}}
                                </div>
                                <div class="block__action" v-if="showDateInput != index">
                                    <button href="#" class="block__actionBtn block__actionBtn--changeDate"
                                            @click="showDateInput = index, new_reported_car_date=null">
                                        <i class="far fa-calendar-alt"></i> Zaproponuj inną datę
                                    </button>
                                    <button class="block__actionBtn block__actionBtn--accept"
                                            @click="accept(reportedCar.id, index)">
                                        <i class="far fa-check-circle"></i> Akceptuj
                                    </button>


                                </div>
                                <div v-if="showDateInput === index">
                                    <hr>
                                    <strong>Nowa data dostarczenia pojazdu:</strong><br/>
                                    <div class="block__date">

                                        <date-picker v-model="new_reported_car_date" :editable="false"
                                                     :disabled-date="disabledDates"
                                                     type="date" format="DD.MM.YYYY"
                                                     placeholder="Wybierz datę"
                                                     id="date"></date-picker>

                                    </div>
                                    <button class="block__actionBtn block__actionBtn--cancel"
                                            @click="showDateInput = null">
                                        <i class="far fa-times-circle"></i> Anuluj
                                    </button>
                                    <button class="block__actionBtn block__actionBtn--accept"
                                            @click="changeDate(reportedCar.id, index)">
                                        <i class="far fa-check-circle"></i> Zmień datę
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';


    const today = new Date();
    export default {
        name: "ReportedCars",
        data() {
            return {
                reportedCars: 0,
                isLoading: true,
                message: null,
                showMessage: false,
                new_reported_car_date: null,
                showDateInput: null,
            }
        },
        methods: {
            disabledDates(date) {
                const day = new Date(date).getDay()
                return day === 0 || day === 6 || date < today;

            },
            accept(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.get('/acceptReportedCar/' + id)
                    .then(response => {
                        this.reportedCars.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.message = "Zgłoszenie zostało zaakceptowane";
                        this.showMessage = true
                        setTimeout(() => this.showMessage = false, 5000);
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            changeDate(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.put('/reportedCars/' + id, {
                    new_reported_car_date: this.new_reported_car_date
                })
                    .then(response => {
                        this.reportedCars.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.message = "Propozycja zmiany daty została przesłana do klienta.";
                        this.showMessage = true
                        setTimeout(() => this.showMessage = false, 5000);
                        this.new_reported_car_date = null
                        this.showDateInput = null
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },


        },
        mounted() {
            axios.get('/getNotAcceptedReportedCars')
                .then(response => {
                    this.reportedCars = response.data.data.reportedCars
                    this.isLoading = false
                })
                .catch(error => {
                    console.log(error)
                })
        },
        components: {DatePicker},
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/message";

    .mx-datepicker {
        width: 100% !important;
    }
</style>
