<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Zgłoszenia oczekujące <span v-if="reportedCars.length">({{reportedCars.length}})</span><span v-else>(0)</span>
            </h1>

            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div v-if="reportedCars.length == 0" class="dashboard__empty">Brak</div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(reportedCar, index) in reportedCars">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <button class="block__delete" @click="remove(reportedCar.id, index)">
                                <i class="fas fa-times-circle"></i>
                            </button>
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
                                <div class="block__text block__text--center">
                                    <strong>Data dostarczenia pojazdu:</strong>
                                    <span class="highlight">
                                        {{$formatDate(reportedCar.reported_car_date)}}
                                    </span>

                                </div>
                                <hr>
                                <div class="block__action" v-if="showDateInput != index">
                                    <button href="#" class="block__actionBtn block__actionBtn--info"
                                            @click="showDescription(reportedCar.description)">
                                        <i class="fas fa-info-circle"></i> Opis usterki
                                    </button>
                                    <button href="#" class="block__actionBtn block__actionBtn--changeDate"
                                            @click="showDateInput = index, new_reported_car_date=null">
                                        <i class="far fa-calendar-alt"></i> Zaproponuj inną datę
                                    </button>
                                    <button class="block__actionBtn block__actionBtn--accept"
                                            @click="accept(reportedCar.id, index)">
                                        <i class="far fa-check-circle"></i> Akceptuj
                                    </button>


                                </div>
                                <div v-if="showDateInput === index" class="block__newDate">
                                    <div class="block__text">
                                        <strong>
                                            Nowa data dostarczenia pojazdu:
                                        </strong>
                                    </div>
                                    <div class="block__date">

                                        <date-picker v-model="new_reported_car_date" :editable="false"
                                                     :disabled-date="disabledDates"
                                                     type="date" format="DD.MM.YYYY"
                                                     placeholder="Wybierz datę"
                                                     id="date"></date-picker>

                                    </div>
                                    <div class="block__action">
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
        <DescriptionModal ref="descriptionModal"></DescriptionModal>
    </div>
</template>

<script>
    import axios from 'axios'
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';

    import DescriptionModal from '@/components/DescriptionModal'


    const today = new Date();
    export default {
        name: "ReportedCars",
        data() {
            return {
                reportedCars: 0,
                isLoading: true,
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
                        this.$store.dispatch('message', 'Zgłoszenie zostało zaakceptowane.')

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
                        this.$store.dispatch('message', 'Propozycja zmiany daty została przesłana do klienta.')
                        this.new_reported_car_date = null
                        this.showDateInput = null
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            remove(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.delete('/reportedCars/' + id)
                    .then(response => {
                        this.reportedCars.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.$store.dispatch('message', 'Zgłoszenie zostało odwołane.')

                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            showDescription(description) {
                this.$refs['descriptionModal'].show(description)
            }


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
        components: {DatePicker, DescriptionModal},
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";


    .mx-datepicker {
        width: 100% !important;
    }
</style>
