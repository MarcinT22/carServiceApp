<template>
    <div class="message">

        <div class="message__block">
            <i class="far fa-check-circle"></i>
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
        created(){
            setTimeout(() => this.$store.state.isLoading=false, 500);
        },

        methods:{
            logout()
            {
                this.$store.state.isLoading=true
                this.$store.dispatch('logout')
                    .then(()=>{
                        this.$router.push('/')
                    })
            },
        }
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    .message{

        &__block{
            font-size:15px;
            color:$mainColor;
            text-align: center;

            i{
                font-size:30px;
            }
        }




    }
</style>