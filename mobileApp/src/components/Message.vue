<template>
    <div class="message">

        <div class="message__block">
            <template v-if="getMessageType == 'visit'">
                <svg class="icon icon--noFill" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     aria-hidden="true" focusable="false" width="1em" height="1em"
                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                     preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512">
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192s192-86 192-192z" fill="none"
                          stroke="#626262" stroke-miterlimit="10" stroke-width="32"/>
                    <path fill="none" stroke="#626262" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"
                          d="M352 176L217.6 336L160 272"/>
                </svg>
                <p>Zgłoszenie jest w trakcie przetwarzania.</p>
                <p>Prosimy na bieżąco sprawdzać status zlecenia.</p>
            </template>
            <template v-else-if="getMessageType == 'isCarReported'">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false"
                     width="1em" height="1em"
                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                     preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                    <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z"
                          fill="#626262"/>
                    <path d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"
                          fill="#626262"/>
                    <rect x="0" y="0" width="1024" height="1024" fill="rgba(0, 0, 0, 0)"/>
                </svg>
                <p>Samochód został już zgłoszony.</p>
            </template>
            <template v-else>
                <svg class="icon" xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false"
                     width="1em" height="1em"
                     style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);"
                     preserveAspectRatio="xMidYMid meet" viewBox="0 0 1024 1024">
                    <path d="M512 64C264.6 64 64 264.6 64 512s200.6 448 448 448s448-200.6 448-448S759.4 64 512 64zm0 820c-205.4 0-372-166.6-372-372s166.6-372 372-372s372 166.6 372 372s-166.6 372-372 372z"
                          fill="#626262"/>
                    <path d="M464 336a48 48 0 1 0 96 0a48 48 0 1 0-96 0zm72 112h-48c-4.4 0-8 3.6-8 8v272c0 4.4 3.6 8 8 8h48c4.4 0 8-3.6 8-8V456c0-4.4-3.6-8-8-8z"
                          fill="#626262"/>
                    <rect x="0" y="0" width="1024" height="1024" fill="rgba(0, 0, 0, 0)"/>
                </svg>
                <p>Zgłoszenie zostało anulowane.</p>
            </template>
        </div>
        <button class="btn tap-effect" @click="logout">
            OK
        </button>


    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: "Message",
        computed: mapGetters(['getMessageType']),
        methods: {
            logout() {
                this.$store.state.isLoading = true
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            },
        },
        created() {

            setTimeout(() => this.$store.state.isLoading = false, 500);
        },
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .message {

        &__block {
            font-size: 15px;
            color: $mainColor;
            text-align: center;


            .icon {
                font-size: 40px;

                path {
                    stroke: $mainColor;
                    fill:$mainColor;
                }

                &--noFill{
                    path{
                        fill:none;
                    }
                }

            }
        }


    }
</style>
