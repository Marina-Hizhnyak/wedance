<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const user = usePage().props.auth.user

const isAdmin = computed(() => user.role === 'admin')
const isTeacher = computed(() => user.role === 'teacher')
const isUser = computed(() => user.role === 'user')
</script>

<template>
  <div class="min-h-screen bg-background text-white py-20 px-6">
    <div class="max-w-4xl mx-auto space-y-10">
      <h1 class="text-4xl font-bold text-primary font-title">Bienvenue, {{ user.name }} !</h1>

      <!-- Панель администратора -->
      <div v-if="isAdmin">
        <h2 class="text-2xl font-semibold text-accent">Panneau Administrateur</h2>
        <p class="mt-2 text-gray-300">Gérez les cours, utilisateurs, événements, etc.</p>
        <!-- Добавь сюда ссылки или компоненты -->
      </div>

      <!-- Панель преподавателя -->
      <div v-else-if="isTeacher">
        <h2 class="text-2xl font-semibold text-accent">Espace Enseignant</h2>
        <p class="mt-2 text-gray-300">Consultez vos cours et gérez vos inscriptions.</p>
        <!-- Ссылки для преподавателя -->
      </div>

      <!-- Панель пользователя -->
      <div v-else-if="isUser">
        <h2 class="text-2xl font-semibold text-accent">Mon espace personnel</h2>
        <p class="mt-2 text-gray-300">Voici les cours auxquels vous êtes inscrit :</p>

        <ul class="list-disc ml-6 mt-4 space-y-2">
          <li v-for="registration in user.registrations || []" :key="registration.id">
            {{ registration.course.title }} — {{ registration.course.day_time }} ({{ registration.course.duration }})
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

