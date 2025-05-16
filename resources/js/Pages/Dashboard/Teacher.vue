<script setup>
import { ref, computed } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'

// ✅ Reuse UserProfileTab from User Dashboard
import UserProfileTab from '@/Pages/Dashboard/UserTabs/ProfileTab.vue'

// ✅ Teacher-specific tabs
import TeacherCoursesTab from '@/Pages/Dashboard/TeacherTabs/TeacherCoursesTab.vue'
import TeacherEventsTab from '@/Pages/Dashboard/TeacherTabs/TeacherEventsTab.vue'
import TeacherTeamTab from '@/Pages/Dashboard/TeacherTabs/TeacherTeamTab.vue'

// ✅ Get props from controller
const props = defineProps({
  user: Object,
  courses: Array,
  events: Array,
  categories: Array,
  levels: Array,
   teamMember: Object,
})

// ✅ State for active tab
const currentTab = ref('profile')

// ✅ Map tabs to components
const currentTabComponent = computed(() => {
  return {
    profile: UserProfileTab,
    courses: TeacherCoursesTab,
      events: TeacherEventsTab,
     team: TeacherTeamTab,
  }[currentTab.value]
})

// ✅ Utility class for active tab
function tabBtn(tab) {
  return [
    'block w-full text-left px-4 py-2 rounded-lg font-bold transition',
    tab === currentTab.value
      ? 'bg-primary text-black'
      : 'hover:bg-secondary text-white',
  ].join(' ')
}
</script>

<template>
  <BaseLayout>
    <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter">
      <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 min-h-screen bg-[#121212] p-6 space-y-6 sticky top-0">
          <div class="text-2xl font-title font-bold text-primary">👨‍🏫 Teacher Panel</div>

          <nav class="space-y-2">
            <button @click="currentTab = 'profile'" :class="tabBtn('profile')">👤 Profile</button>
            <button @click="currentTab = 'courses'" :class="tabBtn('courses')">📚 My Courses</button>
            <button @click="currentTab = 'events'" :class="tabBtn('events')">📅 My Events</button>
            <button @click="currentTab = 'team'" :class="tabBtn('team')">💼 Team Profile</button>

          </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-10 space-y-6">
          <!-- ✅ Render current tab component -->
          <component :is="currentTabComponent" :user="user" :courses="courses" :events="events" :categories="categories" :levels="levels" :team-member="teamMember"/>
        </main>
      </div>
    </div>
  </BaseLayout>
</template>
