<template>
    <div class="login">

        <h1>
            <i class="fas fa-lock"></i>
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
            <button class="form__button tap-effect">Zaloguj</button>
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

            }
        },
        methods: {
            login() {
                this.$store.state.isLoading=true
                let registration_number = this.registration_number
                let vin = this.vin
                this.$store.dispatch('login', {
                        registration_number,
                        vin,
                    }
                )
                    .then(success=>{

                        if ( this.$store.getters.getZone == 'status')
                        {
                            this.$router.push('/status')
                        }else{
                            this.$router.push('/visit')
                        }
                    })
                    .catch(error => {
                        this.$store.state.isLoading=false
                        var errorsLabel = document.querySelectorAll(".form__error");

                        for (var i = 0; i < errorsLabel.length; i++) {
                            errorsLabel[i].parentElement.classList.remove('error');
                            errorsLabel[i].remove();

                        }
                            let errors = error.response.data.errors;
                            for (let error in errors) {
                                let field = document.getElementById(error);
                                field.parentElement.insertAdjacentHTML('beforeend', "<div class='form__error'>Proszę wprowadzić prawidłowe dane</div>");
                                field.parentElement.classList.add('error');
                            }

                        }
                    )
            }
        },
        created(){
            setTimeout(() => this.$store.state.isLoading=false, 500);
        },


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
                input {
                    border-color:#ff3e61 !important;
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
                &.error{
                    input{
                        border-color:red;
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

                &:focus {
                    border-color: $mainColor;
                    background: rgba(255, 255, 255, 1);
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