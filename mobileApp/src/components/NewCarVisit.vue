<template>
    <div class="visit">
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
        <form class="form" action="visit" @submit.prevent="setVisitWithNewCar">
            <h2>
                Dane pojazdu
            </h2>

            <div class="form__field">
                <label for="brand">
                    Marka
                </label>
                <input type="text" v-model="brand" autocomplete="off" id="brand" readonly
                       class="form__input form__input--readonly"
                       @click="showBrands">
                <ul :class="{active:showBrandsList}" id="brandsList">
                    <li v-for="(car, index) in carsList" @click="selectCar(index)">
                        {{car.brand}}
                    </li>
                </ul>
            </div>

            <div class="form__field" v-if="models.length">
                <label for="model">
                    Model
                </label>
                <input type="text" v-model="model" autocomplete="off" id="model" readonly
                       class="form__input form__input--readonly"
                       @click="showModels">
                <ul :class="{active:showModelsList}" id="modelsList">
                    <li v-for="model in models" @click="selectModel(model)">
                        {{model}}
                    </li>
                </ul>
            </div>

            <div class="form__field">
                <label for="year">
                    Rok produkcji
                </label>
                <input type="text" v-model="year" maxlength="4" autocomplete="off" id="year" class="form__input">
            </div>
            <div class="form__field">
                <label for="engine">
                    Pojemność silnika (cm<sup>3</sup>)
                </label>
                <input type="text" id="engine" v-model="engine" maxlength="4" class="form__input">
            </div>
            <div class="form__field">
                <label for="fuel">
                    Rodzaj paliwa
                </label>
                <input type="text" v-model="fuel" autocomplete="off" id="fuel" readonly
                       class="form__input form__input--readonly"
                       @click="showFuels">
                <ul :class="{active:showFuelsList}" id="fuelsList">
                    <li @click="selectFuel('Benzyna')">
                        Benzyna
                    </li>
                    <li @click="selectFuel('Diesel')">
                        Diesel
                    </li>
                    <li @click="selectFuel('Benzyna + LPG')">
                        Benzyna + LPG
                    </li>
                    <li @click="selectFuel('Hybryda')">
                        Hybryda
                    </li>
                    <li @click="selectFuel('Elektryczny')">
                        Elektryczny
                    </li>
                </ul>
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
                             :disabled-date="$disabledDates"
                             type="date" format="DD.MM.YYYY" :lang="lang"
                             id="date"></date-picker>
            </div>

            <button class="btn tap-effect">Umów wizytę</button>

        </form>
        <div class="blur" :class="{active:this.$store.state.blur}" @click="closeModal"></div>
    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';
    import axios from 'axios'

    import {mapGetters} from 'vuex'

    const today = new Date();
    today.setHours(0, 0, 0, 0);
    export default {
        name: "NewCarVisit",
        data() {
            return {
                carsList: null,
                models: [],
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
                showBrandsList: false,
                showModelsList: false,
                showFuelsList: false,

            }
        },
        methods: {
            setVisitWithNewCar() {
                this.$store.state.isLoading = true
                let brand = this.brand
                let model = this.model
                let year = this.year
                let fuel = this.fuel
                let engine = this.engine
                let registration_number = this.registration_number.toUpperCase()
                let vin = this.vin.toUpperCase()
                let description = this.description
                let reported_car_date = this.reported_car_date
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
            },
            selectCar(index) {
                this.model = null,
                    this.models = this.carsList[index].models;
                this.brand = this.carsList[index].brand;
                this.closeModal();
            },
            selectModel(model) {
                this.model = model;
                this.closeModal();
            },

            selectFuel(fuel) {
                this.fuel = fuel
                this.closeModal();
            },

            showBrands() {
                this.showBrandsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true

            },
            showModels() {
                this.showModelsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true

            },

            showFuels() {
                this.showFuelsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true
            },

            closeModal() {
                this.showBrandsList = false
                this.showModelsList = false
                this.showFuelsList = false
                this.$store.state.blur = false
                document.getElementById('brandsList').scrollTop = 0;
                let modelsList = document.getElementById('modelsList');
                if (modelsList) {
                    modelsList.scrollTop = 0;
                }
                document.getElementById('fuelsList').scrollTop = 0;
                document.body.classList.remove('overflow');
            }
        },
        created() {
            this.$store.state.blur = false
            axios.get('/getCarsModels')
                .then(response => {
                    this.carsList = response.data
                })

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
</style>
