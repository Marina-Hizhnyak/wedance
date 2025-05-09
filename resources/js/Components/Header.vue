<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'

const user = usePage().props.auth.user
const csrfToken = usePage().props.csrf_token

let hideTimer = null
const activeCategory = ref(null)

const showCategory = (id) => {
  clearTimeout(hideTimer)
  activeCategory.value = id
}

const scheduleHideCategory = () => {
  hideTimer = setTimeout(() => {
    activeCategory.value = null
  }, 200)
}

const isOpen = ref(false)
const toggleMenu = () => {
  isOpen.value = !isOpen.value
}

const menuCourses = usePage().props.menuCourses
const isActive = (path) => usePage().url === path
</script>

<template>
  <header class="fixed w-full z-50 shadow-lg bg-background">
    <div class="w-[90%] mx-auto flex justify-between items-center px-8 py-3">
      <Link href="/" class="flex items-center bg-gradient-to-r from-[#FFE17D] to-[#DD6031]">
        <img src="/images/logos/logogr.svg" alt="Logo" class="h-[60px] w-auto" />
      </Link>

      <nav class="hidden md:flex px-10 text-primary text-base font-title font-semibold">
        <ul class="flex space-x-10 items-center">
          <li><Link href="/" class="hover:text-accent">Accueil</Link></li>
          <li><Link href="/about" class="hover:text-[#E63946]">À propos</Link></li>
          <li><Link href="/evenements" class="hover:text-[#E63946]">Événements</Link></li>

            <li class="relative" @mouseover="showCategory('main')" @mouseleave="scheduleHideCategory">
            <span class="cursor-pointer hover:text-[#E63946]">Cours</span>

            <div
                v-show="activeCategory === 'main'"
                class="absolute mt-2 top-12 bg-background rounded-md text-primary  min-w-[200px] shadow-lg z-50"
            >
                <div
                v-for="category in menuCourses"
                :key="category.id"
                class="relative"
                @mouseover="showCategory(category.id)"
                @mouseleave="scheduleHideCategory"
                >
                <Link
                    :href="`/cours/${category.slug}`"
                    class="block px-4 py-2 hover:bg-[#333] whitespace-nowrap"
                >
                    {{ category.name }}
                </Link>

                <!-- Подуровни -->
                <div
                    v-show="Array.isArray(category.children) && category.children.length && activeCategory === category.id"
                    class="absolute left-full top-0 bg-[#2b2b2b] rounded-md shadow-md min-w-[200px] z-50"
                    @mouseover="showCategory(category.id)"
                    @mouseleave="scheduleHideCategory"
                >
                    <Link
                    v-for="child in category.children"
                    :key="child.id"
                    :href="`/cours/${child.slug}`"
                    class="block px-4 py-2 hover:bg-[#444] whitespace-nowrap"
                    >
                    {{ child.name }}
                    </Link>
                </div>
                </div>
            </div>
            </li>

          <li><Link href="/calendar" class="hover:text-[#E63946]">Calendar</Link></li>
          <li><Link href="/inscription" class="hover:text-[#E63946]">Inscription</Link></li>
           <li><Link href="/gallery" class="hover:text-[#E63946]">Galerie</Link></li>
           <li><Link href="/blog" class="hover:text-[#E63946]">Blog</Link></li>
          <li><Link href="/contact" class="hover:text-[#E63946]">Contact</Link></li>
        </ul>
      </nav>

      <div class="hidden md:flex space-x-4">

      <!-- 🔐 Гость -->
      <template v-if="!user">
        <Link href="/register" class="px-5 py-2 bg-primary text-black font-bold font-title rounded-full shadow-md hover:bg-primary transition flex items-center justify-center">S'INSCRIRE</Link>
        <Link href="/login" class="px-4 py-2 border border-primary text-white rounded-full font-bold">SIGN IN</Link>
      </template>

      <!-- 👤 Авторизованный -->
      <template v-else>
        <Link
        href="/redirect"
        class="px-5 py-2 bg-primary text-black font-bold font-title rounded-full shadow-md hover:bg-secondary transition flex items-center justify-center"
        >
        Mon espace
        </Link>


        <Link
        method="post"
        as="button"
        href="/logout"
        class="px-5 py-2 bg-primary text-black font-bold font-title rounded-full shadow-md hover:bg-secondary transition flex items-center justify-center"
        >
        Logout
        </Link>
      </template>

      </div>

      <button @click="toggleMenu" class="md:hidden focus:outline-none">
        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-secondary via-50% via-primary to-transparent opacity-80"></div>

    <div
      v-if="isOpen"
      class="md:hidden bg-black absolute top-16 left-0 w-full flex flex-col space-y-4 p-6 text-yellow-500 z-50"
    >
      <Link href="/" class="block hover:text-yellow-400 transition">Accueil</Link>
      <Link href="/about" class="block hover:text-yellow-400 transition">À propos</Link>
      <Link href="/courses" class="block hover:text-yellow-400 transition">Cours</Link>
      <Link href="/evenements" class="block hover:text-yellow-400 transition">Événements</Link>
      <Link href="/register" class="block hover:text-yellow-400 transition">Inscription</Link>
      <Link href="/contact" class="block hover:text-yellow-400 transition">Contact</Link>
      <Link
        href="/login"
        class="block mt-4 border border-yellow-500 text-center py-2 rounded-full hover:bg-yellow-500 hover:text-black transition"
      >
        SIGN IN
      </Link>
    </div>
  </header>
</template>

<style scoped>
.absolute.left-full {
  left: calc(100% - 10px);
}
</style>