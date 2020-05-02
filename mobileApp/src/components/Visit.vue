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
                    <input type="text" id="brand" class="form__input">
                </div>
                <div class="form__field">
                    <label for="model">
                        Model
                    </label>
                    <input type="text" id="model" class="form__input">
                </div>
                <div class="form__field">
                    <label for="year">
                        Rok produkcji
                    </label>
                    <input type="text" id="year" class="form__input">
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
                    <input type="text" id="fuel" class="form__input">
                </div>
                <div class="form__field">
                    <label for="registration_number">
                        Numer rejestracyjny
                    </label>
                    <input type="text" id="registration_number" class="form__input form__input--uppercase">
                </div>
                <div class="form__field">
                    <label for="vin">
                        VIN
                    </label>
                    <input type="text" id="vin" class="form__input form__input--uppercase">
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
                <input type="text" id="date" class="form__input">
            </div>

            <touch-ripple class="form__button">
                <input type="submit" value="Umów wizytę">
            </touch-ripple>
        </form>

    </div>
</template>

<script>

    export default {
        name: "Visit"
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .visit {
        .form {
            padding-bottom:30px;

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
                    background: rgba(255, 255, 255, 0.5);
                }

                &--uppercase {
                    text-transform: uppercase;
                }

                &--textarea {
                    resize: none;
                    height: 200px;
                    font-size:14px;
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
                    background: url('../assets/image/background_2.jpg') no-repeat;
                    background-size: cover;
                    display: block;
                    padding: 15px 10px;
                    border-radius: 15px;
                }
            }
        }
    }
</style>