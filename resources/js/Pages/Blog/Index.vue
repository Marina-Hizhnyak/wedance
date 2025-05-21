<template>
  <div class="px-4 md:px-8 lg:px-16 py-10 bg-gradient-symmetric min-h-screen">
    <div class="w-[90%] max-w-7xl mx-auto">
      <h1 class="text-3xl font-bold text-center text-secondary mb-10">Nos articles</h1>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        <div
          v-for="post in posts"
          :key="post.id"
          class="group bg-background rounded-lg shadow overflow-hidden border border-primary flex flex-col"
        >
          <!-- Image Block with ratio -->
          <div class="relative w-full pb-[75%] overflow-hidden">
            <img
              v-if="post.image"
              :src="post.image"
              :alt="post.title"
              class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
            />
          </div>

          <!-- Text Content -->
          <div class="p-4 flex flex-col justify-between grow">
            <div>
              <h2 class="text-xl text-primary font-semibold leading-snug mb-2">
                {{ post.title }}
              </h2>
              <p class="text-secondary text-sm mb-4">
                Publié par {{ post.author?.name }} le {{ formatDate(post.created_at) }}
              </p>
            </div>

            <Link
              :href="route('blog.show', post.slug)"
              class="mt-auto w-fit border border-primary text-primary font-bold px-4 py-2 rounded-full hover:bg-primary hover:text-black transition"
            >
              Lire l’article →
            </Link>
          </div>
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
  return new Date(dateStr).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: 'long',
    year: 'numeric'
  })
}
</script>

