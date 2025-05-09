<template>
  <section class="py-16 bg-gray-100">
    <h2 class="text-3xl text-center mb-6">Événements à venir</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-6">
      <div v-for="event in events" :key="event.id" class="p-4 border rounded shadow">
        <h3 class="text-xl font-semibold">{{ event.title }}</h3>
        <p class="text-sm text-gray-600">{{ new Date(event.date).toLocaleDateString('fr-FR') }}</p>
        <a :href="`/events/${event.id}`" class="block mt-4 text-red-500">Voir l'événement</a>
      </div>
    </div>
  </section>
</template>

<script setup>
defineProps({
  events: Array
});
</script>