<template>
  <div class="min-h-screen bg-background text-white px-8 py-12">
    <h1 class="text-3xl font-bold text-primary mb-6">Tous les cours</h1>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="course in courses"
        :key="course.id"
        class="bg-gray-900 rounded-lg p-6 shadow hover:shadow-lg transition"
      >
        <h2 class="text-xl font-semibold text-white mb-1">{{ course.title }}</h2>
        <p class="text-sm text-accent mb-1">Catégorie: {{ course.category?.name }}</p>
        <p class="text-sm text-accent mb-1">Niveau: {{ course.level?.name }}</p>
        <p class="text-sm text-accent">Professeur: {{ course.instructor?.name }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'


defineOptions({ layout: BaseLayout })
const { courses, instructorId } = usePage().props
</script>
