<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Edycja użytkownika
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="block block--baseline">
                    <form @submit.prevent="saveUser">
                        <div class="block__field">
                            <label for="email">E-mail</label>
                            <input type="email" v-model="email" id="email"/>
                        </div>
                        <div class="block__field">
                            <label for="password">Hasło</label>
                            <input type="password" v-model="password" id="password"/>
                        </div>
                        <div class="block__field" v-if="currentUser != email">
                            <label for="admin">
                                <input type="checkbox" v-model="isAdmin" id="admin"/> Administrator
                            </label>
                        </div>
                        <button v-if="!isSaving">
                            Zapisz
                        </button>
                        <div class="loading loading--normal" v-if="isSaving"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "EditUser",
        data() {
            return {
                name: null,
                email: null,
                password: null,
                isAdmin: false,
                isLoading: true,
                isSaving: false,
                currentUser: JSON.parse(localStorage.getItem('user')).email

            }
        },
        methods: {

            saveUser() {
                this.isSaving = true
                axios.put('/user/' + this.$route.params.id, {
                    email: this.email,
                    password: this.password,
                    is_admin: this.isAdmin
                }).then(() => {
                    this.isSaving = false
                    this.$router.push({name: 'Users'})
                    this.$store.dispatch('message', 'Zapisano.')
                })
            }
        },
        created() {
            axios.get('/user/' + this.$route.params.id)
                .then(response => {
                    this.email = response.data.user.email
                    this.isAdmin = response.data.user.is_admin
                    this.isLoading = false
                })
        }
    }
</script>
<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
</style>
