<template>
  <section
    class="relative bg-[url('/images/backgrounds/hero.png')] bg-contain bg-center bg-no-repeat text-white"
  >
    <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col-reverse lg:flex-row items-center gap-12">

      <!-- Left: Image -->
      <div class="w-full lg:w-1/2 flex justify-center">
        <img
          src="/images/home/hero.jpeg"
          alt="Danseurs"
          class="rounded-[40px] h-[500px] w-auto object-contain shadow-lg"
        />
      </div>

      <!-- Right: Text -->
      <div class="w-full lg:w-1/2 text-center lg:text-left space-y-6 relative z-10">
        <h1 class="text-5xl md:text-5xl font-bold text-primary font-title leading-tight">
          Découvrez l’école<br />
          <span class="text-primary">Wedance</span>
        </h1>
        <p class="text-base md:text-lg text-white/90 leading-relaxed text-body">
          Chez Wedance, nous croyons que la danse est bien plus qu’un art : c’est une passion, un mode de vie et un moyen de se connecter avec soi-même et les autres. Rejoignez notre communauté chaleureuse pour apprendre et évoluer à votre rythme avec nos professeurs expérimentés.
        </p>
        <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
          <a
            href="/about"
            class="px-6 py-2 bg-primary text-black rounded-full font-semibold font-title shadow hover:bg-secondary transition"
          >
            LIRE PLUS
          </a>
          <a
            href="/gallery"
            class="px-6 py-2 bg-secondary text-white rounded-full font-semibold font-title shadow hover:bg-primary transition"
          >
            GALERIE
          </a>
        </div>
      </div>
    </div>
  </section>
</template>
