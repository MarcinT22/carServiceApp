<template>
    <div class="login">
        <div class="login__container">
            <div class="login__content">
                <i class="fas fa-user login__header"></i>
                <h1>
                    Logowanie
                </h1>
                <form action="login" class="form" @submit.prevent="login">
                    <label for="email">Login</label>
                    <div class="form__field">
                        <i class="fas fa-user form__icon"></i>
                        <input id="email" type="email" class="form__input" v-model="email"/>
                    </div>
                    <label for="password">Hasło</label>
                    <div class="form__field">
                        <i class="fas fa-lock form__icon"></i>
                        <input id="password" type="password" class="form__input" v-model="password"/>
                    </div>
                    <button class="form__button">Zaloguj</button>
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
                email: "",
                password: ""
            }
        },
        methods: {
            login() {
                let email = this.email
                let password = this.password
                this.$store.dispatch('login', {
                        email,
                        password,
                    }
                )
                    .then(() => this.$router.push('/visit'))
                    .catch(error => console.log(error.response.data.errors))
            }
        }
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .login {
        background: url('../assets/image/login-background.jpg') no-repeat;
        background-size: cover;
        background-position: center;
        height: 100vh;
        position: relative;

        &__container {
            padding: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
        }

        &__content {
            background: rgba(255, 255, 255, 0.35);
            max-width: 400px;
            padding: 70px 60px;
            width: 100%;
            box-sizing: border-box;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);

            @media (max-width: $screen-sm) {
                padding: 50px 30px;
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

    .form {
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
            border-radius: 5px;
            transition: box-shadow 0.3s;
            background: rgba(255, 255, 255, 0.7);

            &:focus {
                box-shadow: 0 0 10px 0px $mainColor;
            }
        }

        &__icon {
            color: $highlightColor;
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
            background: $highlightColor;
            font-size: 20px;
            color: #fff;
            font-weight: bold;
            display: block;
            margin: 0 auto;
            margin-top: 33px;
            max-width: 200px;
            width: 100%;
            box-sizing: border-box;
            padding: 8px;
            text-align: center;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;

            &:hover {
                background: $highlightColorHover;
            }
        }


    }
</style>