<script setup>
import { ref, computed } from 'vue'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import ProfileTab from './tabs/ProfileTab.vue'
import UsersTab from './tabs/UsersTab.vue'
import CoursesTab from './tabs/CoursesTab.vue'
import EventsTab from './tabs/EventsTab.vue'
import GalleryTab from './tabs/GalleryTab.vue'
import BlogTab from './tabs/BlogTab.vue'
import MessagesTab from './tabs/MessagesTab.vue'
import ChatsTab from './tabs/ChatsTab.vue'
import TeamMembersTab from './tabs/TeamMembersTab.vue'
import TestimonialTab from './tabs/TestimonialsTab.vue'

import { usePage } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })

const currentTab = ref('profile')

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

const user = usePage().props.user

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
  <div class="min-h-screen bg-gradient-to-b from-[#1a0a05] to-background text-white font-inter flex">
    <!-- Sidebar -->
    <aside class="w-64 min-h-screen bg-[#121212] p-6 space-y-6 sticky top-0">
      <div class="text-2xl font-title font-bold text-primary">Admin Panel</div>
      <nav class="space-y-2">
        <button @click="currentTab = 'profile'" :class="tabBtn('profile')">👤 Profil</button>
        <button @click="currentTab = 'users'" :class="tabBtn('users')">🧑 Utilisateurs</button>
        <button @click="currentTab = 'courses'" :class="tabBtn('courses')">🎓 Cours</button>
        <button @click="currentTab = 'events'" :class="tabBtn('events')">📅 Événements</button>
        <button @click="currentTab = 'gallery'" :class="tabBtn('gallery')">🖼️ Galerie</button>
        <button @click="currentTab = 'blog'" :class="tabBtn('blog')">📝 Blog</button>
        <button @click="currentTab = 'messages'" :class="tabBtn('messages')">📨 Messages</button>
        <button @click="currentTab = 'chats'" :class="tabBtn('chats')">💬 Chats</button>
        <button @click="currentTab = 'teamMembers'" :class="tabBtn('teamMembers')">💬 TeamMembers Profiles</button>
        <button @click="currentTab = 'testimonials'" :class="tabBtn('testimonials')">💬 Testimonials</button>
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-10">
      <component :is="currentTabComponent" :user="user"
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

