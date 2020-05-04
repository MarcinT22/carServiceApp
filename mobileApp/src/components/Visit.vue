<template>
    <div class="visit">

        <h1>
            <i class="far fa-calendar-alt"></i>
            Umów wizytę
        </h1>
        <form class="form">
            <div>
                <h2>
                    Dane pojazdu
                </h2>
                <div class="form__field">
                    <label for="brand">
                        Marka
                    </label>
                    <select name="" id="brand" class="form__input">
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
                    <select name="" id="model" class="form__input">
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
                    <input type="text" autocomplete="off" id="year" class="form__input">
                </div>
                <div class="form__field">
                    <label for="engine">
                        Pojemność silnika
                    </label>
                    <input type="text" id="engine" class="form__input">
                </div>
                <div class="form__field">
                    <label for="fuel">
                        Rodzaj paliwa
                    </label>
                    <select name="" id="fuel" class="form__input">
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
                    <input type="text" autocomplete="off" id="registration_number"
                           class="form__input form__input--uppercase">
                </div>
                <div class="form__field">
                    <label for="vin">
                        VIN
                    </label>
                    <input type="text" autocomplete="off" id="vin" class="form__input form__input--uppercase">
                </div>
            </div>
            <h2>
                Opis usterki / wymiany podzespołu
            </h2>
            <div class="form__field">
                <label for="description">
                    Opis usterki pojazdu
                </label>
                <textarea id="description" class="form__input form__input--textarea"></textarea>
            </div>

            <h2>
                Data dostarczenia pojazdu
            </h2>
            <div class="form__field">
                <label for="date">
                    Wybierz datę
                </label>
                <date-picker v-model="date" input-class="form__date" :editable="false" :disabled-date="disabledDates"
                             type="date" format="DD.MM.YYYY" :lang="lang"
                             id="date"></date-picker>
            </div>

            <div class="form__button tap-effect">
                <input type="submit" value="Umów wizytę">
            </div>
        </form>

    </div>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';

    const today = new Date();
    today.setHours(0, 0, 0, 0);
    export default {
        name: "Visit",
        data() {
            return {
                date: null,
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

            }
        },
        components: {DatePicker},
    }
</script>
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

                option{
                    border:0;
                    box-shadow: none;
                }
            }

            &__button {
                width: 100%;
                margin-top: 30px;

                input {
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
                }
            }
        }
    }
</style>