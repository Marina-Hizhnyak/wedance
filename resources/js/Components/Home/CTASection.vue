<template>
<section class="relative min-h-[70vh] flex items-center bg-[url('/images/backgrounds/CTA.png')] bg-contain bg-center bg-no-repeat text-white">

    <div class="relative z-10 max-w-6xl mx-auto px-6 w-full flex flex-col lg:flex-row items-center justify-between">

      <!-- Text block -->
      <div class="max-w-xl text-center lg:text-left space-y-8">
        <h2 class="text-4xl sm:text-5xl font-bold text-primary font-title leading-tight">
          Inscrivez-vous à votre <br />
          premier cours gratuit !
        </h2>
        <p class="text-accent text-2xl sm:text-3xl font-title font-semibold">
          Wedance – votre école de danse spécialisée en salsa et bachata.
        </p>
        <a
          href="/register"
          class="inline-block px-8 py-3 rounded-full bg-primary text-black font-semibold font-title text-base tracking-wider shadow hover:bg-secondary transition"
        >
          S'INSCRIRE
        </a>
      </div>

      <!-- Image block -->
      <div class="mt-10 lg:mt-0">
        <img
          src="/images/home/couple.png"
          alt="Danseurs"
          class="w-[300px] lg:w-[400px] object-contain"
        />
      </div>
    </div>
  </section>
</template>

