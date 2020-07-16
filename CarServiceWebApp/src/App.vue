<template>
    <div id="app">
        <div v-if="isUserLogged" class="main">
            <Menu></Menu>
            <router-view>
            </router-view>
        </div>
        <router-view v-else>
        </router-view>
    </div>
</template>

<script>
    import Menu from "./components/Menu"
    import Message from "./components/Message"


    import axios from "axios"
    import store from './store'
    import {mapGetters} from 'vuex'

    export default {
        name: 'App',
        store,
        components: {Menu},
        computed: mapGetters(['isUserLogged']),
        created: function () {
            axios.interceptors.response.use(undefined, function (err) {
                return new Promise(function (resolve, reject) {
                    if (err.status === 401 && err.config && !err.config.__isRetryRequest) {
                        this.$store.dispatch('logout')
                    }
                    throw err;
                });
            });
        }
    }
</script>
<style lang="scss">
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css');
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;800&display=swap');
    @import "assets/scss/config";

    html, body {
        padding: 0;
        margin: 0;
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        background: #f9f9f9;
    }

    input,button{
        font-family: 'Poppins', sans-serif;
    }

    .overflow {
        overflow: hidden;
    }

    a {
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .main {
        position: relative;

    }

    .loading {
        width: 30px;
        height: 30px;
        border-radius: 100%;
        border: 5px solid #f3f3f3;
        border-top-color: $mainColor;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        margin: auto;
        animation: loading 0.5s ease-in-out infinite;

        &--allPage {
            position: fixed;
        }

        &--static{
            position: static;
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

    .loadingContainer{
        opacity: 0;
        transition:opacity 0.3s ease-in-out;

        &.active{
            opacity: 1;
        }
    }

</style>
