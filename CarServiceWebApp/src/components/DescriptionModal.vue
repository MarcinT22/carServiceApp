<template>
    <div class="modal" :class="{'modal--show':isShow}">
        <div class="modal__blur" @click="close"></div>
        <div class="modal__container">
        <div class="modal__block">
            <div class="modal__header">
                <i class="fas fa-info-circle"></i> {{title}}
                <a href="#" @click.prevent="close"  class="modal__close">
                    <i class="fas fa-times"></i>
                </a>
            </div>

            <div class="modal__content" v-if="description">
                <div class="modal__text">
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
                title:null,

            }
        },
        methods: {
            close() {
                this.isShow = !this.isShow
                document.body.classList.remove('overflow');
            },
            show(description, title) {
                document.body.classList.add('overflow');
                this.isShow = !this.isShow
                this.description = description
                this.title = title
            },

        },

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/modal";
</style>
