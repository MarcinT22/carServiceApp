<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Zgłoszenia oczekujące ({{reportedCars.length}})
            </h1>
            <div class="message" :class="{active:showMessage}">
                <div class="message__icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <div class="message__text">
                    <!--{{message}}-->
                    Zgłoszenie zostało zaakceptowane
                </div>
            </div>
            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="dashboard__row">
                    <div class="dashboard__col dashboard__col--4" v-for="(reportedCar, index) in reportedCars">
                        <div class="block block--baseline" :id="'blockProcessingIndex-'+index">
                            <div class="block__data">
                                <table>
                                    <tr>
                                        <td class="bold">Model:</td>
                                        <td> {{reportedCar.car.brand}} {{reportedCar.car.model}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Rok:</td>
                                        <td>{{reportedCar.car.year}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Paliwo:</td>
                                        <td>{{reportedCar.car.fuel}}</td>
                                    </tr>
                                    <tr>
                                        <td class="bold">Silnik:</td>
                                        <td> {{reportedCar.car.engine}} cm<sup>3</sup></td>
                                    </tr>
                                </table>
                                <hr>
                                <div class="block__text">
                                    <strong>Data dostarczenia pojazdu:</strong><br/>
                                    {{formatDate(reportedCar.reported_car_date)}}
                                </div>
                                <hr>
                                <div class="block__text">
                                    <strong>Opis usterki:</strong><br/>
                                    {{reportedCar.description}}
                                </div>
                                <div class="block__action">
                                    <button class="block__actionBtn block__actionBtn--accept" @click="accept(reportedCar.id, index)">
                                        <i class="far fa-check-circle"></i> Akceptuj
                                    </button>
                                    <button href="#" class="block__actionBtn block__actionBtn--changeDate">
                                        <i class="far fa-calendar-alt"></i> Zaproponuj inną datę
                                    </button>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import DatePicker from 'vue2-datepicker';
    import 'vue2-datepicker/index.css';
    import 'vue2-datepicker/locale/pl';
    import moment from 'moment'

    export default {
        name: "ReportedCars",
        data() {
            return {
                reportedCars: null,
                isLoading:true,
                message:null,
                showMessage:false,
                new_reported_car_date: null,
            }
        },
        methods:{
          accept(id, index){
                document.getElementById('blockProcessingIndex-'+index).classList.add('block--processing')
                axios.get('/acceptReportedCar/'+id)
                  .then(response => {
                      this.reportedCars.splice(index,1);
                      document.getElementById('blockProcessingIndex-'+index).classList.remove('block--processing')
                      this.message="Zgłoszenie zostało zaakceptowane";
                      this.showMessage=true
                      setTimeout(() => this.showMessage = false, 2000);
                  })
                  .catch(error => {
                      console.log(error)
                  })
          },
            formatDate(date) {
                return moment(String(date)).format('DD.MM.YYYY')
            }

        },
        mounted() {
            axios.get('/getNotAcceptedReportedCars')
                .then(response => {
                    this.reportedCars = response.data.data.reportedCars
                    this.isLoading = false
                })
                .catch(error => {
                    console.log(error)
                })
        },
        components: {DatePicker},
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
    @import "../assets/scss/message";

</style>
