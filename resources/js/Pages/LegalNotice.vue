<script setup>
import { Head } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
</script>

<template>
  <Head title="Mentions légales" />

  <div class="font-sans text-gray-900 antialiased bg-background">
    <div class="min-h-screen flex flex-col items-center justify-center">
      <div class="w-full max-w-6xl bg-background shadow-xl rounded-xl px-6 sm:px-10 py-8 text-text space-y-6">
        <h1 class="text-primary text-3xl font-bold">Mentions légales</h1>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">1. Éditeur du site</h2>
          <p>Wedance</p>
          <p>École de danse Salsa &amp; Bachata</p>
          <p>1435 17, Hevillers, Mont-Saint-Guibert, Belgique</p>
          <p>Téléphone : (+32) 473 368 110</p>
          <p>Email : maryfadeeva1208@gmail.com</p>
          <p>Directeur de la publication : Maryna Khyzhniak</p>
          <p>Numéro d’entreprise : Non applicable</p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">2. Hébergement</h2>
          <p>OVH Cloud</p>
          <p>2 rue Kellermann - 59100 Roubaix - France</p>
          <p><a href="https://www.ovh.com" class="text-secondary underline">www.ovh.com</a></p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">3. Propriété intellectuelle</h2>
          <p>
            L’ensemble des contenus présents sur ce site (textes, images, logos, vidéos, etc.)
            est la propriété exclusive de Wedance ou de ses partenaires. Toute reproduction ou
            utilisation sans autorisation préalable est interdite.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">4. Responsabilité</h2>
          <p>
            Wedance s’efforce de fournir des informations fiables. Cependant, Wedance ne saurait
            être tenue pour responsable d’éventuelles erreurs, omissions ou résultats obtenus par
            un mauvais usage de ces informations.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">5. Données personnelles</h2>
          <p>
            Les informations collectées via ce site sont utilisées uniquement pour le traitement
            des demandes et la gestion des inscriptions.
          </p>
          <p>
            Conformément au RGPD, vous disposez d’un droit d’accès, de rectification et de
            suppression de vos données.
          </p>
          <p>
            Pour exercer ce droit, veuillez nous contacter à
            <a href="mailto:name@email.com" class="text-secondary underline">maryfadeeva1208@gmail.com</a>.
          </p>
        </div>

        <div>
          <h2 class="text-xl font-semibold text-primary mt-6">6. Conditions d’utilisation</h2>
          <p>
            L’utilisation de ce site implique l’acceptation pleine et entière des conditions
            générales d’utilisation. Les utilisateurs s’engagent à utiliser le site de manière
            responsable et à respecter les présentes mentions légales.
          </p>
        </div>
      </div>
    </div>
  </div>
</template>


