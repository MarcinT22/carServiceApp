<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Kalendarz przyjęć pojazdów
            </h1>

            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <fullcalendar
                        :plugins="calendarPlugins"
                        :header="calendarHeader"
                        :buttonText="calendarButtonText"
                        locale="pl"
                        :weekends="false"
                        :selectable="false"
                        :editable="false"
                        :events="getAcceptedReportedCars"
                        @eventClick="clickEvent"
                        :all-day-slot="false"
                        min-time="08:00:00"
                        max-time="17:00:00"
                        height="auto"
                        :business-hours="businessHours"
                        slot-duration="00:15:00"
                        :slot-label-format="slotLabelFormat"
                        :column-header-format="columnHeaderFormat"
                        defaultView="dayGridMonth"


                />
            </div>

        </div>
        <EventModal ref="eventModal"></EventModal>
    </div>
</template>

<script>

    require('@fullcalendar/core/main.min.css')
    require('@fullcalendar/daygrid/main.min.css')
    require('@fullcalendar/timegrid/main.min.css')
    import Fullcalendar from '@fullcalendar/vue'
    import DayGrid from '@fullcalendar/daygrid'
    import TimeGrid from '@fullcalendar/timegrid'
    import InteractionPlugin from '@fullcalendar/interaction'
    import ListPlugin from '@fullcalendar/list'
    import axios from 'axios'

    import EventModal from '@/components/EventModal'
    import {mapGetters} from 'vuex'
    export default {
        name: "CarDeliveriesCalendar",
        data: () => ({
            calendarPlugins: [
                TimeGrid,
                DayGrid,
                InteractionPlugin,
                ListPlugin,
            ],
            calendarHeader: {
                left: 'prev today next',
                center: '',
                right: 'title'
            },
            calendarButtonText: {
                today: 'Dzisiaj',
                month: 'Miesiąc',
                week: 'Tydzień',
                day: 'Dzień',
                list: 'Lista',
            },
            businessHours: {
                startTime: '08:00',
                endTime: '17:00',
            },
            slotLabelFormat: {
                hour: 'numeric',
                minute: '2-digit',
                omitZeroMinute: false,
                meridiem: 'short',
            },
            columnHeaderFormat: {
                weekday: 'short',
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                year: '2-digit'
            },
            events: [],

        }),
        components: {
            EventModal,
            Fullcalendar,
        },
        methods:{
            clickEvent(arg)
            {
                this.$refs['eventModal'].show(arg.event,'delivery')
            },



        },
        computed: mapGetters(['getAcceptedReportedCars','isLoading']),
        created() {
            this.$store.dispatch('getAcceptedReportedCars')

        },
    }
</script>

<style scoped lang="scss">
    @import "../assets/scss/config";
    @import "../assets/scss/dashboard";

</style>
<style lang="scss">
    @import "../assets/scss/calendar";

</style>





