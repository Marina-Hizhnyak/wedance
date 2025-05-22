<script setup>
import { ref, computed } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'

// Tabs
import UserProfileTab from '@/Pages/Dashboard/UserTabs/ProfileTab.vue'
import TeacherCoursesTab from '@/Pages/Dashboard/TeacherTabs/TeacherCoursesTab.vue'
import TeacherEventsTab from '@/Pages/Dashboard/TeacherTabs/TeacherEventsTab.vue'
import TeacherTeamTab from '@/Pages/Dashboard/TeacherTabs/TeacherTeamTab.vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  user: Object,
  courses: Array,
  events: Array,
  categories: Array,
  levels: Array,
  teamMember: Object,
})

// Tabs & sidebar
const currentTab = ref('profile')
const isSidebarOpen = ref(false)

const currentTabComponent = computed(() => ({
  profile: UserProfileTab,
  courses: TeacherCoursesTab,
  events: TeacherEventsTab,
  team: TeacherTeamTab,
}[currentTab.value]))

function tabBtn(tab) {
  return [
    'block w-full text-left px-4 py-2 rounded-lg font-bold transition',
    tab === currentTab.value
      ? 'bg-primary text-black'
      : 'hover:bg-secondary text-white',
  ].join(' ')
}

function toggleSidebar() {
  isSidebarOpen.value = !isSidebarOpen.value
}
</script>

<template>
  <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <div class="md:hidden p-4 bg-[#121212] flex justify-between items-center border-b border-[#333]">
      <div class="text-xl font-title font-bold text-primary">Espace professeur</div>
      <button @click="toggleSidebar" class="text-primary text-2xl focus:outline-none">☰</button>
    </div>

    <!-- Sidebar -->
    <aside
      :class="[
        'bg-[#121212] p-6 space-y-6 w-full md:w-64 md:static md:block',
        isSidebarOpen ? 'block' : 'hidden',
        'md:min-h-screen sticky top-0 z-20'
      ]"
    >
      <div class="text-2xl font-title font-bold text-primary hidden md:block">Espace professeur</div>
      <nav class="space-y-2">
        <button @click="currentTab = 'profile'; isSidebarOpen = false" :class="tabBtn('profile')">👤 Profil</button>
        <button @click="currentTab = 'courses'; isSidebarOpen = false" :class="tabBtn('courses')">📚 Mes cours</button>
        <button @click="currentTab = 'events'; isSidebarOpen = false" :class="tabBtn('events')">📅 Mes événements</button>
        <button @click="currentTab = 'team'; isSidebarOpen = false" :class="tabBtn('team')">💼 Profil d'équipe</button>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-4 md:p-10 overflow-x-auto">
      <component
        :is="currentTabComponent"
        :user="user"
        :courses="courses"
        :events="events"
        :categories="categories"
        :levels="levels"
        :team-member="teamMember"
      />
    </main>
  </div>
</template>

