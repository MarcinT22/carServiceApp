<template>
    <div id="app">
        <header>
            <img src="./assets/image/logo.png"/>
        </header>
        <router-view/>
    </div>
</template>

<script>
    import Vue from 'vue'
    import VueTouchRipple from 'vue-touch-ripple'
    import 'vue-touch-ripple/dist/vue-touch-ripple.css'

    Vue.use(VueTouchRipple, {
        // default global options
        opacity: 0.2,
        speed: 2,
        color: '#f7f7f7'
    })

    export default {
        name: 'App',
        data() {
            return {
                isClicked: false
            }
        },
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
            opacity: 0.075;
        }
    }

    #app {
        position: relative;
        z-index: 1;
        padding: 0 20px;
    }

    a {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-tap-highlight-color: transparent;
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
