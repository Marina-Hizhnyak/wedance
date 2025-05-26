<template>
  <section class="relative min-h-[70vh] flex items-center bg-[url('/images/backgrounds/CTA.png')] bg-contain bg-center bg-no-repeat text-white">
    <div class="relative z-10 max-w-6xl mx-auto px-6 w-full flex flex-col lg:flex-row items-center justify-between">

      <!-- Text block -->
      <div class="max-w-xl text-center lg:text-left space-y-8 animate-fade-in-up">
        <h2 class="text-4xl sm:text-5xl font-bold text-primary font-title leading-tight">
          Inscrivez-vous à votre <br />
          premier cours gratuit !
        </h2>
        <p class="text-accent text-2xl sm:text-3xl font-title font-semibold">
          Wedance – votre école de danse spécialisée en salsa et bachata.
        </p>
        <a
          href="/inscription"
          class="inline-block px-8 py-3 rounded-full bg-primary text-black font-semibold font-title text-base tracking-wider shadow hover:bg-secondary transition duration-300"
        >
          S'INSCRIRE
        </a>
      </div>

      <!-- Image block -->
      <div class="mt-10 lg:mt-0 transform scale-95 opacity-0 animate-fade-in-up-slow hover:scale-100 transition duration-500">
        <img
          src="/images/home/couple.png"
          alt="Danseurs"
          class="w-[300px] lg:w-[400px] object-contain"
        />
      </div>
    </div>
  </section>
</template>

<style scoped>
@keyframes fadeInUp {
  0% {
    opacity: 0;
    transform: translateY(30px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.animate-fade-in-up {
  animation: fadeInUp 0.8s ease-out forwards;
}

.animate-fade-in-up-slow {
  animation: fadeInUp 1.2s ease-out forwards;
}
</style>


