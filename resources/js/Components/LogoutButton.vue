<script setup>
import { router } from '@inertiajs/vue3'

function logout() {
  router.post('/logout')
}
</script>

<template>
  <button
    @click="logout"
    class="md:px-2 lg:px-4 py-1.5 border border-primary text-white text-sm md:text-xs lg:text-sm rounded-full font-bold whitespace-nowrap hover:bg-primary hover:text-black transition inline-flex items-center gap-2"
  >
 Se déconnecter
  </button>
</template>
