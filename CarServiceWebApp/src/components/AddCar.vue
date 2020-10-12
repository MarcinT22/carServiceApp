<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Nowy samochód
            </h1>
            <div class="block block--baseline">
                <form @submit.prevent="addCar">
                    <div class="block__field">
                        <label for="brand">Marka</label>
                        <input type="text" v-model="brand" autocomplete="off" id="brand" readonly
                               @click="showBrands" @blur="hiddenBrandsList">
                        <ul v-if="showBrandsList" id="brandsList" class="block__list">
                            <li v-for="(car, index) in carsList" @click="selectCar(index)">
                                {{car.brand}}
                            </li>
                        </ul>
                    </div>
                    <div class="block__field" v-if="models.length">
                        <label for="brand">Model</label>
                        <input type="text" v-model="model" autocomplete="off" id="model" readonly @click="showModels"
                               @blur="hiddenModelsList">
                        <ul id="modelsList" class="block__list" v-if="showModelsList">
                            <li v-for="model in models" @click="selectModel(model)">
                                {{model}}
                            </li>
                        </ul>
                    </div>
                    <div class="block__field">
                        <label for="year">Rok produkcji</label>
                        <input type="text" v-model="year" maxlength="4" autocomplete="off" id="year" :class="{'error':yearError}">
                        <div class="block__error" v-if="yearError">
                            Wprowadź prawidłową wartość
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="engine">Pojemność silnika (cm<sup>3</sup>)</label>
                        <input type="text" id="engine" v-model="engine" maxlength="4" :class="{'error':engineError}">
                        <div class="block__error" v-if="engineError">
                            Wprowadź prawidłową wartość
                        </div>
                    </div>
                    <div class="block__field">
                        <label for="fuel">Rodzaj paliwa</label>
                        <input type="text" v-model="fuel" autocomplete="off" id="fuel" readonly @click="showFuels"
                               @blur="hiddenFuelsList">
                        <ul id="fuelsList" v-if="showFuelsList" class="block__list">
                            <li @click="selectFuel('Benzyna')">
                                Benzyna
                            </li>
                            <li @click="selectFuel('Diesel')">
                                Diesel
                            </li>
                            <li @click="selectFuel('Benzyna + LPG')">
                                Benzyna + LPG
                            </li>
                            <li @click="selectFuel('Hybryda')">
                                Hybryda
                            </li>
                            <li @click="selectFuel('Elektryczny')">
                                Elektryczny
                            </li>
                        </ul>
                    </div>
                    <div class="block__field">
                        <label for="registration_number">Numer rejestracyjny</label>
                        <input type="text" v-model="registration_number" id="registration_number"  autocomplete="off" class="uppercase"/>
                    </div>
                    <div class="block__field">
                        <label for="vin">VIN</label>
                        <input type="text" v-model="vin" id="vin" class="uppercase"  autocomplete="off"/>
                    </div>
                    <button v-if="!isAdding && brand && model && year && engine && fuel && registration_number && vin"
                            class="block__actionBtn block__actionBtn--accept">
                        Dodaj samochód
                    </button>
                    <div class="loading loading--normal" v-if="isAdding"></div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "AddCar",
        data() {
            return {
                carsList: null,
                models: [],
                brand: '',
                model: '',
                year: '',
                fuel: '',
                engine: '',
                registration_number: '',
                vin: '',
                showBrandsList: false,
                showModelsList: false,
                showFuelsList: false,
                isAdding: false,
                yearError:false,
                engineError:false

            }
        },
        methods: {
            selectCar(index) {
                this.model = null,
                    this.models = this.carsList[index].models;
                this.brand = this.carsList[index].brand;

            },
            selectModel(model) {
                this.model = model;

            },

            selectFuel(fuel) {
                this.fuel = fuel
            },

            showBrands() {
                this.showBrandsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true

            },
            showModels() {
                this.showModelsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true

            },

            showFuels() {
                this.showFuelsList = true
                document.body.classList.add('overflow');
                this.$store.state.blur = true
            },


            hiddenBrandsList() {
                setTimeout(() => {
                    this.showBrandsList = false
                    document.body.classList.remove('overflow');
                }, 300)
            },
            hiddenModelsList() {
                setTimeout(() => {
                    this.showModelsList = false
                    document.body.classList.remove('overflow');
                }, 300)
            },
            hiddenFuelsList() {
                setTimeout(() => {
                    this.showFuelsList = false
                    document.body.classList.remove('overflow');
                }, 300)
            },
            addCar() {
                this.yearError = false
                this.engineError = false
                if (isNaN(this.year) || isNaN(this.engine)) {
                   if (isNaN(this.year))
                   {
                       this.yearError = true

                   }
                   if (isNaN(this.engine))
                   {
                       this.engineError = true
                   }
                }
                else{
                    this.isAdding = true
                    let brand = this.brand
                    let model = this.model
                    let year = this.year
                    let fuel = this.fuel
                    let engine = this.engine
                    let registration_number = this.registration_number.toUpperCase()
                    let vin = this.vin.toUpperCase()
                    this.$store.dispatch('addCar',{
                        brand,model,year,fuel,engine,registration_number,vin
                    })
                        .then(()=>{
                            this.isAdding = false
                            this.$store.dispatch('message', 'Samochód został dodany.')
                            this.$router.push({'name':'NewReportedCar'})
                        })


                }


            },

        },
        created() {
            this.$store.state.blur = false
            axios.get('/getCarsModels')
                .then(response => {
                    this.carsList = response.data
                })

            setTimeout(() => this.$store.state.isLoading = false, 500);

        },
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/block";
</style>
