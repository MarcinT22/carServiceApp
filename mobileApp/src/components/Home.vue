<template>
    <div class="home">
        <div class="home__text">
            <i class="far fa-calendar-alt"></i>
            Umów wizytę
        </div>
        <div class="home__buttons">
            <touch-ripple class="home__button">
                <a href="#">
                    <i class="fas fa-car"></i>
                    Mój samochód
                </a>
            </touch-ripple>
            <touch-ripple class="home__button">
                <a href="#">
                    <i class="fas fa-plus-circle"></i>
                    Nowy samochód
                </a>
            </touch-ripple>
        </div>
        <div class="home__text">
            lub
        </div>
        <div class="home__buttons">
            <touch-ripple class="home__button home__button--large">
                <a href="#">
                    <i class="fas fa-project-diagram"></i>
                    Sprawdź status naprawy
                </a>
            </touch-ripple>
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
                background:url('../assets/image/background_2.jpg')no-repeat;
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
                    border-radius: 15px;
                    width: 100%;
                    height:auto;
                    padding:15px 10px;
                    box-sizing: border-box;
                    font-size:16px;
                    background:url('../assets/image/background_1.jpg')no-repeat;
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