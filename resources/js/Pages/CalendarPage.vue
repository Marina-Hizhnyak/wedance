<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { defineProps } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { router, usePage } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const props = defineProps({
    events: Array,
})

const calendarOptions = {
    plugins: [dayGridPlugin, interactionPlugin],
    initialView: 'dayGridMonth',
    events: props.events,
    eventColor: '#06b6d4',
    headerToolbar: {
        start: 'prev,next today',
        center: 'title',
        end: 'dayGridMonth,dayGridWeek'
    },
    eventClick(info) {
        if (info.event.url) {
            window.open(info.event.url, '_blank')
            info.jsEvent.preventDefault()
        }
    },


}
</script>

<template>
    <div class="max-w-6xl mx-auto py-10 text-white">
        <h1 class="text-3xl font-bold text-primary mb-6">Calendrier des cours et événements</h1>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<style>
.fc {
    background-color: #1a1a1a;
    border-radius: 8px;
    padding: 1rem;
    border-color: #FFB400;
    color: #FFB400;
}
.fc .fc-toolbar-title,
.fc .fc-daygrid-day-number {
    color: #FFB400;
}
.fc-event-title,
.fc-event-title-container {
    white-space: normal !important;
    word-wrap: break-word;
    line-height: 1.2em;
    font-weight: bold;
}
.fc-daygrid-event {
    min-height: 40px;
    padding: 2px 4px;
    font-size: 0.85rem;
}
.fc-daygrid-day-frame {
    border: 1px solid #FFB400 !important;
}

.fc .fc-toolbar-title {
    color: #FFB400 !important;
    font-weight: bold;
    font-size: 1.5rem;
}

.fc .fc-button {
    background-color: #121212;
    border: 1px solid #FFB400;
    color: #FFB400;
    font-weight: bold;
}
.fc .fc-button-primary:not(:disabled).fc-button-active,
.fc .fc-button-primary:not(:disabled):active {
    background-color: #FFB400;
    color: #121212;
}
.fc .fc-button:focus {
    box-shadow: none;
}
</style>


