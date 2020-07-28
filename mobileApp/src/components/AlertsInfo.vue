<template>
    <div class="alert" :class="{'active':showAlerts}" @click="goToAlerts">
        <svg class="alert__icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="#626262"><path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7c0-2.42-1.72-4.44-4.005-4.901z"/></g><rect x="0" y="0" width="16" height="16" fill="rgba(0, 0, 0, 0)" /></svg>
        <div class="alert__count">
          {{getNumberOfAlerts}}
        </div>
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
    .alert{
        position: absolute;
        top:15px;
        right:15px;
        opacity:0;
        visibility: hidden;
        cursor: pointer;
        transition:opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
        &.active{
            opacity: 1;
            visibility: visible;
        }

        &:active{
            .alert{
                &__icon{
                    g{
                        fill:darken($alertColor, 10%)
                    }
                }

                &__count{
                    background:darken($alertColor, 10%);
                }
            }
        }

        &__icon{
            font-size:26px;
            animation: ringingBell 5s 0.3s ease infinite;
            g{
                fill:$alertColor;
                transition:fill 0.1s;
            }

        }

        &__count{
            position: absolute;
            top:-8px;
            right:-8px;
            width:20px;
            height:20px;
            font-size:10px;
            border-radius: 100%;
            box-sizing: border-box;
            padding:1px;
            color:#fff;
            font-weight: bold;
            background: $alertColor;
            display: flex;
            align-items: center;
            justify-content: center;
            border:3px solid #f7f7f7;
            transition:background 0.1s;


        }
    }

    @keyframes ringingBell {
        0% { transform: rotate(0); }
        1% { transform: rotate(40deg); }
        3% { transform: rotate(-38deg); }
        5% { transform: rotate(44deg); }
        7% { transform: rotate(-42deg); }
        9% { transform: rotate(40deg); }
        11% { transform: rotate(-38deg); }
        13% { transform: rotate(36deg); }
        15% { transform: rotate(-34deg); }
        17% { transform: rotate(32deg); }
        19% { transform: rotate(-30deg); }
        21% { transform: rotate(28deg); }
        23% { transform: rotate(-26deg); }
        25% { transform: rotate(24deg); }
        27% { transform: rotate(-22deg); }
        29% { transform: rotate(20deg); }
        31% { transform: rotate(-18deg); }
        33% { transform: rotate(16deg); }
        35% { transform: rotate(-14deg); }
        37% { transform: rotate(12deg); }
        39% { transform: rotate(-11deg); }
        41% { transform: rotate(11deg); }

        43% { transform: rotate(0); }
        100% { transform: rotate(0); }
    }
</style>
