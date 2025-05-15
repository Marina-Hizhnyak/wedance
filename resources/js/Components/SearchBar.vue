<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const query = ref('')
const search = () => {
    if (query.value) {
        router.get('/search', { q: query.value })
    }
}
</script>

<template>
  <div class="relative w-64">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
      <!-- Loupe icon -->
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none"
    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
    d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z" />
</svg>

    </div>
    <input
      v-model="query"
      @keyup.enter="search"
      type="text"
      placeholder="Rechercher..."
      class="block w-full pl-10 pr-3 py-2 border border-primary rounded-md leading-5 bg-background placeholder-primary focus:outline-none focus:ring-2 focus:ring-primary focus:border-secondary sm:text-sm text-primary"
    />
  </div>
</template>
