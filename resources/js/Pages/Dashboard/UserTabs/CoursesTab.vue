<script setup>
import { computed } from 'vue'

// Get courses from parent props
const props = defineProps({
  courses: Array
})

// Optional computed property if you want to sort/filter courses
const hasCourses = computed(() => props.courses.length > 0)
</script>

<template>

  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">🎓 My Courses</h1>

    <!-- Courses grid -->
    <div v-if="hasCourses" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <!-- Loop all courses -->
      <div
        v-for="course in courses"
        :key="course.id"
        class="bg-background rounded-2xl overflow-hidden shadow-md hover:shadow-lg transition-shadow border border-primary"
      >
        <!-- Course image -->
        <img
          :src="`/images/courses/${course.image}`"
          alt="Course image"
          class="w-full h-48 object-cover"
        />

        <!-- Course info -->
        <div class="p-5">
          <h2 class="text-xl font-semibold text-[#121212] mb-2">{{ course.title }}</h2>
          <p class="text-gray-600 text-sm">{{ course.description }}</p>

          <!-- Extra course details -->
          <div class="mt-4 flex flex-col gap-1 text-sm text-gray-500">
            <span><strong>Duration:</strong> {{ course.duration }}</span>
            <span><strong>Day:</strong> {{ course.day_time }}</span>
            <span><strong>Price:</strong> {{ course.price }} €</span>
            <span v-if="course.level"><strong>Level:</strong> {{ course.level.name }}</span>
          </div>
        </div>
      </div>
    </div>

    <!-- If no courses found -->
    <div v-else class="text-center text-gray-400 mt-10">
      You are not enrolled in any courses yet.
    </div>
  </div>
</template>
