<template>
    <div class="visit">
        <h1>
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.89em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 750 850"><path d="M533 194q-20 0-33-14t-14-33V55q0-20 14-34t33-13.5T566 21t13 34v92q0 20-13 33t-33 14zm-325 0q-19 0-32-14t-14-33V55q0-20 14-34t32-13q20 0 34 13t13 34v92q0 20-13 33t-34 14zm487-93q20 0 33 13t13 33v556q0 20-13 33t-33 14H46q-19 0-32-14T0 703V147q0-19 14-33t32-13h70v46q0 19 7 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h139v46q0 19 8 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h69zm-46 289q0-11-12-11H104q-11 0-11 11v255q0 12 11 12h533q12 0 12-12V390z" fill="#626262"/></svg>
            Umów wizytę
        </h1>
        <form class="form" action="visit" @submit.prevent="setVisitWithNewCar">
            <h2>
                Dane pojazdu
            </h2>
            <div class="form__field">
                <label for="brand">
                    Marka
                </label>
                <select v-model="brand" id="brand" class="form__input">
                    <option value="" selected disabled hidden>Wybierz markę</option>
                    <option>
                        Audi
                    </option>
                    <option>
                        BMW
                    </option>
                    <option>
                        Mercedes
                    </option>
                </select>
            </div>
            <div class="form__field">
                <label for="model">
                    Model
                </label>
                <select v-model="model" id="model" class="form__input">
                    <option value="" selected disabled hidden>Wybierz model</option>
                    <option>
                        A6
                    </option>
                    <option>
                        E36
                    </option>
                    <option>
                        C180
                    </option>
                </select>
            </div>
            <div class="form__field">
                <label for="year">
                    Rok produkcji
                </label>
                <input type="text" v-model="year" autocomplete="off" id="year" class="form__input">
            </div>
            <div class="form__field">
                <label for="engine">
                    Pojemność silnika
                </label>
                <input type="text" id="engine" v-model="engine" class="form__input">
            </div>
            <div class="form__field">
                <label for="fuel">
                    Rodzaj paliwa
                </label>
                <select v-model="fuel" id="fuel" class="form__input">
                    <option>
                        Benzyna
                    </option>
                    <option>
                        Diezel
                    </option>
                    <option>
                        Benzyna + LPG
                    </option>
                    <option>
                        Hybryda
                    </option>
                    <option>
                        Elektryczny
                    </option>
                </select>
            </div>
            <div class="form__field">
                <label for="registration_number">
                    Numer rejestracyjny
                </label>
                <input type="text" v-model="registration_number" autocomplete="off" id="registration_number"
                       class="form__input form__input--uppercase">
            </div>
            <div class="form__field">
                <label for="vin">
                    VIN
                </label>
                <input type="text" v-model="vin" autocomplete="off" id="vin"
                       class="form__input form__input--uppercase">
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
                <date-picker v-model="reported_car_date" input-class="form__date" :editable="false"
                             :disabled-date="disabledDates"
                             type="date" format="DD.MM.YYYY" :lang="lang"
                             id="date"></date-picker>
            </div>

            <button class="btn tap-effect">Umów wizytę</button>

        </form>
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
        name: "NewCarVisit",
        data() {
            return {
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
            disabledDates(date) {
                const day = new Date(date).getDay()
                return day === 0 || day === 6 || date < today;

            },
            setVisitWithNewCar() {
                this.$store.state.isLoading=true
                let brand = this.brand
                let model = this.model
                let year = this.year
                let fuel = this.fuel
                let engine = this.engine
                let registration_number = this.registration_number.toUpperCase()
                let vin = this.vin.toUpperCase()
                let description = this.description
                let reported_car_date =this.reported_car_date
                this.$store.dispatch('setVisitWithNewCar', {
                        brand,
                        model,
                        year,
                        fuel,
                        engine,
                        registration_number,
                        vin,
                        description,
                        reported_car_date
                    }
                )
                    .then(() => this.$router.push('/message'))
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
                                }else{
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
            },
        },
        created() {
            setTimeout(() => this.$store.state.isLoading = false, 500);
        },
        components: {DatePicker},
    }
</script>
<style lang="scss">

    .form {

        &__error {
            font-size: 13px;
            color: #ff3e61;
            margin-top: 3px;
        }

        &__field {
            &.error {
                input,select {
                    border-color: #ff3e61 !important;
                }
            }

        }
    }

</style>
<style lang="scss">
    @import "../assets/scss/config";

    $default-color: #555 !important;
    $primary-color: $mainColor;

    @import '~vue2-datepicker/scss/index.scss';
    .mx-calendar-header-label {
        button {
            font-weight: bold !important;
            font-size: 16px !important;
        }
    }

    .mx-calendar {
        width: 290px !important;
    }

    .mx-table-date {
        th {
            font-weight: bold !important;
            font-size: 16px !important;
        }

        td {
            font-size: 16px !important;

            &.disabled {
                opacity: 0.6 !important;
            }

            &.today {
                background: rgba(97, 190, 247, 0.42) !important;
            }

            &.active {
                background: $mainColor !important;
            }
        }

        .mx-date-row {
            td:last-child {
                color: #ff345c !important;
                color: #ff345c !important;
            }

        }
    }

    .mx-datepicker {
        width: 100% !important;
    }

    .form__date {

        border-radius: 5px;
        border: 1px solid #999999;
        padding: 10px;
        box-sizing: border-box;
        height: 40px;
        width: 100%;
        outline: none;
        font-size: 16px;
        color: $mainColor;
        font-weight: 400;
        background: #f7f7f7;
        transition: border-color 0.3s ease-in-out, background 0.3s ease-in-out;

        &:focus {
            border-color: $mainColor;
            background: rgba(255, 255, 255, 0.5);
        }


    }

</style>
<style scoped lang="scss">
    @import "../assets/scss/config";


    .visit {
        .form {
            padding-bottom: 30px;

            label {
                font-size: 14px;
                color: #555;
                font-weight: 400;
                display: block;
                margin-bottom: 5px;


            }

            &__field {
                margin-bottom: 13px;
            }

            &__input {
                border-radius: 5px;
                border: 1px solid #999999;
                padding: 10px;
                box-sizing: border-box;
                height: 40px;
                width: 100%;
                outline: none;
                font-size: 16px;
                color: $mainColor;
                font-weight: 400;
                background: #f7f7f7;
                transition: border-color 0.3s ease-in-out, background 0.3s ease-in-out;

                &:focus {
                    border-color: $mainColor;
                    background: rgba(255, 255, 255, 1);
                }

                &--uppercase {
                    text-transform: uppercase;
                }

                &--textarea {
                    resize: none;
                    height: 200px;
                    font-size: 14px;
                }

                option {
                    border: 0;
                    box-shadow: none;
                }
            }

            &__button {
                width: 100%;
                margin-top: 10px;
                outline: none;
                border: 0;
                width: 100%;
                max-width: 290px;
                box-sizing: border-box;
                margin: 0 auto;
                text-align: center;
                font-size: 16px;
                color: #fff;
                background: url('../img/background_2.jpg') no-repeat;
                background-size: cover;
                display: block;
                padding: 15px 10px;
                border-radius: 5px;
                margin-top: 30px;
            }
        }
    }
</style>