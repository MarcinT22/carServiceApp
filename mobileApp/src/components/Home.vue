<template>
    <div class="home">
        <h1>
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.89em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 750 850"><path d="M533 194q-20 0-33-14t-14-33V55q0-20 14-34t33-13.5T566 21t13 34v92q0 20-13 33t-33 14zm-325 0q-19 0-32-14t-14-33V55q0-20 14-34t32-13q20 0 34 13t13 34v92q0 20-13 33t-34 14zm487-93q20 0 33 13t13 33v556q0 20-13 33t-33 14H46q-19 0-32-14T0 703V147q0-19 14-33t32-13h70v46q0 19 7 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h139v46q0 19 8 36t20 29t29 20t36 8t36-8t30-20t20-29t7-36v-46h69zm-46 289q0-11-12-11H104q-11 0-11 11v255q0 12 11 12h533q12 0 12-12V390z" fill="#626262"/></svg>
            Umów wizytę
        </h1>
        <div class="home__buttons">
            <div class="home__button">
                <a href="#" @click.prevent="goToVisitWithMyCar" class="tap-effect">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M488 224c-3-5-32.61-17.79-32.61-17.79c5.15-2.66 8.67-3.21 8.67-14.21c0-12-.06-16-8.06-16h-27.14c-.11-.24-.23-.49-.34-.74c-17.52-38.26-19.87-47.93-46-60.95C347.47 96.88 281.76 96 256 96s-91.47.88-126.49 18.31c-26.16 13-25.51 19.69-46 60.95c0 .11-.21.4-.4.74H55.94c-7.94 0-8 4-8 16c0 11 3.52 11.55 8.67 14.21C56.61 206.21 28 220 24 224s-8 32-8 80s4 96 4 96h11.94c0 14 2.06 16 8.06 16h80c6 0 8-2 8-16h256c0 14 2 16 8 16h82c4 0 6-3 6-16h12s4-49 4-96s-5-75-8-80zm-362.74 44.94A516.94 516.94 0 0 1 70.42 272c-20.42 0-21.12 1.31-22.56-11.44a72.16 72.16 0 0 1 .51-17.51L49 240h3c12 0 23.27.51 44.55 6.78a98 98 0 0 1 30.09 15.06C131 265 132 268 132 268zm247.16 72L368 352H144s.39-.61-5-11.18c-4-7.82 1-12.82 8.91-15.66C163.23 319.64 208 304 256 304s93.66 13.48 108.5 21.16C370 328 376.83 330 372.42 341zm-257-136.53a96.23 96.23 0 0 1-9.7.07c2.61-4.64 4.06-9.81 6.61-15.21c8-17 17.15-36.24 33.44-44.35c23.54-11.72 72.33-17 110.23-17s86.69 5.24 110.23 17c16.29 8.11 25.4 27.36 33.44 44.35c2.57 5.45 4 10.66 6.68 15.33c-2 .11-4.3 0-9.79-.19zm347.72 56.11C461 273 463 272 441.58 272a516.94 516.94 0 0 1-54.84-3.06c-2.85-.51-3.66-5.32-1.38-7.1a93.84 93.84 0 0 1 30.09-15.06c21.28-6.27 33.26-7.11 45.09-6.69a3.22 3.22 0 0 1 3.09 3a70.18 70.18 0 0 1-.49 17.47z" fill="#626262"/></svg>
                    Mój samochód
                </a>
            </div>
            <div class="home__button">
                <a href="#" @click.prevent="goToVisit" class="tap-effect">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M256 48C141.31 48 48 141.31 48 256s93.31 208 208 208s208-93.31 208-208S370.69 48 256 48zm96 224h-80v80h-32v-80h-80v-32h80v-80h32v80h80z" fill="#626262"/></svg>
                    Nowy samochód
                </a>
            </div>
        </div>
        <div class="home__text">
            lub
        </div>
        <div class="home__buttons">
            <div class="home__button home__button--large">
                <a href="#" @click.prevent="goToStatus" class="tap-effect">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="#626262"><path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3.854 2.146a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 3.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708L2 7.293l1.146-1.147a.5.5 0 0 1 .708 0zm0 4a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147l1.146-1.147a.5.5 0 0 1 .708 0z" clip-rule="evenodd"/></g></svg>
                    Sprawdź status naprawy
                </a>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Home",

        methods:
        {
            changeZone(zone)
            {
              this.$store.commit('changeZone', zone)
            },

            goToStatus()
            {

                this.changeZone('status')
                this.$router.push('/login')
            },

            goToVisitWithMyCar()
            {
                this.changeZone('myCar')
                this.$router.push('/login')
            },

            goToVisit()
            {
                this.changeZone('newCar')
                this.$router.push('/NewCarVisit')
            }
        },
        created(){
            setTimeout(() => this.$store.state.isLoading=false, 500);
        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .home {
        &__text {
            color: $mainColor;
            font-size: 18px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            margin:20px 0;

            i {
                font-size: 25px;
                margin-bottom: 5px;
            }
        }

        &__buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            padding:20px 0px;
        }

        &__button{
            padding:0 15px;


            .icon{
                font-size:30px;
                path{
                    fill:#fff;
                }
            }

            a{
                display: flex;
                flex-direction: column;
                font-size:15px;
                text-decoration: none;
                justify-content: center;
                align-items: center;
                color:#fff;
                border-radius: 100%;
                background:url('../img/background_2.jpg')no-repeat;
                background-size: cover;
                width:135px;
                height:135px;


            }

            &--large{
                width: 100%;
                margin-top:10px;
                padding-left:0;
                padding-right:0;
                a{
                    border-radius: 5px;
                    width: 100%;

                    height:auto;
                    padding:15px 10px;
                    box-sizing: border-box;
                    font-size:16px;
                    background:url('../img/background_1.jpg')no-repeat;
                    background-position: right center;
                    background-size: cover;
                    i{
                        font-size:20px;
                    }
                }
            }
        }
    }
</style>