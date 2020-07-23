<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
               Pojazdy do wydania <span v-if="readyCars">({{readyCars.length}})</span>
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div v-if="readyCars.length == 0" class="dashboard__empty">Brak</div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(readyCar, index) in readyCars">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <button class="block__delete" @click="remove(readyCar.id, index)">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            <div class="block__data">
                                <table>
                                    <tr>
                                        <td class="bold">Model:</td>
                                        <td> {{readyCar.reported_car.car.brand}} {{readyCar.reported_car.car.model}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{readyCar.reported_car.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{readyCar.reported_car.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{readyCar.reported_car.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Nr rej.:</td>
                                        <td>{{readyCar.reported_car.car.registration_number}}</td>
                                    </tr>

                                </table>
                                <hr>
                                <div class="block__text block__text--center">
                                    <strong>Cena naprawy:</strong>
                                    <span class="highlight">
                                      {{readyCar.price.toFixed(2)}} zł
                                    </span>

                                </div>
                                <hr>
                                <div class="block__action">
                                    <button href="#" class="block__actionBtn block__actionBtn--info"
                                            @click="showDescription(readyCar.description)">
                                        <i class="fas fa-info-circle"></i> Szczegóły naprawy
                                    </button>
                                    <button @click="complete(readyCar.id, index)"
                                            class="block__actionBtn block__actionBtn--accept">
                                        <i class="far fa-check-circle"></i> Wydano
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <DescriptionModal ref="descriptionModal"></DescriptionModal>
    </div>
</template>

<script>
    import axios from 'axios';

    import DescriptionModal from '@/components/DescriptionModal'
    export default {
        name: "ReadyCars",
        data()
        {
            return{
                isLoading:true,
                readyCars:0

            }
        },
        methods:{
            complete(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.put('/events/' + id, {
                    status_id: 5,
                })
                    .then(response => {
                        this.readyCars.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.$store.dispatch('message', 'Pojazd został wydany.')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            showDescription(description, title) {
                this.$refs['descriptionModal'].show(description, 'Szczegóły naprawy')
            }
        },
        mounted() {
            axios.get('/getReadyCars')
                .then(response => {
                    this.readyCars = response.data.data
                    this.isLoading = false
                })
                .catch(error => {
                    console.log(error)
                })
        },
        components: {DescriptionModal},
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";

</style>
