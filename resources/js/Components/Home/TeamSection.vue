<template>
  <section class="relative bg-[url('/images/backgrounds/stripes.png')] bg-cover bg-center bg-no-repeat text-white">
    <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row gap-12 items-center">
      <!-- Left carousel avatars -->
      <div class="flex flex-col items-center gap-4">
        <!-- Top arrow -->
        <button @click="prev" class="text-2xl text-pink-500 hover:text-pink-300 transition">&#x25B2;</button>

        <!-- Avatar list -->
        <div class="flex flex-col gap-4 max-h-[400px] overflow-hidden">
          <img
            v-for="(member, index) in visibleMembers"
            :key="member.id"
            :src="member.avatar"
            @click="select(index + visibleStart)"
            class="w-16 h-16 rounded-full border-4 cursor-pointer transition-all duration-300"
            :class="index + visibleStart === selected ? 'border-pink-500 shadow-xl' : 'border-white/20 opacity-60 hover:opacity-100'"
          />
        </div>

        <!-- Bottom arrow -->
        <button @click="next" class="text-2xl text-pink-500 hover:text-pink-300 transition">&#x25BC;</button>
      </div>

      <!-- Center: Big image -->
      <div class="relative w-[300px] h-[300px] md:w-[400px] md:h-[400px] rounded-full border-8 border-white/70 flex items-center justify-center overflow-hidden shadow-lg">
        <img
          :src="currentMember.photo"
          :alt="currentMember.name"
          class="object-cover w-full h-full"
        />
      </div>

      <!-- Right: Text -->
      <div class="max-w-xl text-center lg:text-left space-y-6">
        <h2 class="text-3xl font-bold text-primary font-title">Notre équipe</h2>

        <div>
          <h3 class="text-2xl text-primary font-bold">{{ currentMember.name }}</h3>
          <p class="text-accent font-semibold mb-2">{{ currentMember.role }}</p>
          <p class="text-white text-sm leading-relaxed">
            {{ currentMember.description }}
          </p>
          <p class="text-orange-400 italic mt-4">
            «{{ currentMember.quote }}»
          </p>
        </div>

        <div class="flex gap-4 text-xl text-white">
          <i class="fa-solid fa-paper-plane"></i>
          <i class="fa-solid fa-smile"></i>
          <i class="fa-solid fa-globe"></i>
        </div>

        <a href="#" class="inline-block mt-4 px-6 py-2 bg-primary text-black font-semibold rounded-full shadow hover:bg-secondary transition">
          DANSER AVEC ELLE
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  teamMembers: Array
})

const selected = ref(0)
const visibleStart = ref(0)
const visibleCount = 4

const currentMember = computed(() => props.teamMembers[selected.value])

const visibleMembers = computed(() =>
  props.teamMembers.slice(visibleStart.value, visibleStart.value + visibleCount)
)

function select(index) {
  selected.value = index
}

function prev() {
  if (visibleStart.value > 0) {
    visibleStart.value--
    selected.value = visibleStart.value
  }
}

function next() {
  if (visibleStart.value + visibleCount < props.teamMembers.length) {
    visibleStart.value++
    selected.value = visibleStart.value
  }
}

</script>


