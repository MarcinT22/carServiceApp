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
            padding:50px;
            box-sizing: border-box;
            background: #fff;

        }

        h1 {
            margin: 0;
            color:$textColor;
            font-size:30px;
            text-align: center;
            font-weight: 800;
        }

        h2 {
            margin: 10px 0;
            color: $mainColor;
            font-size:14px;
            text-align: center;
            color:$textColor;
            font-weight: 400;
        }

        a{
            width:100%;
            display: block;
            font-size:14px;
            font-weight: 600;
            text-decoration: none;
            color:#fff;
            text-align: center;
            text-transform: uppercase;
            padding:8px 10px;
            box-sizing: border-box;
            max-width:260px;
            margin:0 auto;
            border-radius: 4px;
            transition:background 0.3s;
            margin-top:20px;
            background: rgba(0,0,0,0);
            color:$mainColor;
            border:1px solid $mainColor;

            &:hover{
                background: $mainColor;
                color:#fff;
            }

            &:active{

            }
        }
    }

</style>
