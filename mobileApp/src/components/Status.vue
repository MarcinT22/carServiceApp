<template>
    <div class="status">
        <template v-if="empty">
            <div class="status__container" :class="{active:show}">
                <div class="status__message">
                    Brak zgłoszeń
                </div>
                <button class="btn tap-effect" @click="goToHome">
                    OK
                </button>
            </div>
        </template>
        <template v-else>
            <h1>
                <i class="fas fa-project-diagram"></i>
                Status zgłoszenia
            </h1>

            <div class="status__container" :class="{active:show}">
                <template v-if="status != null">
                    <div class="status__block" :style="{background:status.color}" v-if="status.id != 5">
                        {{status.name}}
                    </div>
                    <div class="status__block status__block--default" v-else>
                        Pojazd nie został zgłoszony do naprawy
                    </div>

                    <button class="btn tap-effect" @click="goToHome">
                        OK
                    </button>
                </template>
                <template v-else>
                    <template v-if="getReportedCar.is_accepted">
                        <div class="status__block status__block--accepted">
                            Zgłoszenie zostało przyjęte.<br/>Prosimy dostarczyć pojazd dnia:<br/>
                            <strong>
                                <template v-if="getReportedCar.new_reported_car_date">
                                    {{formatDate(getReportedCar.new_reported_car_date)}}
                                </template>
                                <template v-else>
                                    {{formatDate(getReportedCar.reported_car_date)}}
                                </template>
                            </strong>

                            w godzinach<br/>8:00 - 17:00
                        </div>

                        <button class="btn tap-effect" @click="goToHome">
                            OK
                        </button>
                    </template>
                    <template v-else>
                        <div v-if="getReportedCar.new_reported_car_date && !getReportedCar.is_accepted"
                             class="status__message">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false"
                                 width="1em" height="1em"
                                 style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                                <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z"
                                      fill="#626262"/>
                                <path d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"
                                      fill="#626262"/>
                                <rect x="0" y="0" width="1024" height="1024" fill="rgba(0, 0, 0, 0)"/>
                            </svg>
                            Przepraszamy, dostarczenie pojazdu w dniu<br/><strong>{{formatDate(getReportedCar.reported_car_date)}}r.</strong>
                            jest niemożliwe.<br/><br/>
                            Proponujemy dostarczyć pojazd dnia<br/><strong>{{formatDate(getReportedCar.new_reported_car_date)}}r.</strong><br/>w
                            godzinach 8:00 - 17:00.

                            <div class="status__buttons">
                                <button @click="accept(getReportedCar.id)">Akceptuję</button>
                                <button @click="cancel(getReportedCar.id)">Anuluję zgłoszenie</button>
                            </div>
                        </div>
                        <template v-else>
                            <div class="status__block">
                                Zgłoszenie oczekuje na akceptację przez warsztat
                            </div>

                            <button class="btn tap-effect" @click="goToHome">
                                OK
                            </button>
                        </template>
                    </template>
                </template>


            </div>

        </template>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import moment from 'moment'
    import axios from 'axios'

    export default {
        name: "Status",
        data() {
            return {
                status: {type: Object, default: () => ({})},
                show: false,
                empty: null,
            }
        },

        computed: mapGetters(['getReportedCar']),
        methods: {
            formatDate(date) {
                return moment(String(date)).format('DD.MM.YYYY')
            },

            accept(id) {
                this.$store.state.isLoading = true
                axios.get('/acceptReportedCar/' + id)
                    .then(response => {
                        this.$store.getters.getReportedCar.is_accepted = 1;
                        this.$store.state.isLoading = false
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            cancel(id) {
                this.$store.state.isLoading = true
                this.$store.state.isLoading = true
                axios.delete('/reportedCars/' + id)
                    .then(response => {
                        this.$store.state.messageType = 'cancel'
                        this.$router.push('message');
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },

            goToHome() {
                this.$store.state.isLoading = true
                this.$router.push('/')
            }

        },
        created() {
            if ((this.$store.getters.getCar.reported_cars).length) {
                let reportedCarId = this.$store.getters.getReportedCar.id;
                this.$store.dispatch('getStatus', reportedCarId)
                    .then(success => {
                        this.status = this.$store.getters.getEventStatus
                        this.show = true
                    })
                    .catch(error => {
                            this.$store.state.isLoading = false
                        }
                    )
            } else {
                this.empty = true
                this.show = true
            }
            setTimeout(() => this.$store.state.isLoading = false, 500);
        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .status {
        &__block {
            margin: 40px 0;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            background: #333;
            font-size: 16px;
            text-align: center;
            color: #fff;
            box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.2);
            line-height: 160%;

            &--default {
                box-shadow: none;
                background: none;
                color: $mainColor;
                padding: 0;
                font-size: 16px;
            }

            &--accepted {
                font-size: 16px;
                background: $mainColor;
            }
        }

        &__container {
            opacity: 0;
            position: relative;
            top: -20px;
            transition: opacity 0.3s ease-in-out, top 0.3s ease-in-out;

            &.active {
                opacity: 1;
                top: 0;
            }
        }

        &__message {
            font-size: 15px;
            color: $mainColor;
            text-align: center;

            .icon {
                font-size: 40px;
                display: block;
                margin: 0 auto;

                path {
                    fill: $mainColor;
                }

            }
        }

        &__buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 40px;

            button {
                border: 2px solid;
                border-radius: 5px;
                margin: 0 5px;
                padding: 10px 2px;
                background: none;
                width: 100%;
                font-weight: bold;
                font-size: 14px;
                transition: background 0.1s, color 0.1s;
                outline: none;

                &:first-child {
                    border-color: $successColor;
                    color: $successColor;

                    &:active {
                        background: $successColor;
                        color: #fff;
                    }
                }

                &:last-child {
                    border-color: $errorColor;
                    color: $errorColor;

                    &:active {
                        background: $errorColor;
                        color: #fff;
                    }
                }
            }
        }


    }
</style>
