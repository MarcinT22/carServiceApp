<template>
    <div class="message" :class="{active:isMessage}">
        <div class="message__icon">
            <i class="far fa-check-circle"></i>
        </div>
        <div class="message__text">
            {{getMessage}}
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "Message",
        data(){
          return{
              showMessage:false,
              message:null,
          }
        },
        methods:{
            show(message)
            {
                this.showMessage= true
                this.message=message
                setTimeout(() => this.showMessage = false, 5000);
            }
        },
        computed: mapGetters(['isMessage','getMessage']),
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/message";
</style>
