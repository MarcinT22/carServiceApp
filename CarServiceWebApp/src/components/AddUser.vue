<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Nowy użytkownik
            </h1>
            <div class="error" v-if="errors">
                {{errors}}
            </div>
            <div class="block block--baseline">
                <form @submit.prevent="createUser">
                    <div class="block__field">
                        <label for="name">Nazwa użytkownika</label>
                        <input type="text" v-model="name" id="name" :class="{'error':nameError}"/>
                        <div class="block__error" v-if="nameError">
                            {{nameError}}
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="email">E-mail</label>
                        <input type="email" v-model="email" id="email" :class="{'error':emailError}"/>
                        <div class="block__error" v-if="emailError">
                            {{emailError}}
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="password">Hasło</label>
                        <input type="password" v-model="password" id="password" :class="{'error':passwordError}"/>
                        <div class="block__error" v-if="passwordError">
                            {{passwordError}}
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="confirm_password">Powtórz hasła</label>
                        <input type="password" v-model="confirm_password" id="confirm_password"
                               :class="{'error':confirm_passwordError}"/>
                        <div class="block__error" v-if="confirm_passwordError">
                            {{confirm_passwordError}}
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="admin">
                            <input type="checkbox" v-model="isAdmin" id="admin"/> Administrator
                        </label>
                    </div>
                    <button v-if="!isLoading" class="block__actionBtn block__actionBtn--accept">
                        <i class="fas fa-user-plus"></i> Dodaj użytkownika
                    </button>
                    <div class="loading loading--normal" v-if="isLoading"></div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "AddUser",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                confirm_password: null,
                nameError: null,
                emailError: null,
                passwordError: null,
                confirm_passwordError: null,
                isAdmin: false,
                isLoading: false,
                errors:null,

            }
        },
        methods: {
            createUser() {
                this.isLoading = true
                this.nameError = null
                this.emailError = null
                this.passwordError = null
                this.confirm_passwordError = null

                if (this.name && this.email && this.password && (this.confirm_password == this.password)) {
                    axios.post('/register/', {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        confirm_password: this.confirm_password,
                        is_admin: this.isAdmin
                    })
                        .then(response => {
                            this.name = null,
                                this.email = null,
                                this.password = null,
                                this.confirm_password = null,
                                this.isLoading = false
                            this.isAdmin = false
                            this.$router.push({name:'Users'})
                            this.$store.dispatch('message', 'Użytkownik został dodany.')
                        })
                        .catch(error => {
                           this.errors = 'Nie można stworzyć użytkownika.'
                            this.isLoading = false
                        })

                } else {


                    if (!this.name) {
                        this.nameError = 'Nazwa użytkownika jest wymagana';
                    }
                    if (!this.email) {
                        this.emailError = 'Adres e-mail jest wymagany';
                    }
                    if (!this.password) {
                        this.passwordError = 'Hasło jest wymagane';
                    }
                    if (!this.confirm_password || (this.confirm_password != this.password)) {
                        this.confirm_passwordError = 'Hasło jest nieprawidłowe';
                    }
                    this.isLoading = false
                }


            }
        }
    }
</script>
<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
</style>
