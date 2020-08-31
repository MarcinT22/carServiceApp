<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Nowe zlecenia <span v-if="newEvents.length">({{newEvents.length}})</span>
            </h1>

            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div v-if="newEvents.length == 0" class="dashboard__empty">Brak</div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(newEvent, index) in newEvents">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <button class="block__delete" @click="remove(newEvent.id, index)">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            <div class="block__data">
                                <table>
                                    <tr>
                                        <td class="bold">Model:</td>
                                        <td> {{newEvent.reported_car.car.brand}} {{newEvent.reported_car.car.model}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{newEvent.reported_car.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{newEvent.reported_car.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{newEvent.reported_car.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Nr rej.:</td>
                                        <td>{{newEvent.reported_car.car.registration_number}}</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="block__action">
                                    <button href="#" class="block__actionBtn block__actionBtn--info"
                                            @click="showDescription(newEvent.reported_car.description)">
                                        <i class="fas fa-info-circle"></i> Opis usterki
                                    </button>
                                    <button href="#" class="block__actionBtn block__actionBtn--changeDate"
                                            @click="showDateInput = index, start=null" v-if="showDateInput != index">
                                        <i class="far fa-calendar-alt"></i> Zaplanuj naprawę
                                    </button>
                                </div>
                                <template v-if="showDateInput === index">
                                    <hr>
                                    <div class="block__newDate">
                                        <div class="block__text">
                                            <strong>Wybierz datę naprawy pojazdu:</strong>
                                        </div>
                                        <div class="block__date">

                                            <date-picker v-model="start" :editable="false"
                                                         :disabled-date="$disabledDatesOneDay"
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
                                                    @click="addToCalendar(newEvent.id, index)" v-if="start">
                                                <i class="far fa-check-circle"></i> Dodaj do kalendarza
                                            </button>
                                        </div>
                                    </div>
                                </template>
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


    export default {
        name: "NewEvents",
        data() {
            return {
                isLoading: true,
                newEvents: 0,
                showDateInput: null,
                start: null,
            }
        },
        methods: {
            addToCalendar(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.put('/events/' + id, {
                    start: this.start
                })
                    .then(response => {
                        this.newEvents.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.$store.dispatch('message', 'Zlecenie zostało dodane do kalendarza.')
                        this.start = null
                        this.showDateInput = null
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            remove(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.put('/events/' + id, {
                    status_id: 5
                })
                    .then(response => {
                        this.newEvents.splice(index, 1);
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
            axios.get('/getNewEvents')
                .then(response => {
                    this.newEvents = response.data.data
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
