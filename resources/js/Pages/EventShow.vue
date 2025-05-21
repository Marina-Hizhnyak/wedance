<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { defineProps } from 'vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
    event: Object
})
</script>

<template>
  <div class="bg-gradient-to-b from-[#1a0a05] to-background text-white min-h-screen font-inter">
    <!-- Page header -->
    <section class="text-center pt-24 pb-12">
      <h1 class="text-5xl font-bold text-yellow-400 font-title">{{ event.title }}</h1>
      <p class="mt-4 text-gray-300">{{ event.date }} — {{ event.location }}</p>
    </section>

    <!-- Main content section -->
    <section class="max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-start px-6 md:px-8 pb-20 gap-8">
      <!-- Event image -->
      <div class="w-full md:w-1/2">
        <img
          v-if="event.image"
          :src="`/images/${event.image}`"
          :alt="event.title"
          class="w-full rounded-xl shadow-lg"
        />
      </div>

      <!-- Event description and CTA button -->
      <div class="w-full md:w-1/2">
        <p class="text-lg text-gray-300 mb-6">{{ event.description }}</p>

        <!-- Call-to-action button -->
        <a
          href="/inscription"
          class="inline-block bg-primary text-black font-bold px-8 py-3 rounded-full shadow-md hover:scale-105 hover:bg-secondary transition"
        >
          S’inscrire maintenant
        </a>
      </div>
    </section>
  </div>
</template>

