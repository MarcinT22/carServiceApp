<template>
    <div class="home">
        <h1>
            <i class="far fa-calendar-alt"></i>
            Umów wizytę
        </h1>
        <div class="home__buttons">
            <div class="home__button">
                <a href="#" @click.prevent="goToVisitWithMyCar" class="tap-effect">
                    <i class="fas fa-car"></i>
                    Mój samochód
                </a>
            </div>
            <div class="home__button">
                <a href="#" @click.prevent="goToVisit" class="tap-effect">
                    <i class="fas fa-plus-circle"></i>
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
                    <i class="fas fa-project-diagram"></i>
                    Sprawdź status naprawy
                </a>
            </div>
        </div>

    </div>
</template>

<script>
    export default {
        name: "Home",
        created(){
            setTimeout(() => this.$store.state.isLoading=false, 500);
        },
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
                this.$router.push('/visit')
            }
        }

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
            padding:15px 0px;
        }

        &__button{
            padding:0 25px;

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
                i{
                    font-size:24px;
                    margin-bottom:5px;
                }
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
                    padding:20px 10px;
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