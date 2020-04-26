<template>
    <div id="app">
        <div v-if="$route.name != 'Login'" class="main">
            <Menu></Menu>
            <router-view>
            </router-view>
        </div>
        <router-view v-else>
        </router-view>
    </div>
</template>

<script>
    import Menu from "./components/Menu";

    export default {
        name: 'App',
        components: {Menu}
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
    }

    .overflow{
        overflow: hidden;
    }

    a{
        -webkit-tap-highlight-color: rgba(0,0,0,0);
    }

    .main{
        position: relative;

        &::before{
            content:url("./assets/image/car.jpg");
            position: fixed;
            right:-140px;
            bottom:-70px;
            z-index: -1;
            transform:scale(0.7);

            @media (max-width:$screen-md)
            {
                right:-170px;
                bottom:-100px;
                transform:scale(0.6);
            }

            @media (max-width:$screen-sm)
            {
                display: none;
            }
        }
    }

</style>
