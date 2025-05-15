<script setup>
import { defineProps } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { Link } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const props = defineProps({
    query: String,
    courses: Array,
    events: Array,
    posts: Array
})
</script>

<template>
  <div class="max-w-5xl mx-auto py-8 text-white">
    <h1 class="text-3xl font-bold text-primary mb-6">Résultats de recherche pour : "{{ query }}"</h1>

    <!-- Courses -->
    <div v-if="courses.length">
      <h2 class="text-2xl font-semibold text-secondary mb-4">Cours</h2>
      <ul class="space-y-2">
        <li v-for="course in courses" :key="course.id">
            <Link :href="`/cours/${course.category.slug}/${course.level.slug}`"
                class="block px-4 py-2 bg-background rounded hover:bg-secondary hover:text-white transition">
                {{ course.title }}
            </Link>
        </li>
      </ul>
    </div>

    <!-- Events -->
    <div v-if="events.length" class="mt-8">
      <h2 class="text-2xl font-semibold text-secondary mb-4">Événements</h2>
      <ul class="space-y-2">
        <li v-for="event in events" :key="event.id">
          <!-- адаптируй если у тебя есть route événement unique -->
          <Link href="/evenements" class="block px-4 py-2 bg-background rounded hover:bg-secondary hover:text-white transition">
            {{ event.title }}
          </Link>
        </li>
      </ul>
    </div>

    <!-- Blog Posts -->
    <div v-if="posts.length" class="mt-8">
      <h2 class="text-2xl font-semibold text-secondary mb-4">Articles du blog</h2>
      <ul class="space-y-2">
        <li v-for="post in posts" :key="post.id">
          <Link :href="`/blog/${post.slug ?? post.id}`"
                class="block px-4 py-2 bg-background rounded hover:bg-secondary hover:text-white transition">
            {{ post.title }}
          </Link>
        </li>
      </ul>
    </div>

    <!-- No Results -->
    <div v-if="!courses.length && !events.length && !posts.length" class="mt-8 text-center">
      <p>Aucun résultat trouvé.</p>
    </div>
  </div>
</template>
