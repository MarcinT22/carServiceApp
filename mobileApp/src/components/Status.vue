<template>
    <div class="status">

        <h1>
            <i class="fas fa-project-diagram"></i>
            Status naprawy
        </h1>

        <div class="status__block">
            Przyjęte do realizacji
        </div>



    </div>
</template>

<script>
    export default {
        name: "Status"
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    .status{
        &__block{
            margin:40px 0;
            padding:20px;
            box-sizing: border-box;
            border-radius: 10px;
            background:#fff;
            font-size:18px;
            text-align: center;
            background:#318af2;
            color:#fff;
            box-shadow:5px 5px 5px 0 rgba(0,0,0,0.2);
        }


    }
</style>