<template>
    <div class="home">
        <h1>
            <i class="far fa-calendar-alt"></i>
            Umów wizytę
        </h1>
        <div class="home__buttons">
            <div class="home__button">
                <router-link :to="{ path: 'login' }" class="tap-effect">
                    <i class="fas fa-car"></i>
                    Mój samochód
                </router-link>
            </div>
            <div class="home__button">
                <router-link :to="{ path: 'visit' }"  class="tap-effect">
                    <i class="fas fa-plus-circle"></i>
                    Nowy samochód
                </router-link>
            </div>
        </div>
        <div class="home__text">
            lub
        </div>
        <div class="home__buttons">
            <div class="home__button home__button--large">
                <a href="#"  class="tap-effect">
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
                font-size:13px;
                text-decoration: none;
                justify-content: center;
                align-items: center;
                color:#fff;
                border-radius: 100%;
                background:url('../img/background_2.jpg')no-repeat;
                background-size: cover;
                width:120px;
                height:120px;
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