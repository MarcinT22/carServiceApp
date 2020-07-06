<template>
    <div class="message">

        <div class="message__block">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512"><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192s192-86 192-192z" fill="none" stroke="#626262" stroke-miterlimit="10" stroke-width="32"/><path fill="none" stroke="#626262" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M352 176L217.6 336L160 272"/></svg>
            <p>Zgłoszenie jest w trakcie przetwarzania.</p>
            <p>Prosimy na bieżąco sprawdzać status zlecenia.</p>
        </div>
        <button class="btn tap-effect" @click="logout">
            OK
        </button>



    </div>
</template>

<script>
    export default {
        name: "Message",


        methods:{
            logout()
            {
                this.$store.state.isLoading=true
                this.$store.dispatch('logout')
                    .then(()=>{
                        this.$router.push('/')
                    })
            },
        },
        created(){
            setTimeout(() => this.$store.state.isLoading=false, 500);
        },
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    .message{

        &__block{
            font-size:15px;
            color:$mainColor;
            text-align: center;

            .icon{
                font-size:40px;
                path{
                    stroke:$mainColor;
                }

            }
        }




    }
</style>