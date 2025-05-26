<template>
  <section class="relative  text-white py-20 bg-[url('/images/backgrounds/CTA.png')] bg-contain bg-center bg-no-repeat">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl text-center font-bold text-primary mb-12">Cours de danse</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
        <div
        v-for="course in courses"
        :key="course.id"
        class="relative bg-background rounded-md overflow-hidden shadow-lg group transition-transform duration-300 hover:scale-105"
        >
        <!-- Animated border overlay -->
        <div class="absolute inset-0 rounded-md pointer-events-none border-animation"></div>

        <!-- Content -->
        <img :src="`/images/courses/${course.image}`" alt="" loading="lazy" class="w-full h-56 object-cover" />
        <div class="p-4 text-center space-y-2 relative z-10">
            <h3 class="text-lg text-accent font-bold">{{ course.title }}</h3>
            <p class="text-xs text-white/70">{{ course.level?.name }}</p>
            <p class="text-sm">{{ course.day_time }}</p>
            <p class="text-sm text-white/60">
            Enseigné par <span class="text-primary font-medium">{{ course.instructor?.name }}</span>
            </p>

            <div class="mt-4 flex justify-center gap-4 flex-wrap">
            <template v-if="!isAuthenticated">
                <a
                :href="route('login')"
                class="border-2 border-primary px-4 py-1 rounded-full text-sm hover:bg-primary hover:text-black transition"
                >
                S'INSCRIRE
                </a>
            </template>
            <template v-else-if="course.is_registered">
                <button disabled class="border-2 border-gray-500 px-4 py-1 rounded-full text-sm text-white bg-gray-500 cursor-not-allowed">
                Déjà inscrit
                </button>
            </template>
            <template v-else>
                <button
                @click="registerToCourse(course.id)"
                class="border-2 border-primary px-4 py-1 rounded-full text-sm hover:bg-primary hover:text-black transition"
                >
                S'INSCRIRE
                </button>
            </template>

            <a
                :href="`/courses/${course.category.slug}/${course.level.slug}`"
                class="border-2 border-primary px-4 py-1 rounded-full text-sm hover:bg-primary hover:text-black transition"
            >
                LIRE PLUS
            </a>
            </div>
        </div>
        </div>

      </div>
    </div>
  </section>
</template>

<script setup>
import { usePage, router } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps({
  courses: Array
})

// Get authenticated user
const isAuthenticated = computed(() => !!usePage().props.auth?.user)

// POST to register route
const registerToCourse = (courseId) => {
  router.post(`/courses/${courseId}/register`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      // Optional: show message or reload
    }
  })
}
</script>

<style scoped>
.border-animation {
  border: 1px solid transparent;
  border-radius: 0.5rem; /* более мягкие углы */
  background-image: linear-gradient(60deg, #ffffff, #ffb400, #e63946, #ffffff);
  background-size: 400% 400%;
  animation: borderFlow 3s linear infinite;
  mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
  mask-composite: exclude;
  -webkit-mask-composite: destination-out;
  padding: 2px;
  z-index: 0;
  box-shadow: 0 0 6px 2px rgba(255, 180, 0, 0.9);
}


@keyframes borderFlow {
  0%, 100% {
    background-position: 0% 50%;
    opacity: 1;
  }
  50% {
    background-position: 100% 50%;
    opacity: 0.7;
  }
}
</style>
