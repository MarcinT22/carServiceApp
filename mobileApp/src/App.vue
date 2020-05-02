<template>
    <div id="app">
        <div class="container">
            <header>
                <img src="./assets/image/logo.png"/>
            </header>
            <router-view>
            </router-view>

        </div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import VueTouchRipple from 'vue-touch-ripple'
    import 'vue-touch-ripple/dist/vue-touch-ripple.css'

    Vue.use(VueTouchRipple, {
        opacity: 0.2,
        speed: 2,
        color: '#f7f7f7'
    })

    export default {
        name: 'App',
    }
</script>

<style lang="scss">
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap');
    @import "assets/scss/config";

    html, body {
        padding: 0;
        margin: 0;
        font-family: 'Open Sans', sans-serif;
        font-weight: 400;
        background: #f7f7f7;
        position: relative;
        height: 100%;


        &::before {
            content: '';
            display: block;
            height: 50vw;
            width: 100%;
            position: fixed;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: #fff;
            transform: skewY(-25deg);
            top: -25vw;
            z-index: 0;
        }

        &::after {
            content: url('assets/image/background_3.jpg');
            display: block;
            position: fixed;
            bottom: -25px;
            right: -10px;
            z-index: 0;
            transform: scale(0.9);
            opacity: 0.05;
        }
    }

    #app {
        position: relative;
        z-index: 1;

        font-family: 'Open Sans', sans-serif;

        .v-application {
            background: rgba(0, 0, 0, 0);

        }
    }

    a {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-tap-highlight-color: transparent;
    }

    .container{
        margin: 0 auto;
        padding: 0 30px;
        padding-bottom:50px;
        max-width:350px;
    }

    h1 {
        color: $mainColor;
        font-size: 22px;
        text-align: center;
        margin: 20px 0;
        margin-top:0;
        display: flex;
        align-items: center;
        justify-items: center;
        flex-direction: column;
        font-weight: 400;

        i {
            margin-bottom: 5px;
        }
    }

    h2{
        color: $mainColor;
        font-size: 16px;
        margin: 20px 0;
        font-weight: 400;
        border-bottom:1px solid $mainColor;
        padding-bottom:5px;
        font-weight: 600;
    }



    header {
        text-align: center;
        padding: 40px;

        img {
            display: block;
            margin: 0 auto;
            max-width: 100px;
            opacity: 0.5;
        }
    }

</style>
