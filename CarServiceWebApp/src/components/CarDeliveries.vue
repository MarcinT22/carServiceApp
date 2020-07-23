<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Przyjęcia pojazdów
            </h1>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="dashboard__title">
                    Dzisiejsze <span v-if="todaysCarDeliveries">({{todaysCarDeliveries.length}})</span>
                </div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(todaysCarDelivery, index) in todaysCarDeliveries">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <button class="block__delete" @click="remove(todaysCarDelivery.id, index)">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            <div class="block__data">
                                <table>
                                    <tr>
                                        <td class="bold">Model:</td>
                                        <td> {{todaysCarDelivery.car.brand}} {{todaysCarDelivery.car.model}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{todaysCarDelivery.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{todaysCarDelivery.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{todaysCarDelivery.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Nr rej.:</td>
                                        <td>{{todaysCarDelivery.car.registration_number}}</td>
                                    </tr>

                                </table>
                                <hr>
                                <div class="block__action">
                                    <button href="#" class="block__actionBtn block__actionBtn--info"
                                            @click="showDescription(todaysCarDelivery.description)">
                                        <i class="fas fa-info-circle"></i> Opis usterki
                                    </button>
                                    <button @click="confirmCarDelivery(todaysCarDelivery.id, index)"
                                            class="block__actionBtn block__actionBtn--accept">
                                        <i class="far fa-check-circle"></i> Odebrano
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="dashboard__title">
                    W kolejnych dniach <span
                        v-if="remainingCarDeliveries">({{remainingCarDeliveries.length}})</span>
                </div>
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4 dashboard__col--notFlex"
                         v-for="(remainingCarDelivery, index) in remainingCarDeliveries">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <button class="block__delete" @click="remove(remainingCarDelivery.id, index)">
                                <i class="fas fa-times-circle"></i>
                            </button>
                            <div class="block__data">
                                <table>
                                    <tr>

                                        <td class="bold">Model:</td>
                                        <td> {{remainingCarDelivery.car.brand}} {{remainingCarDelivery.car.model}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{remainingCarDelivery.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{remainingCarDelivery.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{remainingCarDelivery.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Nr rej.:</td>
                                        <td>{{remainingCarDelivery.car.registration_number}}</td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="block__text">
                                    <strong>Data dostarczenia pojazdu:</strong><br/>
                                    <template v-if="remainingCarDelivery.new_reported_car_date">
                                        {{$formatDate(remainingCarDelivery.new_reported_car_date)}}
                                    </template>
                                    <template v-else>
                                        {{$formatDate(remainingCarDelivery.reported_car_date)}}
                                    </template>
                                </div>
                                <hr>
                                <div class="block__action">
                                    <button href="#" class="block__actionBtn block__actionBtn--info"
                                            @click="showDescription(remainingCarDelivery.description)">
                                        <i class="fas fa-info-circle"></i> Opis usterki
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
    import axios from 'axios'
    import DescriptionModal from '@/components/DescriptionModal'

    export default {
        name: "CarDeliveries",
        data() {
            return {
                todaysCarDeliveries: 0,
                remainingCarDeliveries: 0,
                isLoading: true,
            }
        },
        methods: {
            confirmCarDelivery(id, index) {
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.get('/confirmCarDelivery/' + id)
                    .then(response => {
                        this.todaysCarDeliveries.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.$store.dispatch('message', 'Samochód został dostarczony do warsztatu.')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            showDescription(description) {
                this.$refs['descriptionModal'].show(description)
            },
            remove(id,index){
                document.getElementById('blockProcessingIndex-' + index).classList.add('block--processing')
                axios.delete('/reportedCars/' + id)
                    .then(response => {
                        this.todaysCarDeliveries.splice(index, 1);
                        document.getElementById('blockProcessingIndex-' + index).classList.remove('block--processing')
                        this.$store.dispatch('message', 'Usunięto.')
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }

        },
        mounted() {
            axios.get('/getCarDeliveries')
                .then(response => {
                    this.todaysCarDeliveries = response.data.data.todaysCarDeliveries
                    this.remainingCarDeliveries = response.data.data.remainingCarDeliveries
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

