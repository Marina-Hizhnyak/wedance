<template>
  <div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-4xl font-bold text-primary text-center mb-12 font-title">Notre Galerie</h1>

    <!-- Gallery Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div
        v-for="item in media"
        :key="item.id"
        class="group relative overflow-hidden rounded-xl shadow-lg bg-white hover:shadow-2xl transition duration-300"
      >
        <!-- Image -->
        <img loading="lazy"
          :src="`/images/gallery/${item.image}`"
          :alt="item.title"
          class="w-full h-72 object-cover transform group-hover:scale-105 transition duration-500"
        />

        <!-- Overlay Title -->
        <div
          class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-center py-2 px-4 text-sm font-semibold"
        >
          {{ item.title || 'Sans titre' }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  media: Array,
})
</script>
