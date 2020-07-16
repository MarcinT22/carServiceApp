<template>
    <div class="error">
        <div class="error__content">
            <h1>
                404
            </h1>
            <h2>
                Przepraszamy, podana strona nie istnieje.
            </h2>
            <router-link :to="{name:'Home'}">Przejdź do głównej strony</router-link>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Error"
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    .error {
        padding: 15px;
        height: 100%;

        &__content{
            height: 100%;
            max-width:350px;
            margin:30px auto;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding:25px;
            box-sizing: border-box;
            border:1px solid #f3f3f3;

        }

        h1 {
            margin: 0;
            color:$mainColor;
            font-size:30px;
            text-align: center;
        }

        h2 {
            margin: 0;
            color: $mainColor;
            font-size:14px;
            text-align: center;
        }

        a{
            width:100%;
            display: block;
            font-size:14px;
            font-weight: bold;
            text-decoration: none;
            color:#fff;
            text-align: center;
            text-transform: uppercase;
            padding:8px 10px;
            box-sizing: border-box;
            max-width:260px;
            margin:0 auto;
            border-radius: 5px;
            background:$mainColor;
            transition:background 0.3s;
            margin-top:30px;

            &:hover{
                background: $mainColor;
            }
        }
    }

</style>
