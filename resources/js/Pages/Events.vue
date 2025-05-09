<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
defineProps({ events: Array })
</script>

<template>
  <div class="bg-gradient-to-b from-[#1a0a05] to-background text-white min-h-screen font-inter">
    <!-- Заголовок -->
    <section class="text-center pt-24 pb-12">
      <h1 class="text-5xl font-bold text-primary font-title">Nos Événements</h1>
      <p class="mt-6 text-lg text-gray-300 max-w-2xl mx-auto">
        Retrouvez ici nos événements à venir et les meilleurs moments passés ensemble.
      </p>
    </section>

<section class="grid gap-10 px-8 md:grid-cols-2 lg:grid-cols-3 max-w-7xl mx-auto pb-20">
  <div
    v-for="event in events"
    :key="event.id"
    class="bg-[#1f1f1f] rounded-xl shadow-lg overflow-hidden"
  >
    <img :src="`/storage/${event.image}`" alt="" class="w-full h-56 object-cover" />
    <div class="p-6">
      <h3 class="text-2xl font-semibold text-yellow-400 mb-2">{{ event.title }}</h3>
      <p class="text-sm text-gray-300 mb-4">{{ event.description }}</p>
      <p class="text-xs text-gray-400 mb-4">📅 {{ event.date }}</p>
      <button class="bg-primary text-black px-4 py-2 font-bold rounded-full hover:scale-105 transition">
        Réserver ma place
      </button>
    </div>
  </div>
</section>


  </div>
</template>
