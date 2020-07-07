<template>
    <div id="app" class="app">
        <div class="container">
            <header>
                <img src="./img/logo.png"/>
            </header>
            <router-view>
            </router-view>
        </div>
        <div class="loading" :class="{'active':this.$store.state.isLoading}">
            <span></span>
        </div>

    </div>
</template>

<script>
    import Vue from 'vue'
    import axios from "axios"
    import store from './store'

    export default {
        name: 'App',
        store,
        created() {
            this.loading
            document.addEventListener("deviceready", this.onDeviceReady, false);


        },
        methods: {
            loading() {
                setTimeout(() => this.$store.state.isLoading = false, 500);
            },

            onDeviceReady(){
                document.addEventListener("offline", this.offline, false);
                document.addEventListener("online", this.online, false);
            },

            offline() {
                this.$router.push('/notConnection')

            },
            online() {
                this.$router.back();
            },


        }

    }


</script>

<style lang="scss">
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
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
        -webkit-tap-highlight-color: transparent;

        &.overflow{
            overflow: hidden;
        }


        form, textarea, input, button {
            font-family: 'Open Sans', sans-serif;
        }


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
            top: -31vw;
            z-index: 0;
        }

        &::after {
            content: url('img/background_3.jpg');
            display: block;
            position: fixed;
            bottom: -25px;
            right: -10px;
            z-index: 0;
            transform: scale(0.9);
            opacity: 0.05;
        }
    }

    .loading {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.6);
        z-index: 100;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.5s ease-in-out, visibility 0.5s ease-in-out;

        &.active {
            opacity: 1;
            visibility: visible;
            transition:none

        }

        span {
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            margin: auto;
            border-radius: 100%;
            width: 30px;
            height: 30px;
            border: 4px solid $mainColor;
            border-top-color: rgba(0, 0, 0, 0);
            animation: loading 0.7s linear infinite;
        }
    }

    @keyframes loading {
        0% {
            transform: rotate(0);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .app {
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

    .container {
        margin: 0 auto;
        padding: 0 30px;
        padding-bottom: 50px;
        max-width: 380px;
        box-sizing: border-box;
    }

    h1 {
        color: $mainColor;
        font-size: 18px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        font-weight: 400;
        margin-bottom: 20px;

        .icon {
            font-size: 30px;
            margin-bottom: 5px;
            color: $mainColor;

            path {
                fill: $mainColor;
            }
        }
    }

    h2 {
        color: $mainColor;
        font-size: 16px;
        margin: 20px 0;
        font-weight: 400;
        border-bottom: 1px solid $mainColor;
        padding-bottom: 5px;
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

    .tap-effect {
        position: relative;
        overflow: hidden;
        overflow: hidden;


        &::after {
            content: '';
            display: block;
            width: 500px;
            height: 500px;
            border-radius: 100%;
            background: rgb(255, 255, 255);
            position: absolute;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
            margin: auto;
            opacity: 0;
            transition: opacity 0.1s;

        }

        &:active {
            &::after {
                opacity: 0.2;

            }
        }
    }

    button.btn {
        width: 100%;
        margin-top: 10px;
        outline: none;
        border: 0;
        width: 100%;
        max-width: 150px;
        box-sizing: border-box;
        margin: 0 auto;
        text-align: center;
        font-size: 16px;
        color: #fff;
        background: url('./img/background_2.jpg') no-repeat;
        background-size: cover;
        display: block;
        padding: 10px 10px;
        border-radius: 5px;
        margin-top: 30px;


    }

    .errorMessage {
        text-align: center;
        margin-top: 20px;
        color: $errorColor;
        font-size: 14px;
        font-weight: 400
    }



</style>
