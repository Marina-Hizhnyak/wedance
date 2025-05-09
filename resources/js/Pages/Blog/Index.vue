<template>
  <div class="max-w-6xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-center text-secondary mb-10">Nos articles</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
      <div v-for="post in posts" :key="post.id" class="bg-background rounded-lg shadow overflow-hidden border border-primary">
        <img
          v-if="post.image"
          :src="`/storage/${post.image}`"
          :alt="post.title"
          class="w-full h-48 object-cover"
        />

        <div class="p-4">
          <h2 class="text-xl text-primary font-semibold mb-2">{{ post.title }}</h2>
          <p class="text-secondary text-sm mb-4">
            Publié par {{ post.author?.name }} le {{ formatDate(post.created_at) }}
          </p>

          <Link :href="route('blog.show', post.slug)" class="text-white hover:underline text-sm">
            Lire l’article →
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import { Link } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
const props = defineProps({
  posts: Array,
})

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('fr-FR')
}
</script>
