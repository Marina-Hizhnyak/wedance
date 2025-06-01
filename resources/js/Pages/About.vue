<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { Head } from '@inertiajs/vue3'

const pageTitle = 'Wedance – À propos de notre école'
const pageDescription = 'Découvrez l’histoire de Wedance, notre philosophie, et notre équipe de professeurs passionnés.'

defineOptions({ layout: BaseLayout })
</script>

<template>
    <Head>
  <title>{{ pageTitle }}</title>
  <meta name="description" :content="pageDescription" />
  <meta property="og:title" :content="pageTitle" />
  <meta property="og:description" :content="pageDescription" />
  <meta property="og:type" content="website" />
  <meta property="og:url" :content="`https://wedance.maryk.be${$page.url}`" />
  <meta property="og:image" content="https://wedance.maryk.be/images/og-cover.jpg" />
  <link rel="canonical" :href="`https://wedance.maryk.be${$page.url}`" />
</Head>

  <div class="bg-gradient-symmetric text-white min-h-screen font-inter">
    <!-- Title -->
    <section class="text-center pt-24 pb-10">
      <h1 class="text-5xl font-bold text-primary font-title">À propos de Wedance</h1>
      <p class="mt-6 text-lg text-gray-300 max-w-3xl mx-auto">
        Chez Wedance, nous croyons que la danse est plus qu’un simple mouvement : c’est une véritable expression de soi, une connexion entre le corps, l’esprit et la musique.
      </p>
    </section>

    <!-- Image -->
    <section class="flex justify-center my-16">
      <img src="/images/about/1.jpg" alt="Danse chez Wedance" class="rounded-lg shadow-lg w-[80%] max-w-4xl" />
    </section>

    <!-- Histoire de l'école -->
    <section class="max-w-4xl mx-auto px-6 text-gray-300 text-lg space-y-6">
      <h2 class="text-3xl text-primary font-title font-bold text-center">Notre histoire</h2>
      <p>
        Fondée en Belgique par une équipe de passionnés, Wedance est née du désir de créer un espace inclusif et inspirant où chaque élève, peu importe son niveau, peut s’épanouir et se dépasser grâce à la danse.
      </p>
      <p>
        Notre école est spécialisée dans les danses latines : Salsa, Bachata, Kizomba, ainsi que dans d'autres styles comme le Modern Jazz et la Zumba. Depuis plus de 5 ans, nous avons formé des centaines d’élèves qui partagent tous le même amour du mouvement et de la musique.
      </p>

      <h2 class="text-3xl text-primary font-title font-bold text-center">Nos valeurs</h2>
      <p>
        Chez Wedance, nous prônons la bienveillance, la convivialité et le respect. Chaque cours est conçu pour être un moment de plaisir et d’apprentissage dans une atmosphère détendue et positive.
      </p>

      <h2 class="text-3xl text-primary font-title font-bold text-center">Une équipe de professionnels</h2>
      <p>
        Notre équipe est composée de professeurs diplômés et expérimentés, reconnus dans le monde de la danse. Ils sauront vous transmettre leur passion et vous accompagner à chaque étape de votre progression, que vous soyez débutant ou danseur confirmé.
      </p>

      <h2 class="text-3xl text-primary font-title font-bold text-center">Rejoignez la communauté Wedance</h2>
      <p>
        Plus qu’une école, Wedance est une véritable communauté. Des cours, des workshops, des soirées dansantes et des événements sont régulièrement organisés pour vous permettre de vivre pleinement votre passion et de rencontrer d’autres passionnés.
      </p>
    </section>

    <!-- CTA -->
    <section class="text-center pb-24 pt-16">
      <h2 class="text-3xl text-primary font-title font-bold mb-4">Prêt à danser ?</h2>
      <p class="text-lg text-gray-300 mb-8 max-w-2xl mx-auto">
        Inscrivez-vous dès aujourd’hui et commencez votre aventure avec Wedance. Peu importe votre niveau, notre équipe vous accueille avec enthousiasme pour partager des moments inoubliables.
      </p>
      <a href="/inscription" class="md:px-2 lg:px-4 py-1.5 bg-primary text-black text-sm md:text-xs lg:text-sm font-bold font-title rounded-full shadow-md hover:bg-secondary transition inline-flex items-center justify-center whitespace-nowrap">
        Découvrir nos cours
      </a>
    </section>
  </div>
</template>

