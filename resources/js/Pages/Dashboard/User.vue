<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

import ProfileTab from './UserTabs/ProfileTab.vue'
import CoursesTab from './UserTabs/CoursesTab.vue'
import FavoritesTab from './UserTabs/FavoritesTab.vue'
import ChatsTab from './UserTabs/ChatsTab.vue'
import TestimonialTab from './UserTabs/TestimonialTab.vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  user: Object,
  courses: Array,
  chats: Array,
  favorites: Array,
})

const currentTab = ref('profile')
const sidebarOpen = ref(false)

const currentTabComponent = computed(() => ({
  profile: ProfileTab,
  courses: CoursesTab,
  favorites: FavoritesTab,
  chats: ChatsTab,
  testimonial: TestimonialTab,
}[currentTab.value]))

function tabBtn(tab) {
  return [
    'block w-full text-left px-4 py-2 rounded-lg font-bold transition',
    tab === currentTab.value
      ? 'bg-primary text-black'
      : 'hover:bg-secondary text-white'
  ].join(' ')
}

function changeTab(tab) {
  currentTab.value = tab
  sidebarOpen.value = false
}

const user = usePage().props.user
</script>


<template>
  <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter">
    <!-- Header (mobile) -->
    <div class="md:hidden flex items-center justify-between px-6 py-4 bg-[#121212] border-b border-[#333]">
      <div class="text-xl font-bold text-primary">Mon compte</div>
      <button @click="sidebarOpen = !sidebarOpen" class="text-primary focus:outline-none">
        ☰
      </button>
    </div>

    <div class="flex">
      <!-- Sidebar -->
        <aside
        class="bg-[#121212] p-6 space-y-6 z-50 transition-transform duration-300 ease-in-out
                fixed inset-y-0 left-0 w-64 transform md:relative md:translate-x-0 md:min-h-screen md:block"
        :class="{ '-translate-x-full': !sidebarOpen, 'translate-x-0': sidebarOpen }"
        >
        <div class="text-2xl font-title font-bold text-primary mb-4 hidden md:block">Mon compte</div>

        <nav class="space-y-2">
          <button @click="changeTab('profile')" :class="tabBtn('profile')">👤 Profil</button>
          <button @click="changeTab('courses')" :class="tabBtn('courses')">🎓 Mes cours</button>
          <button @click="changeTab('favorites')" :class="tabBtn('favorites')">⭐ Favoris</button>
          <button @click="changeTab('chats')" :class="tabBtn('chats')">💬  Mes discussions</button>
          <button @click="changeTab('testimonial')" :class="tabBtn('testimonial')">📝 Mes témoignages</button>
        </nav>
      </aside>

      <!-- Overlay for mobile -->
      <div
        v-if="sidebarOpen"
        class="fixed inset-0 bg-black opacity-50 z-40 md:hidden"
        @click="sidebarOpen = false"
      ></div>

      <!-- Main content -->
      <main class="flex-1 p-6 md:p-10 space-y-6">
        <component :is="currentTabComponent"
          :user="user"
          :courses="courses"
          :chats="chats"
          :favorites="favorites"
        />
      </main>
    </div>
  </div>
</template>





