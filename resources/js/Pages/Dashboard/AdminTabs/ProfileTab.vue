<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Bienvenue, {{ user.name }}</h1>
    <p class="text-lg">Email : {{ user.email }}</p>
  </div>
</template>

<script setup>
const props = defineProps({
  user: Object,
})
</script>
