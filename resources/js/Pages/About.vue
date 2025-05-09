<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
</script>

<template>
  <div class="bg-gradient-to-b from-[#1a0a05] to-background text-white min-h-screen font-inter">
    <!-- Заголовок -->
    <section class="text-center pt-24 pb-10">
      <h1 class="text-5xl font-bold text-primary font-title">À propos de Wedance</h1>
      <p class="mt-6 text-lg text-gray-300 max-w-3xl mx-auto">
        Chez Wedance, nous croyons que la danse est plus qu’un mouvement – c’est une expression de l’âme. Notre mission est de créer une communauté passionnée autour de la musique, de l’apprentissage et du plaisir partagé.
      </p>
    </section>

    <!-- Image или видео -->
    <section class="flex justify-center my-16">
      <img src="/images/about/about-img.jpg" alt="Danse chez Wedance" class="rounded-lg shadow-lg w-[80%] max-w-4xl" />
    </section>

    <!-- CTA -->
    <section class="text-center pb-24">
      <button class="bg-gradient-to-r from-yellow-300 to-orange-400 text-black font-bold px-8 py-3 rounded-full shadow-md hover:scale-105 transition">
        Découvrir nos cours
      </button>
    </section>
  </div>
</template>
