<script setup>
import { ref } from 'vue'
import { Link, usePage } from '@inertiajs/vue3'
import Breadcrumbs from '@/Components/Breadcrumbs.vue'
import SearchBar from '@/Components/SearchBar.vue'
import LogoutButton from '@/Components/LogoutButton.vue'

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

// Close mobile menu on link click
const closeMenu = () => {
  isOpen.value = false
}

const menuCourses = usePage().props.menuCourses
const isActive = (path) => usePage().url === path
</script>

<template>
  <!-- Main header -->
  <header class="fixed w-full z-50 bg-background">
    <!-- Container with max-width for large screens -->
    <div class="w-[90%] max-w-[1440px] mx-auto flex justify-between items-center px-4 md:px-8 py-3">
      <!-- Logo -->
      <Link href="/" class="flex items-center shrink-0 w-[40px]">
        <img src="/images/logos/Union-primary.svg" alt="Logo" class="h-[40px] md:h-[40px] lg:h-[40px] w-auto" />
      </Link>

      <!-- Desktop navigation -->
      <nav class="hidden md:flex px-6 text-primary text-base md:text-xs lg:text-base font-title font-semibold">
        <ul class="flex md:gap-x-3 lg:gap-x-6 items-center">
          <li><Link href="/" class="hover:text-accent">Accueil</Link></li>
          <li><Link href="/about" class="hover:text-accent whitespace-nowrap">À propos</Link></li>
          <li><Link href="/evenements" class="hover:text-accent">Événements</Link></li>

          <!-- Courses mega menu -->
          <li class="relative" @mouseover="showCategory('main')" @mouseleave="scheduleHideCategory">
            <span class="cursor-pointer hover:text-accent">Cours</span>

            <div v-show="activeCategory === 'main'" class="absolute mt-2 top-12 bg-background rounded-md text-primary min-w-[200px] shadow-lg z-50">
              <div v-for="category in menuCourses" :key="category.id" class="relative" @mouseover="showCategory(category.id)" @mouseleave="scheduleHideCategory">
                <Link :href="`/courses/${category.slug}`" class="block px-4 py-2 hover:bg-[#333] whitespace-nowrap">
                  {{ category.name }}
                </Link>

                <!-- Subcategories -->
                <div v-show="Array.isArray(category.children) && category.children.length && activeCategory === category.id" class="absolute left-full top-0 bg-[#2b2b2b] rounded-md shadow-md min-w-[200px] z-50" @mouseover="showCategory(category.id)" @mouseleave="scheduleHideCategory">
                  <Link v-for="child in category.children" :key="child.id" :href="`/courses/${child.slug}`" class="block px-4 py-2 hover:bg-[#444] whitespace-nowrap">
                    {{ child.name }}
                  </Link>
                </div>
              </div>
            </div>
          </li>

          <!-- Other links -->
          <li><Link href="/calendar" class="hover:text-accent">Calendrier</Link></li>
          <li><Link href="/inscription" class="hover:text-accent">Inscription</Link></li>
          <li><Link href="/gallery" class="hover:text-accent">Galerie</Link></li>
          <li><Link href="/blog" class="hover:text-accent">Blog</Link></li>
          <li><Link href="/contact" class="hover:text-accent">Contact</Link></li>
        </ul>
      </nav>

      <!-- Desktop user buttons -->
      <div class="hidden md:flex space-x-2 md:space-x-3 lg:space-x-4 items-center">
        <!-- Guest -->
        <template v-if="!user">
          <Link href="/register" class="md:px-2 lg:px-4 py-1.5 bg-primary text-black text-sm md:text-xs lg:text-sm font-bold font-title rounded-full shadow-md hover:bg-secondary transition inline-flex items-center justify-center whitespace-nowrap">S'INSCRIRE</Link>
          <Link href="/login" class="md:px-2 lg:px-4 py-1.5 border border-primary text-white text-sm md:text-xs lg:text-sm rounded-full font-bold whitespace-nowrap">SE CONNECTER</Link>
        </template>

        <!-- Authenticated -->
        <template v-else>
          <Link href="/redirect" class="md:px-2 lg:px-4 py-1.5 bg-primary text-black text-sm md:text-xs lg:text-sm font-bold font-title rounded-full shadow-md hover:bg-secondary transition inline-flex items-center justify-center whitespace-nowrap">Mon espace</Link>
            <LogoutButton />
          <!-- <Link method="post" as="button" href="/logout" class="md:px-2 lg:px-4 py-1.5 border border-primary text-white text-sm md:text-xs lg:text-sm rounded-full font-bold whitespace-nowrap">Se déconnecter</Link> -->


         </template>
      </div>

      <!-- Mobile menu toggle button -->
      <button @click="toggleMenu" class="md:hidden focus:outline-none">
        <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>
    </div>

    <!-- Gradient border under header -->
    <div class="w-full h-[1px] bg-gradient-to-r from-transparent via-secondary via-50% via-primary to-transparent opacity-80"></div>

    <!-- Mobile menu -->
    <div v-if="isOpen" class="md:hidden bg-black absolute top-16 left-0 w-full flex flex-col space-y-4 p-6 text-yellow-500 z-50">
      <Link @click="closeMenu()" href="/">Accueil</Link>
      <Link @click="closeMenu()" href="/about">À propos</Link>
      <!-- <Link @click="closeMenu()" href="/courses">Cours</Link> -->
         <!-- Cours -->
        <div>
            <span class="block font-bold text-yellow-400">Cours</span>
            <div class="mt-2 ml-4 flex flex-col space-y-1">
            <Link
                v-for="category in menuCourses"
                :key="category.id"
                @click="closeMenu()"
                :href="`/cours/${category.slug}`"
                class="text-yellow-500 hover:text-yellow-400"
            >
                {{ category.name }}
            </Link>
            </div>
        </div>
      <Link @click="closeMenu()" href="/evenements">Événements</Link>
      <Link @click="closeMenu()" href="/inscription">Inscription</Link>
      <Link @click="closeMenu()" href="/contact">Contact</Link>

      <!-- Mobile auth buttons -->
      <template v-if="!user">
        <Link @click="closeMenu()" href="/register" class="block mt-2 bg-primary text-black text-center font-bold font-title rounded-full shadow-md hover:bg-secondary transition px-4 py-2">S'INSCRIRE</Link>
        <Link @click="closeMenu()" href="/login" class="block mt-2 border border-primary text-white text-center rounded-full font-bold px-4 py-2">SE CONNECTER</Link>
      </template>

      <template v-else>
        <Link @click="closeMenu()" href="/redirect" class="block mt-2 bg-primary text-black text-center font-bold font-title rounded-full shadow-md hover:bg-secondary transition px-4 py-2">Mon espace</Link>
        <Link method="post" as="button" href="/logout" class="block mt-2 bg-primary text-black text-center font-bold font-title rounded-full shadow-md hover:bg-secondary transition px-4 py-2">Se déconnecter</Link>
      </template>
    </div>

    <!-- Breadcrumbs and search under header -->
    <div class="w-[90%] max-w-[1440px] mx-auto bg-background flex flex-row items-center justify-between gap-2 my-3">
        <Breadcrumbs />
        <SearchBar />
    </div>
  </header>
</template>

<style scoped>
/* Small offset for subcategory menu */
.absolute.left-full {
  left: calc(100% - 10px);
}
</style>
