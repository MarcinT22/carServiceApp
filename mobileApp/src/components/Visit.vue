<template>
    <div class="visit">
        <template>
        <h1>
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 aria-hidden="true" focusable="false" width="0.89em" height="1em"
                 style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 750 850">
                <path d="M533 194q-20 0-33-14t-14-33V55q0-20 14-34t33-13.5T566 21t13 34v92q0 20-13 33t-33 14zm-325 0q-19 0-32-14t-14-33V55q0-20 14-34t32-13q20 0 34 13t13 34v92q0 20-13 33t-34 14zm487-93q20 0 33 13t13 33v556q0 20-13 33t-33 14H46q-19 0-32-14T0 703V147q0-19 14-33t32-13h70v46q0 19 7 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h139v46q0 19 8 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h69zm-46 289q0-11-12-11H104q-11 0-11 11v255q0 12 11 12h533q12 0 12-12V390z"
                      fill="#626262"/>
            </svg>
            Umów wizytę
        </h1>
        <form class="form" action="visit" @submit.prevent="setVisit">
            <h2>
                Pojazd
            </h2>
            <div class="carData">
                <div>
                    <span>Model:</span>{{getCar.brand}} {{getCar.model}}
                </div>
                <div>
                    <span>Nr rejestracyjny:</span>{{getCar.registration_number}}
                </div>
                <div>
                    <span>Rok produkcji:</span>{{getCar.year}}
                </div>
                <div>
                    <span>Silnik:</span>{{getCar.engine}}cm<sup>3</sup>
                </div>
                <div>
                    <span>Rodzaj paliwa:</span>{{getCar.fuel}}
                </div>
            </div>
            <h2>
                Opis usterki / wymiany podzespołu
            </h2>
            <div class="form__field">
                <label for="description">
                    Opis usterki pojazdu
                </label>
                <textarea id="description" v-model="description" class="form__input form__input--textarea"></textarea>
            </div>

            <h2>
                Data dostarczenia pojazdu
            </h2>
            <div class="form__field" id="dateField">
                <label for="date">
                    Wybierz datę
                </label>
                <date-picker id="date" v-model="reported_car_date" input-class="form__date" :editable="false"
                             :disabled-date="$disabledDates"
                             type="date" format="DD.MM.YYYY" :lang="lang"
                ></date-picker>
            </div>

            <button class="btn tap-effect">Umów wizytę</button>

        </form>
        </template>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';

    import {mapGetters} from 'vuex'

    const today = new Date();
    today.setHours(0, 0, 0, 0);
    export default {
        name: "Visit",
        computed: mapGetters(['getCar', 'getReportedCar']),
        data() {
            return {
                car_id: this.$store.getters.getCar.id || {type: Object, default: () => ({})},
                reported_cars:this.$store.getters.getCar.reported_cars,
                brand: '',
                model: '',
                year: '',
                fuel: '',
                engine: '',
                registration_number: '',
                vin: '',
                description: '',
                reported_car_date: null,
                lang: {
                    formatLocale: {
                        firstDayOfWeek: 1,
                    },
                    monthBeforeYear: true,

                },

            }
        },
        methods: {
            goToHome(){
                this.$store.state.isLoading = true
                this.$router.push('/')
            },

            setVisit() {
                this.$store.state.isLoading = true
                let car_id = this.car_id
                let description = this.description
                let reported_car_date = this.reported_car_date
                this.$store.dispatch('setVisitWithMyCar', {
                        car_id,
                        description,
                        reported_car_date
                    }
                )
                    .then(() => {
                        this.$store.state.messageType = 'visit',
                            this.$router.push('/message')
                    })
                    .catch(error => {

                            this.$store.state.isLoading = false
                            var errorsLabel = document.querySelectorAll(".form__error");

                            for (var i = 0; i < errorsLabel.length; i++) {
                                errorsLabel[i].parentElement.classList.remove('error');
                                errorsLabel[i].remove();

                            }

                            let errors = error.response.data.errors;
                            for (let error in errors) {
                                if (error != 'reported_car_date') {
                                    let field = document.getElementById(error);
                                    field.parentElement.insertAdjacentHTML('beforeend', "<div class='form__error'>Proszę wprowadzić prawidłowe dane</div>");
                                    field.parentElement.classList.add('error');
                                } else {
                                    let datefield = document.getElementById('dateField')
                                    datefield.classList.add('error')
                                    var errorText = document.createElement("div")
                                    errorText.classList.add('form__error')
                                    errorText.appendChild(document.createTextNode('Proszę wybrać datę'));
                                    datefield.appendChild(errorText);
                                }
                            }

                        }
                    )
            }
        },
        created() {
            setTimeout(() => this.$store.state.isLoading = false, 500);



        },
        components: {DatePicker},
    }
</script>
<style lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/calendar";
    @import "../assets/scss/formError";

</style>
<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/form";

    .carData{
        display: flex;
        flex-direction: column;
        font-size:14px;
        span{
            font-weight: bold;
            min-width:120px;
            display: inline-block;
            margin-right:10px;
            font-size:13px;
        }
    }

    .visit{
        &__text{
            text-align: center;
            font-size:16px;
            color:$mainColor;
        }
    }

</style>
