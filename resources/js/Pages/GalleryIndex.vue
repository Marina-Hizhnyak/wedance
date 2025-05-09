<template>
  <div class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-primary text-center mb-10">Galerie</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
      <div v-for="item in media" :key="item.id" class="rounded overflow-hidden shadow-lg">
        <img :src="`/storage/${item.image}`" :alt="item.title" class="w-full h-64 object-cover" />
        <div class="p-4 bg-background text-gray-800">
          <p class="font-semibold text-sm">{{ item.title || 'Sans titre' }}</p>
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
