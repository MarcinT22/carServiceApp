<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Statusy
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="statusList">
                    <div class="statusList__item" v-for="(status, index) in getStatusesList">
                        <div class="statusList__col">

                            <template  v-if="statusIndex != index">
                                <div class="statusList__number">
                                    {{index+1}}
                                </div>
                            <span :style="{'background':status.color}"></span>
                            <div class="statusList__text">
                                {{status.name}}
                            </div>
                            </template>
                            <template  v-if="statusIndex === index">
                            <input type="color" v-model="status.color" class="statusList__colorInput">
                            <input type="text" v-model="name" class="statusList__input">
                            </template>

                        </div>
                        <div class="statusList__col">
                           <div class="statusList__action">
                               <button @click="edit(index, status.name)" v-if="statusIndex != index"  class="statusList__button">
                                   Edytuj
                               </button>
                               <template v-if="statusIndex === index && savingIndex != index">
                                   <button @click="statusIndex = null"  class="statusList__button statusList__button--cancel">
                                       Anuluj
                                   </button>
                                   <button @click="save(index,status.id, name,status.color)" v-if="name" class="statusList__button statusList__button--save">
                                       Zapisz
                                   </button>
                               </template>
                               <div class="loading loading--static loading--mCenter" v-if="savingIndex === index"></div>
                           </div>

                        </div>
                    </div>
                    <ol>
                        <li>
                            <p>
                                1 - Status wyświetlany podczas przyjęcia zlecenia do realizacji
                            </p>
                        </li>
                        <li>
                            <p>
                                2 - Status wyświetlany podczas realizacji zlecenia
                            </p>
                        </li>
                        <li>
                            <p>
                                3 - Status wyświetlany podczas wstrzymania zlecenia
                            </p>
                        </li>
                        <li>
                            <p>
                                4 - Status wyświetlany, gdy zlecenie zostało wykonane
                            </p>
                        </li>
                        <li>
                            <p>
                                5 - Status wyświetlany, gdy zlecenie zostało zakończone
                            </p>
                        </li>
                    </ol>
                </div>



            </div>


        </div>
    </div>

</template>

<script>
    import {mapGetters} from 'vuex'
    import axios from 'axios'
    export default {
        name: "StatusList",
        data()
        {
            return{
                statusIndex:null,
                savingIndex:null,
                name:null,
            }
        },
        computed: mapGetters(['getStatusesList','isLoading']),
        created() {
            this.$store.dispatch('getStatusList')
        },
        methods:{
            edit(index, name)
            {
                this.statusIndex = index
                this.name = name
            },
            save(index, id, name, color)
            {
                this.savingIndex = index
                axios.put('/statuses/' + id, {
                    name: name,
                    color: color,
                }).then(()=>{
                    this.$store.dispatch('getStatusList')
                        .then(()=>{
                            this.statusIndex = null
                            this.$store.dispatch('message', 'Zapisano.')
                            this.savingIndex = null
                        })


                })
            }
        }

    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/statusList";

</style>
