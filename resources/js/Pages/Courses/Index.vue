<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  courses: Array,
  category: String,
  level: String
})

// ✅ Копируем courses в реактивный список
const courseList = ref([...props.courses])

const title = computed(() =>
  props.level ? `${props.category} – ${props.level}` : props.category
)

const isSubmitting = ref(false)

const registerToCourse = (courseId) => {
  if (isSubmitting.value) return
  isSubmitting.value = true

  router.post(`/courses/${courseId}/register`, {}, {
    preserveScroll: true,
    onSuccess: () => {
      const course = courseList.value.find(c => c.id === courseId)
      if (course) {
        course.is_registered = true
      }
    },
    onFinish: () => {
      isSubmitting.value = false
    }
  })
}
</script>


<template>
  <section class="px-4 md:px-8 lg:px-16 py-10 bg-background min-h-screen">
    <div class="max-w-7xl mx-auto">
      <h1 class="text-3xl font-extrabold text-accent mb-8">
        Cours : {{ title }}
      </h1>

      <div v-if="courseList.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 ">
        <div
          v-for="course in courseList"
          :key="course.id"
          class="bg-background rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow border border-primary"
        >
          <img
            :src="`/storage/${course.image}`"
            alt="course image"
            class="w-full h-48 object-cover"
          />
          <div class="p-5">
            <h2 class="text-xl font-semibold text-[#121212] mb-2">{{ course.title }}</h2>
            <p class="text-gray-600 text-sm">{{ course.description }}</p>
            <div class="mt-4 flex flex-col gap-1 text-sm text-gray-500">
              <span><strong>Durée:</strong> {{ course.duration }}</span>
              <span><strong>Jour:</strong> {{ course.day_time }}</span>
              <span><strong>Prix:</strong> {{ course.price }} €</span>
              <span v-if="course.level?.name"><strong>Niveau:</strong> {{ course.level.name }}</span>
            </div>
          </div>

          <!-- <button
  @click="registerToCourse(course.id)"
  class="mt-4 bg-primary text-black font-bold px-4 py-2 rounded-full"
>
  Participer
</button> -->
<!-- Внутри v-for course in courses -->
  <button
    v-if="!course.is_registered"
    @click="registerToCourse(course.id)"
    class="mt-4 bg-primary text-black font-bold px-4 py-2 rounded-full"
  >
    Participer
  </button>

  <button
    v-else
    disabled
    class="mt-4 bg-gray-400 text-white font-bold px-4 py-2 rounded-full cursor-not-allowed"
  >
    Déjà inscrit
  </button>
        </div>
      </div>

      <div v-else class="text-center text-gray-500 text-lg mt-16">
        Aucun cours trouvé pour cette sélection.
      </div>
    </div>
  </section>
</template>
