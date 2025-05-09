<template>
  <section class="relative bg-[url('/images/backgrounds/stripes.png')] bg-cover bg-center bg-no-repeat text-white py-20">
    <div class="max-w-7xl mx-auto px-6 text-center">
      <h2 class="text-4xl font-bold text-primary mb-10">Témoignages des clients</h2>

      <!-- Carousel -->
      <div class="flex items-center justify-center gap-6 relative">

        <!-- Left Arrow -->
        <button @click="prev" class="absolute left-0 text-4xl text-primary hover:text-secondary transition z-10">
          <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Testimonials -->
        <div class="flex overflow-hidden w-full max-w-4xl justify-center">
          <div
            v-for="(testimonial, index) in visibleTestimonials"
            :key="index"
            class="w-[300px] shrink-0 px-4 py-6 text-center transition-transform duration-300"
            :class="{
              'scale-110 z-20': index + currentStart === selectedIndex,
              'opacity-50 scale-95': index + currentStart !== selectedIndex,
            }"
          >
            <img :src="testimonial.avatar" class="w-16 h-16 mx-auto rounded-full mb-4" />
            <h3 class="text-lg font-semibold">{{ testimonial.name }}</h3>
            <p class="text-sm text-accent">{{ testimonial.position }}</p>
            <div class="text-red-400 text-xl my-2">❝</div>
            <p class="text-sm text-white/90 leading-relaxed">{{ testimonial.content }}</p>
          </div>
        </div>

        <!-- Right Arrow -->
        <button @click="next" class="absolute right-0 text-4xl text-primary hover:text-secondary transition z-10">
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Dots -->
      <div class="mt-6 flex justify-center gap-2">
        <span
          v-for="(dot, index) in testimonials.length"
          :key="index"
          class="w-3 h-3 rounded-full border-2"
          :class="index === selectedIndex ? 'bg-red-500 border-red-500' : 'bg-white/30 border-white/30'"
          @click="selectedIndex = index"
        ></span>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  testimonials: Array
})

const selectedIndex = ref(0)
const visibleCount = 3
const currentStart = computed(() => Math.max(0, selectedIndex.value - 1))

const visibleTestimonials = computed(() =>
  props.testimonials.slice(currentStart.value, currentStart.value + visibleCount)
)

function prev() {
  if (selectedIndex.value > 0) selectedIndex.value--
}
function next() {
  if (selectedIndex.value < props.testimonials.length - 1) selectedIndex.value++
}
</script>
