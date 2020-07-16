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
                                        {{event.extendedProps.allDetails.car.year}}r.
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
                            <p>
                                {{event.extendedProps.allDetails.description}}
                            </p>
                        </div>
                    </div>
                    <div class="modal__action">
                        <template v-if="!isLoading">
                            <button class="modal__button modal__button--cancel"
                                    @click="cancel(event.extendedProps.allDetails.id)">
                                <i class="far fa-times-circle"></i>
                                Odwołano
                            </button>
                            <button class="modal__button modal__button--accept">
                                <i class="far fa-check-circle"></i>
                                Odebrano
                            </button>
                        </template>
                        <template v-else>
                            <div class="loading loading--static"></div>
                        </template>
                    </div>
                </div>
            </div>

        </div>

    </div>
</template>
<script>

    import axios from 'axios'

    export default {
        name: "EventModal",
        data() {
            return {
                isShow: false,
                event: null,
                option: null,
                isLoading: false

            }
        },
        methods: {
            close() {
                this.isShow = false

            },
            show(event, option) {
                this.isShow = true
                this.event = event
                this.option = option
            },
            cancel(id) {
                this.isLoading = true
                axios.delete('/reportedCars/' + id)
                    .then(response => {
                        alert('zaladowac na nowo eventy')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },


        },


    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/modal";
</style>
