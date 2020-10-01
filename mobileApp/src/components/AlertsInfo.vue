<template>
    <div class="alert" v-if="showAlerts" >
        <svg class="alert__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="#626262"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7c0-2.42-1.72-4.44-4.005-4.901z"/></g><rect x="0" y="0" width="16" height="16" fill="rgba(0, 0, 0, 0)" /></svg>
        <b>Masz nowe powiadomienie!</b>
        Ilość powiadomień: {{getNumberOfAlerts}}
        <button @click="goToAlerts" class="alert__button">SPRAWDŹ</button>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "AlertsInfo",
        created() {
            this.$store.state.showAlerts = false
            this.$store.dispatch('getAlerts', this.$store.state.reportedCar.id)


        },
        methods:{
          goToAlerts()
          {
              this.$store.state.isLoading = true
              this.$router.push('/alerts')
          }
        },
        computed: mapGetters(['getNumberOfAlerts','showAlerts']),
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    .alert {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        line-height: 200%;
        color:$alertColor;
        padding:20px 0;
        padding-bottom:0;


        &__icon {
            font-size: 26px;

            g {
                fill: $alertColor;
                transition: fill 0.1s;
            }

        }

        &__button{
            outline:none;
            border:0;
            background:$alertColor;
            font-size:16px;
            border-radius: 5px;
            color:#fff;
            padding:10px;
            max-width: 150px;
            width:100%;
            margin-top:10px;

            &:active{
                background:lighten($alertColor, 10%);
            }
        }
    }


</style>
