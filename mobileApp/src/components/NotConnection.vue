<template>
    <div class="notConnection">
        <div class="notConnection__content">
            <svg class="wifi-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="1em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M12 18.992a1 1 0 1 1 0-2a1 1 0 0 1 0 2zM9.894 16.44a1 1 0 0 1-1.788-.894a4.355 4.355 0 0 1 7.788 0a1 1 0 1 1-1.788.894a2.353 2.353 0 0 0-4.212 0zM6.8 13.595a1 1 0 0 1-1.6-1.2a8.503 8.503 0 0 1 13.6 0a1 1 0 1 1-1.6 1.2a6.503 6.503 0 0 0-10.4 0zm-3.057-2.93a1 1 0 0 1-1.486-1.336c4.843-5.377 13.13-5.813 18.512-.973c.342.307.667.632.974.973a1 1 0 1 1-1.486 1.338a10.91 10.91 0 0 0-.826-.826c-4.56-4.101-11.584-3.733-15.688.825z" fill="#626262"/></svg>
            Trwa nawiązywanie połączenia z internetem...
            <span>
                Sprawdź, czy masz włączony dostęp do sieci.
            </span>
        </div>
    </div>
</template>

<script>
    export default {
        name: "NotConnection",
        created() {
            setTimeout(() => this.$store.state.isLoading = false, 500);
        }
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";

    .notConnection {
        position: fixed;
        top: 20px;
        right: 20px;
        bottom: 20px;
        left: 20px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;

        &__content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #333;
            font-size: 16px;
            text-align: center;

            span{
                font-size:13px;
                margin-top:20px;
            }
        }

        button {
            color: $mainColor;
            background: none;
            border: 0;
            margin-top: 40px;
            font-size: 14px;
            margin-left: -10px;
            outline: none;

            &:active {
                opacity: 0.8;
            }
        }
    }

    .wifi-icon {
        font-size: 40px;
        margin-bottom: 10px;
        animation: pulse 1s ease-in-out infinite;

        path {
            fill: $mainColor;
        }
    }


    @keyframes pulse {
        0% {
            transform: scale(1)
        }


        50% {
            transform: scale(1.5)
        }


        100% {
            transform: scale(1)
        }


    }

</style>