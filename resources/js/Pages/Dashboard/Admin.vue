<script setup>
import { ref, computed } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'

import ProfileTab from './AdminTabs/ProfileTab.vue'
import UsersTab from './AdminTabs/UsersTab.vue'
import CoursesTab from './AdminTabs/CoursesTab.vue'
import EventsTab from './AdminTabs/EventsTab.vue'
import GalleryTab from './AdminTabs/GalleryTab.vue'
import BlogTab from './AdminTabs/BlogTab.vue'
import MessagesTab from './AdminTabs/MessagesTab.vue'
import ChatsTab from './AdminTabs/ChatsTab.vue'
import TeamMembersTab from './AdminTabs/TeamMembersTab.vue'
import TestimonialTab from './AdminTabs/TestimonialsTab.vue'

import { usePage } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const currentTab = ref('profile')
const isSidebarOpen = ref(false)

const props = defineProps({
  user: Object,
  users: Array,
  courses: Array,
  events: Array,
  teachers: Array,
  categories: Array,
  levels: Array,
  organizers: Array,
  media: Array,
  posts: Array,
  messages: Array,
  chats: Array,
  teamMembers: Array,
  testimonials: Array,
})

const user = usePage().props.user

const currentTabComponent = computed(() => {
  return {
    profile: ProfileTab,
    users: UsersTab,
    courses: CoursesTab,
    events: EventsTab,
    gallery: GalleryTab,
    blog: BlogTab,
    messages: MessagesTab,
    chats: ChatsTab,
    teamMembers: TeamMembersTab,
    testimonials: TestimonialTab,
  }[currentTab.value]
})

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
  <div class="min-h-screen bg-gradient-symmetric text-white font-inter flex flex-col md:flex-row">

    <!-- Mobile Header -->
    <div class="md:hidden p-4 bg-[#121212] flex justify-between items-center border-b border-[#333]">
      <div class="text-xl font-title font-bold text-primary">Admin Panel</div>
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
      <div class="text-2xl font-title font-bold text-primary hidden md:block">Admin Panel</div>
      <nav class="space-y-2">
        <button @click="currentTab = 'profile'; isSidebarOpen = false" :class="tabBtn('profile')">👤 Profil</button>
        <button @click="currentTab = 'users'; isSidebarOpen = false" :class="tabBtn('users')">🧑 Utilisateurs</button>
        <button @click="currentTab = 'courses'; isSidebarOpen = false" :class="tabBtn('courses')">🎓 Cours</button>
        <button @click="currentTab = 'events'; isSidebarOpen = false" :class="tabBtn('events')">📅 Événements</button>
        <button @click="currentTab = 'gallery'; isSidebarOpen = false" :class="tabBtn('gallery')">🖼️ Galerie</button>
        <button @click="currentTab = 'blog'; isSidebarOpen = false" :class="tabBtn('blog')">📝 Blog</button>
        <button @click="currentTab = 'messages'; isSidebarOpen = false" :class="tabBtn('messages')">📨 Messages</button>
        <button @click="currentTab = 'chats'; isSidebarOpen = false" :class="tabBtn('chats')">💬 Chats</button>
        <button @click="currentTab = 'teamMembers'; isSidebarOpen = false" :class="tabBtn('teamMembers')">👥 Profils équipe</button>
        <button @click="currentTab = 'testimonials'; isSidebarOpen = false" :class="tabBtn('testimonials')">🌟 Témoignages</button>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-4 md:p-10 overflow-x-auto">
      <component
        :is="currentTabComponent"
        :user="user"
        :users="users"
        :courses="courses"
        :events="events"
        :teachers="teachers"
        :categories="categories"
        :levels="levels"
        :organizers="organizers"
        :media="media"
        :posts="posts"
        :messages="messages"
        :chats="chats"
        :teamMembers="teamMembers"
        :testimonials="testimonials"
      />
    </main>
  </div>
</template>
