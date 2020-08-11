<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Ustawienia
            </h1>
            <div class="dashboard__row">
                <div class="dashboard__col dashboard__col--4">
                   <div class="settings">
                       <router-link :to="{ name: 'ReportedCars' }">
                            <div class="settings__circle">
                                <i class="fas fa-user-friends"></i>
                            </div>
                           <h2>
                               Użytkownicy
                           </h2>
                       </router-link>
                   </div>
                </div>
                <div class="dashboard__col dashboard__col--4">
                    <div class="settings">
                        <router-link :to="{ name: 'StatusList' }">
                            <div class="settings__circle">
                                <i class="fas fa-check"></i>
                            </div>
                            <h2>
                                Statusy
                            </h2>
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
    </div>

</template>

<script>
    export default {
        name: "Settings",

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/settings";

</style>
