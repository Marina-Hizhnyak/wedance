<script setup>
import { Head } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })

const policy = `
<h1 class="text-primary">Mentions légales</h1>

<h2>1. Éditeur du site</h2>
Wedance<br>
École de danse Salsa & Bachata<br>
1435 17, Hevillers, Mont-Saint-Guibert, Belgique<br>
Téléphone : (+32) 473 368 110<br>
Email : maryfadeeva1208@gmail.com<br>
Directeur de la publication : Maryna Khyzhniak<br>
Numéro d’entreprise : Non applicable<br>

<h2>2. Hébergement</h2>
OVH Cloud<br>
2 rue Kellermann - 59100 Roubaix - France<br>
www.ovh.com<br>

<h2>3. Propriété intellectuelle</h2>
L’ensemble des contenus présents sur ce site (textes, images, logos, vidéos, etc.) est la propriété exclusive de Wedance ou de ses partenaires.
Toute reproduction ou utilisation sans autorisation préalable est interdite.

<h2>4. Responsabilité</h2>
Wedance s’efforce de fournir des informations fiables.
Cependant, Wedance ne saurait être tenue pour responsable d’éventuelles erreurs, omissions ou résultats obtenus par un mauvais usage de ces informations.

<h2>5. Données personnelles</h2>
Les informations collectées via ce site sont utilisées uniquement pour le traitement des demandes et la gestion des inscriptions.
Conformément au RGPD, vous disposez d’un droit d’accès, de rectification et de suppression de vos données.
Pour exercer ce droit, veuillez nous contacter à name@email.com.

<h2>6. Conditions d’utilisation</h2>
L’utilisation de ce site implique l’acceptation pleine et entière des conditions générales d’utilisation.
Les utilisateurs s’engagent à utiliser le site de manière responsable et à respecter les présentes mentions légales.
`
</script>

<template>
    <Head title="Mentions légales" />

    <div class="font-sans text-gray-900 antialiased bg-background">
        <div class="min-h-screen flex flex-col items-center justify-center">
            <!-- Main content block -->
            <div class="w-full max-w-4xl bg-background  shadow-xl rounded-xl px-6 sm:px-10 py-8 text-text">
                <div class="prose prose-headings:text-primary prose-a:text-secondary prose-h1:font-bold prose-h2:mt-6 prose-h2:font-semibold prose-p:leading-relaxed text-text" v-html="policy" />
            </div>
        </div>
    </div>
</template>

