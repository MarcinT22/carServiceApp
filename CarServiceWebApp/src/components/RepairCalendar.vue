<template>
    <div class="dashboard">
        <div class="dashboard__container">
            <h1>
                Kalendarz napraw
            </h1>

            <div class="loading loading--allPage" v-if="isLoading"></div>
            <div class="loadingContainer" :class="{active:!isLoading}">
                <div class="legend">
                    <div class="legend__block" v-for="status in getStatusesList">
                        <span class="legend__background" :style="{background:status.color}"></span> - {{status.name}}
                    </div>
                </div>
                <fullcalendar
                        :plugins="calendarPlugins"
                        :header="calendarHeader"
                        :buttonText="calendarButtonText"
                        locale="pl"
                        :weekends="false"
                        :selectable="false"
                        :editable="true"
                        :events="getSheduledEvents"
                        @eventDrop="updateEventDate"
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
                <div class="legend">
                    <div class="legend__block" v-for="status in getStatusesList">
                        <span class="legend__background" :style="{background:status.color}"></span> - {{status.name}}
                    </div>
                </div>
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
        name: "RepairCalendar",
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


        }),
        components: {
            Fullcalendar,
            EventModal,
        },
        computed: mapGetters(['getStatusesList','getSheduledEvents','isLoading']),
        methods:{
            clickEvent(arg)
            {
                this.$refs['eventModal'].show(arg.event,'repair')
            },
            updateEventDate(arg)
            {
                axios.put('/events/' + arg.event.id, {
                    start: arg.event.start,
                })
            }

        },
        created() {
            this.$store.dispatch('getStatusList')
            this.$store.dispatch('getSheduledEvents')
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





