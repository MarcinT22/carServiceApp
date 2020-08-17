<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
             Lista użytkowników
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="dashboard__action">
                   <router-link :to="{name:'AddUser'}" class="dashboard__actionBtn dashboard__actionBtn--accept">
                       <i class="fas fa-user-plus"></i> Nowy użytkownik
                   </router-link>
                </div>
                <div class="block block--baseline">
                    <div v-for="(user, index) in getUsers" class="block__item" :id="'userId-'+index">
                        <div class="block__itemCol">
                            {{user.email}} <span v-if="user.is_admin" class="block__highlight">administrator</span>
                        </div>
                        <div class="block__itemCol">
                           <div class="block__action block__action--row" v-if="!isLoading">
                               <button class="block__actionBtn block__actionBtn--info">
                                   <i class="fas fa-edit"></i> Edytuj
                               </button>
                               <button class="block__actionBtn block__actionBtn--cancel" @click="remove(user.id, index)">
                                   <i class="fas fa-trash-alt"></i> Usuń
                               </button>

                           </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    export default {
        name: "Users",
        computed: mapGetters(['isLoading','getUsers']),
        created() {
            this.$store.dispatch('getUsers')
        },
        methods:{
            remove(id, index)
            {
                document.getElementById('userId-' + index).classList.add('block__item--processing')
                this.$store.dispatch('deleteUser', {id, index})
                    .then(()=>{
                        document.getElementById('userId-' + index).classList.remove('block__item--processing')
                        this.$store.dispatch('message', 'Użytkownik został usunięty.')
                    })
            }
        }
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";


</style>
