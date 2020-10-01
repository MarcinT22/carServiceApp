<template>
    <div class="login">
        <div class="login__container">
            <div class="login__content">
                <i class="fas fa-user login__header"></i>
                <h1>
                    Logowanie
                </h1>
                <div class="loginForm__errorMessage" v-if="isError">
                    {{errorMessage}}
                </div>
                <form action="login" class="loginForm" @submit.prevent="login">
                    <label for="email">Login</label>
                    <div class="loginForm__field">
                        <i class="fas fa-user loginForm__icon"></i>
                        <input id="email" type="email" class="loginForm__input" v-model="email"  :class="{'error':emailError}"/>
                        <div class="loginForm__error" v-if="emailError">
                            {{emailError}}
                        </div>
                    </div>
                    <label for="password">Hasło</label>
                    <div class="loginForm__field">
                        <i class="fas fa-lock loginForm__icon"></i>
                        <input id="password" type="password" class="loginForm__input" v-model="password"  :class="{'error':passwordError}"/>
                        <div class="loginForm__error" v-if="passwordError">
                            {{passwordError}}
                        </div>
                    </div>

                    <div class="loginForm__action">
                        <button class="loginForm__button" v-if="!isLoading">Zaloguj</button>
                        <div class="loading" v-if="isLoading"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Login",
        data() {
            return {
                email: null,
                password: null,
                isLoading: false,
                isError: false,
                errorMessage: null,
                emailError:null,
                passwordError:null,
            }
        },
        methods: {
            login() {

                this.emailError=null
                this.passwordError=null
                this.isError = false
                this.isLoading = true
                if (this.email && this.password) {
                    let email = this.email
                    let password = this.password
                    this.$store.dispatch('login', {
                            email,
                            password,
                        }
                    )
                        .then(() => {
                            this.isLoading = false
                            this.$router.push('/')
                        })
                        .catch(error => {
                            this.isLoading = false
                            this.isError = true
                            this.errorMessage = "Nieprawidłowe dane użytkownika";
                        })
                    if (this.$store.state.error === 401)
                    {

                        setTimeout(()=>{
                            this.isLoading = false
                            this.isError = true
                            this.errorMessage = "Nieprawidłowe dane użytkownika";
                        },500)
                    }
                } else {
                    if (!this.email) {
                        this.emailError = 'Adres e-mail jest wymagany';
                    }
                    if (!this.password) {
                        this.passwordError = 'Hasło jest wymagane';
                    }
                    this.isLoading = false
                }




            }

        },
    }
</script>


<style scoped lang="scss">
    @import "../assets/scss/config";

    .login {
        background: url('../assets/image/login-background.jpg') no-repeat;
        background-size: cover;
        background-position: center;
        position: relative;
        height:100%;
        display: flex;
        align-items: center;
        justify-content: center;

        &__container {
            padding: 15px;
            box-sizing: border-box;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        &__content {
            background: rgba(255, 255, 255, 0.35);
            max-width: 400px;
            width:100%;
            padding: 70px 60px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);

            @media (max-width: $screen-sm) {
                padding: 30px 30px;
            }


            h1 {
                font-size: 24px;
                color: #fff;
                text-align: center;
                font-weight: 400;
                border-bottom: 1px solid #fff;
                padding-bottom: 15px;
                max-width: 200px;
                margin: 0 auto;

            }
        }

        &__header {
            font-size: 45px;
            color: #fff;
            text-align: center;
            margin: 0 auto;
            display: block;
            margin-bottom: 10px;
        }
    }

    .loginForm {
        label {
            font-size: 14px;
            color: #fff;
            margin-top: 15px;
            display: block;
            margin-bottom: 5px;
        }

        &__field {
            position: relative;
        }

        &__input {
            padding: 5px 10px;
            padding-left: 35px;
            box-sizing: border-box;
            width: 100%;
            height: 40px;
            font-size: 14px;
            color: #333;
            outline: none;
            border: 0;
            border-radius: 4px;
            transition: box-shadow 0.3s;
            background: rgba(255, 255, 255, 0.7);

            &:focus {
                box-shadow: 0 0 10px 0px $mainColor;
            }

            &.error {
                border: 2px solid #631921;
            }
        }

        &__icon {
            color: $mainColor;
            font-size: 18px;
            position: absolute;
            display: block;
            top: 11px;
            bottom: 5px;
            left: 10px;
            margin: auto;
        }


        &__button {
            outline: none;
            border: 0;
            background: $mainColor;
            font-size: 20px;
            color: #fff;
            font-weight: 600;
            display: block;
            margin: 0 auto;
            max-width: 200px;
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
            text-align: center;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;

            &:hover {
                background: lighten($mainColor, 10%);
            }
        }

        &__action {
            margin-top: 33px;
            position: relative;
            min-height: 45px;
        }


    }
</style>
<style lang="scss">
    @import "../assets/scss/config";

    .loginForm__error {
        font-size: 12px;
        color: #631921;
        font-weight: 600;
        margin-top: 5px;
    }

    .loginForm__errorMessage {
        font-size: 12px;
        color: #fff;
        font-weight: 500;
        text-align: center;
        margin-top: 20px;
        background:$danger;
        padding: 10px;
        box-sizing: border-box;
    }
</style>
