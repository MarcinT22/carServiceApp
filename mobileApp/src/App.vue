<template>
    <div id="app">
        <div class="container">
            <header>
                <img src="./img/logo.png"/>
            </header>
            <router-view>
            </router-view>

        </div>
    </div>
</template>

<script>
    import Vue from 'vue'


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
        -webkit-tap-highlight-color: rgba(0,0,0,0);
        -webkit-tap-highlight-color: transparent;

        form{
            font-family: 'Open Sans', sans-serif;
        }
        textarea{
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
            top: -25vw;
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
        margin-bottom:20px;

        i {
            font-size: 25px;
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

    .tap-effect{
        position: relative;
        overflow: hidden;
        overflow: hidden;


        &::after{
            content:'';
            display: block;
            width:500px;
            height:500px;
            border-radius: 100%;
            background:rgb(255,255,255);
            position: absolute;
            top:0;
            bottom:0;
            right:0;
            left:0;
            margin:auto;
            opacity:0;
            transition:opacity 0.1s;

        }

        &:active{
            &::after{
                opacity: 0.2;

            }
        }
    }
</style>
