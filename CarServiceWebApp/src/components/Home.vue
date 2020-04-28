<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <div class="dashboard__row">
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zgłoszenia oczekujące:
                        </h2>
                        <div class="block__count">
                            14
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Przyjęcia pojazdów:
                        </h2>
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                            14
                            <span class="block__text block__text--light">
                                Łącznie: 24
                            </span>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Nowe zlecenia:
                        </h2>
                        <div class="block__count">
                            7
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Zaplanowane naprawy:
                        </h2>
                        <div class="block__count">
                            <span class="block__text">
                                dziś:
                            </span>
                            3
                            <span class="block__text block__text--light">
                                Łącznie: 17 <span>|</span>W trakcie: 2
                            </span>
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
                    </div>
                </div>
                <div class="dashboard__col">
                    <div class="block">
                        <h2>
                            Pojazdy do wydania:
                        </h2>
                        <div class="block__count">
                            6
                        </div>
                        <a href="#">
                            Zarządzaj
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    const headers = {
        'Content-Type': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
    }
    export default {
        name: "Home",
        data(){
            return{
                data:{
                    email: "admin@test.com",
                    password: "admin"
                }
            }
        },


    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";


</style>