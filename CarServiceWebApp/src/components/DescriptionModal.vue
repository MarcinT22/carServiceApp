<template>
    <div class="modal" :class="{'modal--show':isShow}">
        <div class="modal__blur" @click="close"></div>
        <div class="modal__container">
        <div class="modal__block">
            <div class="modal__header">
                <i class="fas fa-info-circle"></i> Opis usterki
                <a href="#" @click.prevent="close" title="Zamknij" class="modal__close">
                    <i class="fas fa-times"></i>
                </a>
            </div>

            <div class="modal__content" v-if="description">
                <div class="modal__description">
                    {{description}}
                </div>
            </div>
        </div>
        </div>
    </div>
</template>
<script>
    export default {
        name: "DescriptionModal",
        data() {
            return {
                isShow: false,
                description:null,

            }
        },
        methods: {
            close() {
                this.isShow = !this.isShow
                setTimeout(() => {
                    this.description = null
                }, 500);
            },
            show(description) {
                this.isShow = !this.isShow
                this.description = description
            },

        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/modal";
</style>