<script setup>
import { Head } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
</script>

<template>
  <Head title="Politique de confidentialité" />

  <div class="font-sans text-gray-900 antialiased bg-background">
    <div class="min-h-screen flex flex-col items-center justify-center pt-12">
      <div class="w-full max-w-6xl bg-background shadow-xl rounded-xl px-6 sm:px-10 py-8 text-text text-gray-800 space-y-6">
        <h1 class="text-3xl font-bold text-primary">Politique de confidentialité</h1>

        <p>
          Chez Wedance, nous nous engageons à protéger vos données personnelles et à respecter votre vie privée.
        </p>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">1. Données collectées</h2>
          <p class="mt-2 leading-relaxed">
            Nous collectons uniquement les données strictement nécessaires à la gestion de votre compte et à l'amélioration de nos services :
          </p>
          <ul class="list-disc list-inside space-y-1 mt-2">
            <li>Nom et prénom</li>
            <li>Adresse e-mail</li>
            <li>Informations de compte et d'inscription</li>
            <li>Historique des interactions avec notre site</li>
          </ul>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">2. Finalité de la collecte</h2>
          <p class="mt-2 leading-relaxed">Les données collectées nous permettent de :</p>
          <ul class="list-disc list-inside space-y-1 mt-2">
            <li>Gérer vos inscriptions et vos réservations</li>
            <li>Vous envoyer des confirmations et rappels de cours</li>
            <li>Améliorer la qualité de notre site et de nos services</li>
            <li>Vous transmettre des informations importantes sur nos activités (avec votre consentement)</li>
          </ul>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">3. Partage des données</h2>
          <p class="mt-2 leading-relaxed">
            Vos données ne sont jamais revendues. Elles peuvent être partagées uniquement avec nos partenaires techniques (hébergeur, prestataires de paiement), dans le strict respect du RGPD.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">4. Conservation des données</h2>
          <p class="mt-2 leading-relaxed">
            Vos données sont conservées pendant la durée nécessaire à la réalisation des finalités mentionnées ci-dessus, et au maximum pendant 3 ans après votre dernière interaction avec nous.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">5. Vos droits</h2>
          <p class="mt-2 leading-relaxed">Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez des droits suivants :</p>
          <ul class="list-disc list-inside space-y-1 mt-2">
            <li>Droit d’accès à vos données</li>
            <li>Droit de rectification si elles sont inexactes</li>
            <li>Droit d’effacement (droit à l’oubli)</li>
            <li>Droit d’opposition ou de limitation du traitement</li>
            <li>Droit à la portabilité de vos données</li>
          </ul>
          <p class="mt-2">
            Pour exercer vos droits, contactez-nous à :
            <a href="mailto:maryfadeeva1208@gmail.com" class="text-secondary underline">maryfadeeva1208@gmail.com</a>
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">6. Sécurité</h2>
          <p class="mt-2 leading-relaxed">
            Nous mettons en œuvre toutes les mesures techniques et organisationnelles appropriées afin d’assurer la sécurité et la confidentialité de vos données personnelles.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">7. Modifications de la politique</h2>
          <p class="mt-2 leading-relaxed">
            Nous nous réservons le droit de modifier cette politique de confidentialité à tout moment. Nous vous recommandons de la consulter régulièrement.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
