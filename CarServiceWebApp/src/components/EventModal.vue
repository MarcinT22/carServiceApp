<template>
    <div>
        <div class="modal" :class="{'modal--show':isShow}">
            <div class="modal__blur" @click="close"></div>
            <div class="modal__container">
                <div class="modal__block">
                    <div class="modal__header">
                        <i class="fas fa-info-circle"></i> Szczegóły
                        <a href="#" @click.prevent="close" class="modal__close">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                    <template v-if="option == 'delivery'">
                        <div class="modal__content" v-if="event">
                            <div class="modal__text">
                                <table>
                                    <tr>
                                        <td>
                                            Model:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.car.brand}}
                                            {{event.extendedProps.allDetails.car.model}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Rok:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.car.year}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Paliwo:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.car.fuel}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Silnik:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.car.engine}}cm<sup>3</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nr rejestracyjny:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.car.registration_number}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Data dostarczenia:
                                        </td>
                                        <td>
                                            <template v-if="event.extendedProps.allDetails.new_reported_car_date">
                                                {{$formatDate(event.extendedProps.allDetails.new_reported_car_date)}}
                                            </template>
                                            <template v-else>
                                                {{$formatDate(event.extendedProps.allDetails.reported_car_date)}}
                                            </template>
                                        </td>
                                    </tr>
                                </table>
                                <hr>
                                <strong>
                                    Opis usterki:<br/>
                                </strong>
                                <p class="modal__scroll">
                                    {{event.extendedProps.allDetails.description}}
                                </p>
                            </div>
                        </div>
                        <div class="modal__action">
                            <template v-if="!isLoading">
                                <button class="modal__button modal__button--cancel"
                                        @click="cancelCarDelivery(event.id)">
                                    <i class="far fa-times-circle"></i>
                                    Odwołano
                                </button>
                                <button class="modal__button modal__button--accept"
                                        @click="confirmCarDelivery(event.id)">
                                    <i class="far fa-check-circle"></i>
                                    Odebrano
                                </button>
                            </template>
                            <template v-else>
                                <div class="loading loading--static"></div>
                            </template>
                        </div>
                    </template>
                    <template v-if="option == 'repair'">
                        <div class="modal__content modal__content--flex" v-if="event">
                            <div class="modal__text">
                                <table>
                                    <tr>
                                        <td>
                                            Model:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.reported_car.car.brand}}
                                            {{event.extendedProps.allDetails.reported_car.car.model}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Rok:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.reported_car.car.year}}r.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Paliwo:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.reported_car.car.fuel}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Silnik:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.reported_car.car.engine}}cm<sup>3</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nr rejestracyjny:
                                        </td>
                                        <td>
                                            {{event.extendedProps.allDetails.reported_car.car.registration_number}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="modal__text">
                                <strong>
                                    Opis usterki:<br/>
                                </strong>
                                <div class="modal__scroll">
                                    {{event.extendedProps.allDetails.reported_car.description}}
                                </div>
                            </div>
                        </div>

                        <div class="modal__content modal__content--notPaddingTop">
                            <div class="modal__text modal__text--paddingBottom">
                                <button class="modal__button modal__button--danger" v-if="status != 5 && !isNewFault"
                                        @click="isNewFault = !isNewFault">
                                    <i class="far fa-bell"></i> Wykryto nową usterkę
                                </button>
                                <div class="modal__text" v-if="isNewFault">
                                    <strong>
                                        Opis wykrytej usterki:<br/>
                                    </strong>
                                    <textarea v-model="faultDescription"
                                              placeholder="Wprowadź opis..."></textarea>
                                    <div class="modal__action modal__action--noBorder modal__action--noPadding">
                                        <template v-if="!alertIsLoading">
                                        <button class="modal__button modal__button--cancel modal__button--marginTop"
                                                @click="isNewFault = !isNewFault">
                                            <i class="far fa-times-circle"></i> Anuluj
                                        </button>
                                        <button class="modal__button modal__button--accept modal__button--marginTop"
                                                v-if="faultDescription" @click="sendAlert(event.id,faultDescription)">
                                            <i class="far fa-bell"></i> Powiadom klienta
                                        </button>
                                        </template>
                                        <div class="loading loading--static" v-if="alertIsLoading"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal__text modal__text--padding modal__text--hightlight" v-if="showAcceptedAlerts">
                                <strong>
                                    Nowe usterki zatwierdzone przez klienta:<br/>
                                </strong>
                                <div class="modal__scroll modal__scroll--marginTop">
                                    <ol>
                                        <li v-for="acceptedAlert in getAcceptedAlerts">
                                           {{acceptedAlert.description}}
                                        </li>
                                    </ol>
                                </div>

                            </div>
                            <div class="modal__text">
                                <strong>
                                    Opis naprawy:<br/>
                                </strong>
                                <textarea v-model="description" :disabled="status == 5"
                                          placeholder="Wprowadź tekst..."></textarea>
                            </div>
                            <div class="modal__text">
                                <div class="modal__details">
                                    <div>
                                        <strong>
                                            Cena:<br/>
                                        </strong>
                                        <input v-model="price" type="number" :disabled="status == 5" min="0.00"
                                               step="0.01"/>
                                    </div>
                                    <div>
                                        <strong>
                                            Status:<br/>
                                        </strong>
                                        <select v-model="status_id" :disabled="status == 5">
                                            <option :value="status.id" v-for="status in getStatusesList">
                                                {{status.name}}
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal__action">
                            <template v-if="!isLoading">
                                <button v-if="status != 5" class="modal__button modal__button--accept"
                                        @click="save(event.id)">
                                    <i class="far fa-save"></i>
                                    Zapisz
                                </button>
                            </template>
                            <template v-else>
                                <div class="loading loading--static"></div>
                            </template>
                        </div>
                    </template>
                </div>
            </div>

        </div>
    </div>
</template>
<script>

    import axios from 'axios'
    import {mapGetters} from 'vuex'

    export default {
        name: "EventModal",
        data() {
            return {
                isShow: false,
                event: null,
                option: null,
                description: null,
                price: '0.00',
                status_id: 1,
                status: 1,
                isLoading: false,
                alertIsLoading: false,
                isNewFault: false,
                faultDescription: null,


            }
        },
        methods: {
            close() {
                this.isShow = false
                document.body.classList.remove('overflow');
                setTimeout(() => {
                    this.description = null
                    this.price = '0.00'
                    this.status_id = 1
                    this.isNewFault = false
                    this.alertIsLoading = false
                    this.$store.state.showAcceptedAlerts = false

                }, 500);
            },

            show(event, option) {
                if (option == 'repair') {
                    this.price = event.extendedProps.allDetails.price.toFixed(2);
                    this.status_id = event.extendedProps.allDetails.status_id
                    this.status = event.extendedProps.allDetails.status_id
                    this.description = event.extendedProps.allDetails.description
                    this.$store.dispatch('getStatusList')
                    this.$store.dispatch('getAcceptedAlert',event.id)
                }
                document.body.classList.add('overflow');
                this.isShow = true
                this.event = event
                this.option = option

            },
            cancelCarDelivery(id) {
                this.isLoading = true

                axios.delete('/reportedCars/' + id)
                    .then(response => {
                        this.$store.dispatch('getAcceptedReportedCars')
                        this.isLoading = false
                        this.$store.dispatch('message', 'Zgłoszenie zostało odwołane.')
                        this.close()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            confirmCarDelivery(id) {
                this.isLoading = true
                axios.get('/confirmCarDelivery/' + id)
                    .then(response => {
                        this.$store.dispatch('getAcceptedReportedCars')
                        this.isLoading = false
                        this.$store.dispatch('message', 'Samochód został dostarczony do warsztatu.')
                        this.close()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            save(id) {
                this.isLoading = true
                axios.put('/events/' + id, {
                    description: this.description,
                    status_id: this.status_id,
                    price: this.price,
                })
                    .then(response => {
                        this.$store.dispatch('getSheduledEvents')
                        this.close()
                        this.isLoading = false
                        this.$store.dispatch('message', 'Zapisano.')

                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            sendAlert(event_id ,alert) {
                this.alertIsLoading = true
                this.$store.dispatch('sendAlert',{
                    event_id: event_id,
                    description: alert,
                })
                    .then(()=>{
                        setTimeout(() => {
                            this.isNewFault = false
                            this.alertIsLoading = false
                            this.$store.dispatch('message', 'Wysłano powiadomienie do klienta.')
                            this.faultDescription = null
                        }, 500);
                    })
                    .catch(error => {
                        console.log(error)
                    })

            },



        },
        computed: mapGetters(['getStatusesList','getAcceptedAlerts','showAcceptedAlerts']),



    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/modal";
</style>
