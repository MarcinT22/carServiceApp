<template>
    <div>
        <h1>
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 aria-hidden="true" focusable="false" width="1em" height="1em"
                 style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                 preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16">
                <g fill="#626262">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7c0-2.42-1.72-4.44-4.005-4.901z"/>
                </g>
                <rect x="0" y="0" width="16" height="16" fill="rgba(0, 0, 0, 0)"/>
            </svg>
            Powiadomienia
        </h1>

        <div class="alerts" v-for="(alert, index) in alerts" :id="'alert-'+index">
            <div class="alerts__loading"></div>
            <div class="alerts__description">
                {{alert.description}}
            </div>
            <div class="alerts__buttons">
                <button class="alerts__button alerts__button--accept" @click="accept(alert.id, index)">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true" focusable="false" width="1em" height="1em"
                         style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                         preserveAspectRatio="xMidYMid meet" viewBox="0 0 1200 1200">
                        <path d="M600 0C268.63 0 0 268.63 0 600s268.63 600 600 600c331.369 0 600-268.63 600-600S931.369 0 600 0zm0 130.371c259.369 0 469.556 210.325 469.556 469.629c0 259.305-210.187 469.556-469.556 469.556c-259.37 0-469.556-210.251-469.556-469.556C130.445 340.696 340.63 130.371 600 130.371zm229.907 184.717L482.153 662.915L369.36 550.122L258.691 660.718l112.793 112.793l111.401 111.401l110.597-110.669l347.826-347.754l-111.401-111.401z"
                              fill="#626262"/>
                        <rect x="0" y="0" width="1200" height="1200" fill="rgba(0, 0, 0, 0)"/>
                    </svg>
                </button>
                <button class="alerts__button alerts__button--notAccept" @click="notAccept(alert.id, index)">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         aria-hidden="true" focusable="false" width="1.07em" height="1em"
                         style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                         preserveAspectRatio="xMidYMid meet" viewBox="0 0 17 16">
                        <g fill="#626262" fill-rule="evenodd">
                            <path d="M14.646 2.371c-3.111-3.11-8.177-3.111-11.288 0c-3.111 3.112-3.11 8.177 0 11.289c3.111 3.11 8.176 3.111 11.288 0c3.112-3.113 3.111-8.177 0-11.289zM4.587 12.431C2.148 9.993 2.146 6.028 4.58 3.594c2.434-2.435 6.399-2.432 8.838.006c2.438 2.438 2.439 6.404.006 8.838c-2.436 2.434-6.4 2.431-8.837-.007z"/>
                            <path d="M11.164 11.063a.557.557 0 0 1-.388-.141L9.009 9.157l-1.695 1.695a.622.622 0 0 1-.423.146a.842.842 0 0 1-.603-.265c-.221-.22-.27-.438-.271-.58a.554.554 0 0 1 .14-.4l1.724-1.725l-1.68-1.678c-.152-.153-.279-.627.12-1.025c.225-.225.446-.272.593-.272c.183 0 .32.072.387.141L9.009 6.9l1.696-1.696a.624.624 0 0 1 .424-.146a.84.84 0 0 1 .604.266c.378.379.302.81.131.98L10.138 8.03l1.737 1.736c.067.068.146.22.146.424a.834.834 0 0 1-.265.602c-.225.224-.445.271-.592.271z"/>
                        </g>
                        <rect x="0" y="0" width="17" height="16" fill="rgba(0, 0, 0, 0)"/>
                    </svg>
                </button>
            </div>
        </div>
        <template v-if="alerts.length == 0">
            <div class="alerts__text">
                Brak powiadomień
            </div>
            <button class="btn tap-effect" @click="goToHome">
                OK
            </button>
        </template>

    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Alerts",
        data() {
            return {
                alerts: null,
            }
        },
        created() {
            this.alerts = this.$store.getters.getAlerts
            this.$store.state.showAlerts = false
            this.$store.dispatch('getAlerts', this.$store.state.reportedCar.id)
            setTimeout(() => this.$store.state.isLoading = false, 500);

        },
        methods: {
            accept(id, index) {
                document.getElementById('alert-' + index).classList.add('alerts--processing')
                this.$store.dispatch('acceptAlert', id)
                    .then(() => {
                        this.alerts.splice(index, 1);
                        document.getElementById('alert-' + index).classList.remove('alerts--processing')
                    })
            },

            notAccept(id, index) {
                document.getElementById('alert-' + index).classList.add('alerts--processing')
                this.$store.dispatch('notAcceptAlert', id)
                    .then(() => {
                        this.alerts.splice(index, 1);
                        document.getElementById('alert-' + index).classList.remove('alerts--processing')
                    })
            },
            goToHome() {
                this.$store.state.isLoading = true
                this.$store.dispatch('logout')
                this.$router.push('/')
            }
        },
        computed: mapGetters(['getAlerts', 'showAlerts']),
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .alerts {
        border: 1px solid #f3f3f3;
        padding: 20px 15px;
        padding-bottom: 10px;
        box-sizing: border-box;
        background: #fff;
        margin-bottom: 5px;
        position: relative;

        &::after{
            content:'';
            display: block;
            position: absolute;
            top:0;
            right:0;
            bottom:0;
            left:0;
            z-index: -1;
            background: rgba(255,255,255,0.8);
            opacity:0;
            transition:opacity 0.3s ease-in-out;
        }

        &--processing{
            &::after{
                z-index: 2;
                opacity: 1;
            }

            .alerts__loading{
                opacity:1;
                visibility: visible;
                transition:opacity 0.3s, visibility 0.3s;
            }
        }


        &:last-child {
            margin-bottom: 0;
        }

        &__description {
            color: $mainColor;
            font-size: 14px;
        }

        &__text {
            color: #999;
            text-align: center;
            font-size: 14px;
        }

        &__buttons {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-top: 10px;
            margin: 0 -5px;

        }


        &__button {
            background: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            box-sizing: border-box;
            font-size: 40px;
            background: #fff;
            border: 0;
            outline: none;

            svg {
                path {
                    transition: fill 0.2s;
                }
            }


            &--accept {
                svg {
                    path {
                        fill: $successColor;
                    }
                }

                &:active {
                    path {
                        fill: darken($successColor, 10%);
                    }
                }
            }

            &--notAccept {
                path {
                    fill: $alertColor;
                }

                &:active {
                    path {
                        fill: darken($alertColor, 10%);
                    }
                }
            }
        }


        &__loading{
            position: absolute;
            top:0;
            right:0;
            left:0;
            bottom:0;
            margin:auto;
            width:25px;
            height:25px;
            border-radius: 100%;
            border:4px solid #f3f3f3;
            border-top-color:$mainColor;
            z-index: 3;
            animation: loading 0.7s linear infinite;
            visibility: hidden;
            opacity:0;

        }
    }

</style>
