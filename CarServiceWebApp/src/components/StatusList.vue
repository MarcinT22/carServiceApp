<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Statusy
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="statusList">
                    <div class="statusList__item" v-for="(status, index) in getStatusesList">
                        <div class="statusList__col">

                            <template  v-if="statusIndex != index">
                            <span :style="{'background':status.color}"></span>
                            <div>
                                {{status.name}}
                            </div>
                            </template>
                            <template  v-if="statusIndex === index">
                            <input type="color" v-model="status.color" class="statusList__colorInput">
                            <input type="text" v-model="status.name" class="statusList__input">
                            </template>

                        </div>
                        <div class="statusList__col">
                            <button @click="edit(index)">
                                Edytuj
                            </button>
                        </div>
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
        data()
        {
            return{
                statusIndex:null,
            }
        },
        computed: mapGetters(['getStatusesList','isLoading']),
        created() {
            this.$store.dispatch('getStatusList')
            this.$store.dispatch('getSheduledEvents')
        },
        methods:{
            edit(index)
            {
                this.statusIndex = index
            }
        }

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/statusList";

</style>
