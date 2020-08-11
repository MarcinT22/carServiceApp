<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Statusy
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="statusList">
                    <div class="statusList__item" v-for="status in getStatusesList">
                        {{status.name}} {{status.color}}
                    </div>
                </div>


            </div>


        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "StatusList",
        computed: mapGetters(['getStatusesList','isLoading']),
        created() {
            this.$store.dispatch('getStatusList')
        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/statusList";

</style>
