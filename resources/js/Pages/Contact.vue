<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { useForm } from '@inertiajs/vue3'

defineOptions({ layout: BaseLayout })
const form = useForm({
  name: '',
  email: '',
  message: '',
  course_id: '',
})

function submit() {
  form.post(route('inscription.message'), {
    onSuccess: () => form.reset(),
  })
}


</script>

<template>
  <div class="bg-gradient-symmetric text-white min-h-screen font-inter">
    <!-- Title -->
    <section class="text-center pt-24 pb-20">
      <h1 class="text-4xl font-semibold text-primary font-title">Contactez Nous</h1>
    </section>

   <!-- Flasn-message -->
        <div v-if="$page.props.flash?.success" class="text-center text-primary font-bold">
        {{ $page.props.flash.success }}
      </div>

    <!-- Content -->
    <section class="max-w-7xl mx-auto px-4 md:px-10 lg:px-20 grid gap-20 items-start">
      <!-- Form -->
      <form @submit.prevent="submit" class="space-y-8">
        <div class="relative w-2/3 mx-auto">
          <input
            v-model="form.name"
            type="text"
            placeholder="Entrez votre nom"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          />
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <div class="relative w-2/3 mx-auto">
          <input
            v-model="form.email"
            type="email"
            placeholder="Entrez votre e-mail"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          />
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <div class="relative w-2/3 mx-auto">
          <textarea
            v-model="form.message"
            rows="4"
            placeholder="Entrez votre message"
            class="w-full bg-transparent border-none focus:outline-none focus:ring-0 focus:shadow-none placeholder:text-white py-4 text-xl font-body leading-[30px] relative z-10"
          ></textarea>
          <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-accent via-secondary to-primary z-0"></div>
        </div>

        <div class="pt-4 text-center">
          <button
            type="submit"
            class="w-1/3 mx-auto my-10 block bg-primary text-background font-bold py-3 rounded-full shadow-md"
          >
            DANSER
          </button>
        </div>
      </form>

      <!-- Contacts + carte -->
      <div class="flex flex-col lg:flex-row justify-center items-start gap-20 my-20 mb-40">
        <!-- Icons -->
        <div class="flex flex-col justify-center items-center gap-10 self-center">
          <a href="#" class="hover:opacity-80 transition">
            <img src="/images/icons/lettre.svg" alt="Telegram" class="w-10 h-10" />
          </a>
          <a href="#" class="hover:opacity-80 transition">
            <img src="/images/icons/tel.svg" alt="WhatsApp" class="w-10 h-10" />
          </a>
          <a href="#" class="hover:opacity-80 transition">
            <img src="/images/icons/vk.svg" alt="VK" class="w-10 h-10" />
          </a>
        </div>

        <!-- Carte -->
        <div class="w-[500px] h-[500px] rounded-full overflow-hidden border-4 border-white shrink-0">
          <iframe
            src="https://www.google.com/maps?q=Bruxelles,+Albert+Hall,+6&output=embed"
            class="w-full h-full"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"
          ></iframe>
        </div>

        <!-- Contacts -->
        <div class="text-left text-sm w-full max-w-sm self-center">
        <h2 class="text-4xl font-bold text-accent font-title py-10">Contacts</h2>

        <div class="space-y-8">
            <p class="flex items-center gap-5">
            <img src="/images/icons/telephone.svg" alt="phone" class="w-10 h-10" />
            <span class="text-white font-normal font-title text-xl">+7 920 106 89 29</span>
            </p>
            <p class="flex items-center gap-5">
            <img src="/images/icons/point.svg" alt="map" class="w-10 h-10" />
            <span class="text-white font-normal font-title text-xl">Bruxelles, Albert Hall, 6</span>
            </p>
            <p class="flex items-center gap-5">
            <img src="/images/icons/enveloppe.svg" alt="mail" class="w-10 h-10" />
            <span class="text-white font-normal font-title text-xl">way7creation@gmail.com</span>
            </p>
        </div>

        <!-- Button -->
        <div class="mt-20">
            <button class="bg-primary text-black font-bold px-6 py-1.5 rounded-full ml-2">
            DANSER
            </button>
        </div>
        </div>


      </div>
    </section>
  </div>
</template>

