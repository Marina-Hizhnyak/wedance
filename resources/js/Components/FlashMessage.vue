<script setup>
import { usePage } from '@inertiajs/vue3'
import { computed, ref, watch } from 'vue'

const flash = computed(() => usePage().props.flash?.success || null)
const visible = ref(false)

watch(flash, (message) => {
  if (message) {
    visible.value = true
    setTimeout(() => (visible.value = false), 4000)
  }
})
</script>

<template>
  <transition name="slide-fade">
    <div
      v-if="visible && flash"
      class="fixed bottom-6 right-6 z-50 px-6 py-3 bg-primary text-background rounded shadow-lg text-sm font-semibold"
    >
      {{ flash }}
    </div>
  </transition>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.4s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  opacity: 0;
  transform: translateY(20px);
}
</style>
