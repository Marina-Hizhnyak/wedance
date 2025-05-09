
<script setup>
import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { defineProps } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  events: Array
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
  }
}
</script>

<template>
    <!-- <pre class="text-white text-xs">{{ events }}</pre> -->

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
</style>
