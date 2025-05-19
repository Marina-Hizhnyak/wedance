<template>
  <section class="relative text-white bg-">
    <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row gap-12 items-center">

      <!-- Left: Vertical avatar carousel -->
      <div class="flex flex-col items-center gap-4">
        <!-- Top arrow button -->
        <button @click="prev" class="text-2xl text-accent hover:text-secondary transition">&#x25B2;</button>

        <!-- Avatar list (circular) -->
        <div class="flex flex-col gap-4 max-h-[400px] overflow-hidden">
          <img
            v-for="(member, index) in visibleMembers"
            :key="member.id + '-' + index"
            :src="member.avatar"
            @click="select((visibleStart + index) % teamMembers.length)"
            class="w-16 h-16 rounded-full border-4 cursor-pointer transition-all duration-300"
            :class="(visibleStart + index) % teamMembers.length === selected
              ? 'border-accent shadow-xl'
              : 'border-primary/20 opacity-60 hover:opacity-100'"
          />
        </div>

        <!-- Bottom arrow button -->
        <button @click="next" class="text-2xl text-accent hover:secondary transition">&#x25BC;</button>
      </div>

        <!-- Center: Large profile image container -->
        <div class="relative w-[300px] h-[300px] md:w-[400px] md:h-[400px] flex items-center justify-center rounded-full overflow-hidden border-8 border-primary/10 shadow-xl">
        <img src="/images/backgrounds/yellow.png" alt="Glow" class="absolute w-full h-full object-contain z-0" />

        <!-- Animate with overlaying transition -->
        <transition-group name="unfold-stack" tag="div" class="relative w-full h-full">
            <img
            v-if="currentMember"
            :key="currentMember.user.id"
            :src="currentMember.photo"
            :alt="currentMember.user.name"
            class="absolute top-0 left-0 w-full h-full object-cover rounded-full z-10"
            />
        </transition-group>
        </div>

      <!-- Right: Member details and social links -->
        <transition name="slide-fade" mode="out-in">
            <div :key="currentMember.user.id" class="max-w-xl text-center lg:text-left space-y-6">
                <h2 class="text-3xl font-bold text-primary font-title">Notre équipe</h2>

                <div>
                <h3 class="text-2xl text-primary font-bold">{{ currentMember.user.name }}</h3>
                <p class="text-accent font-semibold mb-2">{{ currentMember.role }}</p>
                <p class="text-white text-sm leading-relaxed">{{ currentMember.description }}</p>
                <p class="text-orange-400 italic mt-4">«{{ currentMember.quote }}»</p>
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
                <a
                :href="`/courses?instructor=${currentMember.user.id}`"
                class="inline-block mt-4 px-6 py-2 bg-primary text-black font-semibold rounded-full shadow hover:bg-secondary transition"
                >
                REJOINDRE SON COURS
                </a>
            </div>
        </transition>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue'

// Props: list of team members
const props = defineProps({
  teamMembers: Array
})

// Currently selected member index
const selected = ref(0)

// Index of the first visible avatar
const visibleStart = ref(0)
const visibleCount = 4 // how many avatars are shown at once

// Currently selected member object
const currentMember = computed(() => props.teamMembers[selected.value])

// Visible subset of avatars (supports circular wrap-around)
const visibleMembers = computed(() => {
  const start = visibleStart.value
  const total = props.teamMembers.length
  const result = []

  for (let i = 0; i < visibleCount; i++) {
    result.push(props.teamMembers[(start + i) % total])
  }

  return result
})

// Select a team member by index
function select(index) {
  selected.value = index
}

// Go to previous avatar in circular list
function prev() {
  visibleStart.value =
    (visibleStart.value - 1 + props.teamMembers.length) % props.teamMembers.length
  selected.value = visibleStart.value
}

// Go to next avatar in circular list
function next() {
  visibleStart.value = (visibleStart.value + 1) % props.teamMembers.length
  selected.value = visibleStart.value
}
</script>
<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition: all 0.5s ease;
}
.slide-fade-enter-from {
  opacity: 0;
  transform: translateX(30px);
}
.slide-fade-leave-to {
  opacity: 0;
  transform: translateX(-30px);
}
.unfold-stack-enter-active {
  transition: all 0.6s ease;
  z-index: 20;
}

.unfold-stack-leave-active {
  transition: all 0.3s ease;
  z-index: 10;
  position: absolute;
}

.unfold-stack-enter-from {
  opacity: 0;
  transform: scale(1.3) rotate(10deg);
}

.unfold-stack-leave-to {
  opacity: 0;
  transform: scale(0.9) rotate(-10deg);
}



</style>
