<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Nowe zgłoszenie
            </h1>
            <div class="dashboard__right" v-if="!isChosen">
                <router-link :to="{name:'AddCar'}" class="dashboard__actionBtn dashboard__actionBtn--accept"><i class="fas fa-plus-circle"></i>
                    Dodaj nowy samochód
                </router-link>
            </div>
            <div class="block block--baseline block--noOverflow">

                <div class="block__border">
                    <div class="block__cancel" v-if="isChosen" @click="cancel">
                        <i class="far fa-times-circle"></i>
                    </div>
                    <div class="block__data" v-if="isChosen">
                        <h2 class="left small">
                            Dane pojazdu:
                        </h2>
                        <div class="block__data">
                            <table>
                                <tr>

                                    <td class="bold">Model:</td>
                                    <td> {{car.brand}} {{car.model}}</td>
                                </tr>
                                <tr>
                                    <td class="bold">Rok:</td>
                                    <td>{{car.year}}</td>
                                </tr>
                                <tr>
                                    <td class="bold">Paliwo:</td>
                                    <td>{{car.fuel}}</td>
                                </tr>
                                <tr>
                                    <td class="bold">Silnik:</td>
                                    <td> {{car.engine}} cm<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <td class="bold">Nr rej.:</td>
                                    <td>{{car.registration_number}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="block__search" v-else>
                        <div class="block__field">
                            <label for="car" class="large">Wyszukaj pojazd</label>
                            <div class="block__relative">
                                <input type="text" id="car" placeholder="Wpisz numer rejestracyjny"
                                       v-model="search" v-on:input="inputChange" @blur="hiddenList" class="uppercase"
                                       autocomplete="off">
                                <ul class="block__list" v-if="showCars">
                                    <li v-for="car in filteredCarList" @click="chooseCar(car)">
                                        {{car.brand}} {{car.model}}, {{car.year}}r., silnik {{car.engine}}cm<sup>3</sup>,
                                        nr rej. {{car.registration_number}}
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="block__border" v-if="isChosen">
                    <h2 class="left small">
                        Informacje
                    </h2>
                    <div class="block__field">
                        <label for="car" class="margin">Opis usterki</label>
                        <textarea v-model="description"></textarea>
                    </div>
                    <div class="block__field block__field--border">
                        <label>
                            <input type="checkbox" v-model="isDelivered"> Pojazd został dostarczony do warsztatu
                        </label>
                        <div class="block__date" v-if="!isDelivered">
                            <label class="margin">Data dostarczenia pojazdu:</label>
                            <date-picker v-model="reported_car_date" :editable="false"
                                         :disabled-date="$disabledDatesOneDay"
                                         type="date" format="DD.MM.YYYY"
                                         placeholder="Wybierz datę"
                                         id="date"></date-picker>
                        </div>
                    </div>
                </div>
                <div class="block__error block__error--large" v-if="isError">
                    {{errorMessage}}
                </div>
                <div class="block__action" v-if="isChosen && !isError && !isAdding && description">
                    <button class="block__actionBtn block__actionBtn--accept" @click="addNewReportedCar">
                        Dodaj zgłoszenie
                    </button>
                </div>
                <div class="loading loading--normal" v-if="isAdding"></div>

            </div>
        </div>
    </div>


</template>

<script>
    import {mapGetters} from 'vuex'
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';
    import moment from 'moment'
    import axios from 'axios'

    export default {
        name: "NewReportedCar",
        computed: mapGetters(['isLoading']),
        data() {
            return {
                showCars: false,
                search: null,
                car: null,
                isChosen: false,
                description: null,
                reported_car_date: null,
                isDelivered: true,
                isError:false,
                errorMessage:null,
                isAdding:false
            }
        },
        created() {
            this.$store.dispatch('getCars')
        },
        methods: {
            inputChange() {
                if (this.search.length >= 3) {

                    this.showCars = true
                } else {
                    this.showCars = false
                }

            },
            hiddenList() {
                setTimeout(() => {
                    this.showCars = false
                    this.search = ''
                }, 100)
            },

            chooseCar(car) {
                this.search = ''
                this.isChosen = true
                this.car = car
            },

            cancel() {
                this.isChosen = false
                this.car = null
                this.reported_car_date = null
                this.description = null
                this.isError = false
                this.errorMessage= null
                this.isDelivered = true
            },
            addNewReportedCar() {
                this.isAdding = true
                this.$store.state.isLoading = true
                let car_id = this.car.id
                let description = this.description
                let reported_car_date
                let is_delivered
                if (this.isDelivered) {
                    is_delivered = 1
                    reported_car_date = moment(String(new Date())).format('DD.MM.YYYY')
                }else{
                    let is_delivered = 0
                    reported_car_date = this.reported_car_date
                }
                let is_accepted = 1
                this.$store.dispatch('addNewReportedCar', {
                        car_id,
                        description,
                        reported_car_date,
                        is_accepted
                    }
                ).then((response) => {
                    if (response.data.data.message)
                    {
                        this.isError = true
                        this.errorMessage = 'Nie można zgłosić samochodu, ponieważ został już zgłoszony wcześniej.'

                    }else{
                        if (this.isDelivered)
                        {
                            axios.get('/confirmCarDelivery/' + response.data.data.reportedCar.id)
                        }
                        this.$store.dispatch('message', 'Zgłoszenie zostało dodane.')
                        this.cancel()

                    }

                    this.isAdding = false

                })
            }
        },
        computed: {
            filteredCarList() {
                return this.$store.getters.getCars.filter(car => {
                    return car.registration_number.toLowerCase().includes(this.search.toLowerCase())
                })
            }
        },
        components: {DatePicker},
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
</style>
