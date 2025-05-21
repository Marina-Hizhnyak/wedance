<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

const currentPath = ref(window.location.pathname)

const updatePath = () => {
  currentPath.value = window.location.pathname
}

let unsubscribe = null

onMounted(() => {
  unsubscribe = router.on('navigate', updatePath)
})

onUnmounted(() => {
  if (unsubscribe) unsubscribe()
})

const segments = computed(() => currentPath.value.split('/').filter(Boolean))

const getLink = (index) => {
  return '/' + segments.value.slice(0, index + 1).join('/')
}

// ✅ Traductions FR des segments
const pathTranslations = {
  'calendar': 'Calendrier',
  'evenements': 'Événements',
  'cours': 'Cours',
  'blog': 'Blog',
  'contact': 'Contact',
  'about': 'À propos',
  'mon-espace': 'Mon espace',
  'inscription': 'Inscription',
  // Ajoute d'autres ici si nécessaire
}
</script>

<template>
  <nav class="text-sm text-gray-400 my-4" aria-label="Breadcrumb">
    <ol class="flex items-center space-x-1">
      <!-- Home -->
      <li>
        <a href="/" class="flex items-center text-primary hover:underline">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 9l9-7 9 7v11a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5a2 2 0 00-2-2H5a2 2 0 00-2 2v5a2 2 0 002 2h4a2 2 0 002-2v-5" />
          </svg>
          Accueil
        </a>
      </li>

      <!-- Autres segments -->
      <template v-for="(segment, index) in segments" :key="index">
        <li>
          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-1 text-secondary"
            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
          </svg>
        </li>
        <li>
          <!-- Dernier segment : texte seul -->
          <span v-if="index === segments.length - 1" class="capitalize text-primary">
            {{ pathTranslations[segment] || segment.replace(/-/g, ' ') }}
          </span>

          <!-- Segments cliquables -->
          <a
            v-else
            :href="getLink(index)"
            class="capitalize text-primary hover:underline"
          >
            {{ pathTranslations[segment] || segment.replace(/-/g, ' ') }}
          </a>
        </li>
      </template>
    </ol>
  </nav>
</template>



