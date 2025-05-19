<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref, computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

// Import user tabs components
import ProfileTab from './UserTabs/ProfileTab.vue'
import CoursesTab from './UserTabs/CoursesTab.vue'
import FavoritesTab from './UserTabs/FavoritesTab.vue'
// import HistoryTab from './UserTabs/HistoryTab.vue'
import ChatsTab from './UserTabs/ChatsTab.vue'
import TestimonialTab from './UserTabs/TestimonialTab.vue'

// Define page layout
defineOptions({ layout: BaseLayout })

// Get props from Inertia page
const props = defineProps({
  user: Object,
  courses: Array,
  chats: Array,
  favorites: Array,
    chats: Array,
})

// Setup tab system
const currentTab = ref('profile')

// Return component for current tab
const currentTabComponent = computed(() => ({
    profile: ProfileTab,
    courses: CoursesTab,
    favorites: FavoritesTab,
    // history: HistoryTab,
    chats: ChatsTab,
    testimonial: TestimonialTab,
}[currentTab.value]))

// Button style helper
function tabBtn(tab) {
  return [
    'block w-full text-left px-4 py-2 rounded-lg font-bold transition',
    tab === currentTab.value
      ? 'bg-primary text-black'
      : 'hover:bg-secondary text-white'
  ].join(' ')
}

// Get current user from page (optional, for consistency)
const user = usePage().props.user
</script>

<template>
  <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter">
    <div class="flex">
      <!-- Sidebar with tabs -->
      <aside class="w-64 min-h-screen bg-[#121212] p-6 space-y-6 sticky top-0">
        <div class="text-2xl font-title font-bold text-primary">My Account</div>

        <nav class="space-y-2">
          <button @click="currentTab = 'profile'" :class="tabBtn('profile')">👤 Profile</button>
          <button @click="currentTab = 'courses'" :class="tabBtn('courses')">🎓 My Courses</button>
          <button @click="currentTab = 'favorites'" :class="tabBtn('favorites')">⭐ Favorites</button>
          <button @click="currentTab = 'history'" :class="tabBtn('history')">📜 History</button>
          <button @click="currentTab = 'chats'" :class="tabBtn('chats')">💬 My Chats</button>
          <button @click="currentTab = 'testimonial'" :class="tabBtn('testimonial')">📝 Mon témoignage</button>

        </nav>
      </aside>

      <!-- Main content -->
      <main class="flex-1 p-10 space-y-6">
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




