<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <div class="table">
                <table>
                    <thead>
                    <tr>
                        <th>
                            Dane pojazdu
                        </th>
                        <th>
                           Data dostarczenia pojazdu
                        </th>
                        <th>
                            Akcje
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            VW polo 2008 1.4
                        </td>
                        <td>
                            21.12.20
                        </td>
                        <td>
                            <div class="action">
                                <a href="#" class="action__button action__button--success"><i class="far fa-check-circle"></i> Akceptuj</a>
                                <a href="#" class="action__button"><i class="far fa-calendar-alt"></i> Zmień datę</a>
                                <a href="#" class="action__button action__button--info"><i class="far fa-question-circle"></i> Info</a>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ReportedCars"
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";
    @import "../assets/scss/table";
</style>
