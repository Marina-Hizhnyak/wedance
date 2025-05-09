<template>
  <section class="relative bg-[url('/images/backgrounds/stripes.png')] bg-cover bg-center bg-no-repeat text-white py-20">
    <div class="max-w-7xl mx-auto px-6">
      <h2 class="text-4xl text-center font-bold text-primary mb-12">Cours de danse</h2>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-8">
        <div
          v-for="course in courses"
          :key="course.id"
          class="bg-black/50 border border-yellow-500 rounded-md overflow-hidden shadow-lg"
        >
          <img :src="`/images/courses/${course.image}`" alt="" class="w-full h-56 object-cover" />
          <div class="p-4 text-center space-y-2">
            <h3 class="text-lg font-bold">{{ course.title }}</h3>
            <p class="text-sm text-white/70">{{ course.level }}</p>
            <p class="text-sm">{{ course.day_time }}</p>
            <div class="mt-4 flex justify-center gap-4">
              <a href="#" class="border-2 border-yellow-500 px-4 py-1 rounded-full text-sm hover:bg-yellow-500 hover:text-black transition">S'INSCRIRE</a>
              <a :href="`/courses/${course.id}`" class="border-2 border-yellow-500 px-4 py-1 rounded-full text-sm hover:bg-yellow-500 hover:text-black transition">LIRE PLUS</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
defineProps({
  courses: Array
})
</script>
