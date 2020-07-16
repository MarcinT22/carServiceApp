<template>
    <div class="message" :class="{active:showMessage}">
        <div class="message__icon">
            <i class="far fa-check-circle"></i>
        </div>
        <div class="message__text">
            {{message}}
        </div>
    </div>
</template>

<script>
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
        }
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/message";
</style>
