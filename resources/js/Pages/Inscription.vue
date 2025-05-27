<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

defineOptions({ layout: BaseLayout })

defineProps({
  courses: Array,
})

const form = useForm({
  name: '',
  email: '',
  message: '',
  course_id: '',
  course_trial: false,
})


function submit() {
  form.post(route('inscription.message'), {
    onSuccess: () => form.reset(),
  })
}
</script>

<template>
  <div class="bg-gradient-to-b from-[#1a0a05] to-background text-white min-h-screen font-inter">
    <!-- Page Heading -->
    <section class="text-center pt-24 pb-20">
      <h1 class="text-4xl font-semibold text-primary font-title">Inscription</h1>
    </section>

    <!-- Main Content -->
    <section class="max-w-7xl mx-auto px-4 md:px-10 lg:px-20 grid gap-20 items-start">

      <!-- Form -->
      <form @submit.prevent="submit" class="space-y-8">
        <!-- Name -->
        <div class="relative w-2/3 mx-auto">
          <input
            v-model="form.name"
            type="text"
            placeholder=" Entrez votre nom"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          />
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <!-- Email -->
        <div class="relative w-2/3 mx-auto">
          <input
            v-model="form.email"
            type="email"
            placeholder="Entrez votre e-mail"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          />
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <!-- Course Selection -->
        <div class="relative w-2/3 mx-auto">
          <select
            v-model="form.course_id"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none text-white text-xl py-4 font-body relative z-10 appearance-none"
          >
            <option disabled value="">Sélectionnez un cours</option>
            <option v-for="course in courses" :key="course.id" :value="course.id">
              {{ course.title }}
            </option>
          </select>
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <!-- Message -->
        <div class="relative w-2/3 mx-auto">
          <textarea
            v-model="form.message"
            rows="4"
            placeholder="Entrez votre message"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          ></textarea>
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <!-- Trial Checkbox -->
        <div class="w-2/3 mx-auto flex items-center gap-3">
        <input
            type="checkbox"
            v-model="form.course_trial"
            id="course_trial"
            class="h-5 w-5 text-primary border-gray-300 rounded"
        />
        <label for="course_trial" class="text-white text-lg">
            Je souhaite m'inscrire à un cours d’essai gratuit
        </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-4 text-center">
          <button
            type="submit"
            class="w-1/3 mx-auto my-10 block bg-primary text-background font-bold py-3 rounded-full shadow-md"
          >
            S'INSCRIRE
          </button>
        </div>
      </form>
    </section>
  </div>
</template>
