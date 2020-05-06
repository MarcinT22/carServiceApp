<template>
    <div class="login">

        <h1>
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 aria-hidden="true" focusable="false" width="1em" height="1em"
                 style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                <path d="M368 192h-16v-80a96 96 0 1 0-192 0v80h-16a64.07 64.07 0 0 0-64 64v176a64.07 64.07 0 0 0 64 64h224a64.07 64.07 0 0 0 64-64V256a64.07 64.07 0 0 0-64-64zm-48 0H192v-80a64 64 0 1 1 128 0z"
                      fill="#626262"/>
            </svg>
            Logowanie
        </h1>

        <form action="login" class="form" @submit.prevent="login">
            <div class="form__field">
                <label for="registration_number">
                    Numer rejestracyjny
                </label>
                <input type="text" autocomplete="off" id="registration_number" v-model="registration_number"
                       class="form__input">
            </div>
            <div class="form__field">
                <label for="vin">
                    5 ostatnich znaków VIN
                </label>
                <input type="text" id="vin" autocomplete="off" maxlength="5" v-model="vin" class="form__input">
            </div>
            <button class="btn tap-effect">Zaloguj</button>
            <div class="errorMessage" v-if="errorMessage">
                Wprowadzone dane są nieprawidłowe.
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                registration_number: "",
                vin: "",
                errorMessage:false,

            }
        },
        methods: {
            login() {
                this.$store.state.isLoading = true
                let registration_number = this.registration_number
                let vin = this.vin
                this.$store.dispatch('login', {
                        registration_number,
                        vin,
                    }
                )
                    .then(success => {

                        if (this.$store.getters.getZone == 'status') {
                            this.$router.push('/status')
                        } else {
                            this.$router.push('/visit')
                        }
                    })
                    .catch(error => {
                        this.$store.state.isLoading = false
                        var errorsLabel = document.querySelectorAll(".form__error");

                        for (var i = 0; i < errorsLabel.length; i++) {
                            errorsLabel[i].parentElement.classList.remove('error');
                            errorsLabel[i].remove();

                        }

                            if (error.response.status == 401) {

                                this.errorMessage=true
                            } else {


                                let dataErrors = error.response.data.errors;
                                for (let dataError in dataErrors) {
                                    let field = document.getElementById(dataError);

                                    field.parentElement.insertAdjacentHTML('beforeend', "<div class='form__error'>"+error.response.data.errors[dataError]+"</div>");
                                    field.parentElement.classList.add('error');
                                }

                            }
                        }
                    )
            }
        },
        created() {
            setTimeout(() => this.$store.state.isLoading = false, 500);
        },


    }
</script>
<style lang="scss">
    @import "../assets/scss/config";

    .form {

        &__error {
            font-size: 13px;
            color: $errorColor;
            margin-top: 3px;
        }

        &__field {
            &.error {
                input {
                    border-color: $errorColor !important;
                }
            }

        }
    }

</style>
<style scoped lang="scss">
    @import "../assets/scss/config";


    .login {
        .form {

            label {
                font-size: 14px;
                color: #555;
                font-weight: 400;
                display: block;
                margin-bottom: 5px;
                text-align: center;

                &.error {
                    input {
                        border-color: $errorColor;
                    }
                }

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
                background: #f7f7f7;
                font-weight: 400;
                text-transform: uppercase;
                transition: border-color 0.3s ease-in-out, background 0.3s ease-in-out;
                font-family: 'Open Sans', sans-serif;

                &:focus {
                    border-color: $mainColor;
                    background: rgba(255, 255, 255, 1);
                }
            }


        }

    }
</style>