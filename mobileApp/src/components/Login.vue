<template>
    <div class="login">

        <h1>
            <i class="fas fa-lock"></i>
            Logowanie
        </h1>

        <form class="form">
            <div class="form__field">
                <label for="registration_number">
                    Numer rejestracyjny
                </label>
                <input type="text" autocomplete="off" id="registration_number" class="form__input">
            </div>
            <div class="form__field">
                <label for="vin">
                    5 ostatnich znaków VIN
                </label>
                <input type="text" id="vin" autocomplete="off" maxlength="5" class="form__input">
            </div>
            <div class="form__button tap-effect">
                <input type="submit" value="Zaloguj">
            </div>
        </form>



    </div>
</template>

<script>
    export default {
        name: "Login",

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .login{
        .form {

            label {
                font-size: 14px;
                color: #555;
                font-weight: 400;
                display: block;
                margin-bottom: 5px;
                text-align: center;

            }

            &__field {
                margin-bottom: 20px;
            }

            &__input {
                border-radius: 5px;
                border: 1px solid #999999;
                padding: 10px;
                box-sizing: border-box;
                height: 45px;
                width: 100%;
                outline: none;
                font-size: 22px;
                text-align: center;
                color: $mainColor;
                background:#f7f7f7;
                font-weight: 400;
                text-transform: uppercase;
                transition: border-color 0.3s ease-in-out, background 0.3s ease-in-out;

                &:focus {
                    border-color: $mainColor;
                    background: rgba(255, 255, 255, 1);
                }
            }

            &__button {
                width: 100%;
                margin-top: 10px;

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
                    margin-top:30px;
                }
            }
        }
    }
</style>