<template>
  <!-- Section wrapper with dark background -->
  <section class="relative text-white bg-">
    <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row gap-12 items-center">

      <!-- Left: Vertical avatar carousel -->
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

      <!-- Center: Big profile image with yellow glow background -->
      <div class="relative w-[300px] h-[300px] md:w-[400px] md:h-[400px] flex items-center justify-center rounded-full overflow-hidden border-8 border-primary/10 shadow-xl">

        <!-- Background glow image -->
        <img
          src="/images/backgrounds/yellow.png"
          alt="Glow"
          class="absolute w-full h-full object-contain z-0"
        />

        <!-- Instructor's profile photo -->
        <img
          :src="currentMember.photo"
          :alt="currentMember.user.name"
          class="relative z-10 object-cover w-full h-full rounded-full"
        />
      </div>

      <!-- Right: Text and links -->
      <div class="max-w-xl text-center lg:text-left space-y-6">
        <h2 class="text-3xl font-bold text-primary font-title">Notre équipe</h2>

        <div>
          <h3 class="text-2xl text-primary font-bold">{{ currentMember.user.name }}</h3>
          <p class="text-accent font-semibold mb-2">{{ currentMember.role }}</p>
          <p class="text-white text-sm leading-relaxed">
            {{ currentMember.description }}
          </p>
          <p class="text-orange-400 italic mt-4">
            «{{ currentMember.quote }}»
          </p>
        </div>

        <!-- Social/contact icons -->
        <div class="flex gap-4 text-xl text-red-500 justify-center lg:justify-start">
          <a v-if="currentMember.telegram_url" :href="currentMember.telegram_url" target="_blank">
            <img src="/images/icons/lettre.svg" class="w-5 h-5" alt="Telegram" />
          </a>
          <a v-if="currentMember.whatsapp_url" :href="currentMember.whatsapp_url" target="_blank">
            <img src="/images/icons/phone.svg" class="w-5 h-5" alt="WhatsApp" />
          </a>
          <a v-if="currentMember.vk_url" :href="currentMember.vk_url" target="_blank">
            <img src="/images/icons/vk.svg" class="w-5 h-5" alt="VK" />
          </a>
        </div>

        <!-- CTA button -->
        <a href="#" class="inline-block mt-4 px-6 py-2 bg-primary text-black font-semibold rounded-full shadow hover:bg-secondary transition">
          DANSER AVEC ELLE
        </a>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'

// Props passed from parent component or page
const props = defineProps({
  teamMembers: Array
})

// Index of selected member
const selected = ref(0)

// Controls pagination (start index and how many avatars are shown)
const visibleStart = ref(0)
const visibleCount = 4

// Currently selected team member
const currentMember = computed(() => props.teamMembers[selected.value])

// Visible subset of members for avatar list
const visibleMembers = computed(() =>
  props.teamMembers.slice(visibleStart.value, visibleStart.value + visibleCount)
)

// Select a member by index
function select(index) {
  selected.value = index
}

// Scroll up in the avatar list
function prev() {
  if (visibleStart.value > 0) {
    visibleStart.value--
    selected.value = visibleStart.value
  }
}

// Scroll down in the avatar list
function next() {
  if (visibleStart.value + visibleCount < props.teamMembers.length) {
    visibleStart.value++
    selected.value = visibleStart.value
  }
}
</script>



