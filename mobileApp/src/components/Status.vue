<template>
    <div class="status">

        <h1>
            <i class="fas fa-project-diagram"></i>
            Status naprawy
        </h1>

        <div class="status__container" :class="{active:show}">
            <template v-if="status != null">
                <div class="status__block" :style="{background:status.color}" v-if="status.id != 5">
                    {{status.name}}
                </div>
                <div class="status__block status__block--default" v-else>
                   Pojazd nie został zgłoszony do naprawy
                </div>
            </template>
            <div class="status__block" v-else>
                Zgłoszenie oczekuje na akceptację przez warsztat
            </div>

            <button class="btn tap-effect" @click="logout">
                OK
            </button>
        </div>


    </div>
</template>

<script>
    export default {
        name: "Status",
        data() {
            return {
                status: {type: Object, default: () => ({})},
                show: false
            }
        },


        methods: {
            logout() {
                this.$store.state.isLoading = true
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            },
        },
        created() {

            let reportedCarId = this.$store.getters.getReportedCar.id;
            this.$store.dispatch('getStatus', reportedCarId
            )
                .then(success => {
                    this.status = this.$store.getters.getEventStatus
                    this.show = true
                })
                .catch(error => {
                        this.$store.state.isLoading = false
                    }
                )

            setTimeout(() => this.$store.state.isLoading = false, 500);
        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .status {
        &__block {
            margin: 40px 0;
            padding: 20px;
            box-sizing: border-box;
            border-radius: 10px;
            background: #333;
            font-size: 18px;
            text-align: center;
            color: #fff;
            box-shadow: 5px 5px 5px 0 rgba(0, 0, 0, 0.2);

            &--default{
                box-shadow: none;
                background: none;
                color:$mainColor;
                padding:0;
                font-size:16px;
            }
        }

        &__container {
            opacity: 0;
            position: relative;
            top: -20px;
            transition: opacity 0.3s ease-in-out, top 0.3s ease-in-out;

            &.active {
                opacity: 1;
                top: 0;
            }
        }


    }
</style>