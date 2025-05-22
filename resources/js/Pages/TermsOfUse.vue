<script setup>
import { Head } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
</script>

<template>
    <Head title="Conditions générales d’utilisation" />

    <div class="font-sans text-gray-900 antialiased bg-background">
        <div class="min-h-screen flex flex-col items-center justify-center pt-12">

            <!-- Main content block -->
            <div class="w-full max-w-6xl bg-background shadow-xl rounded-xl px-6 sm:px-10 py-8 text-text prose text-gray-800 prose-headings:text-primary prose-a:text-secondary prose-h1:font-bold prose-h2:mt-4 prose-h2:font-semibold prose-p:mt-2 prose-p:leading-relaxed">
                <h1>Conditions générales d’utilisation (CGU)</h1>

                <p>L’utilisation du site Wedance implique l’acceptation pleine et entière des présentes conditions :</p>

                <h2>1. Objet</h2>
                <p>Les présentes conditions ont pour objet de définir les modalités d’accès et d’utilisation du site wedance.be par l’utilisateur.</p>

                <h2>2. Accès au site</h2>
                <p>Le site est accessible 24h/24 et 7j/7, sauf en cas de force majeure ou d’événements hors de notre contrôle. Wedance se réserve le droit d’interrompre l’accès pour des raisons de maintenance ou d’amélioration.</p>

                <h2>3. Contenu du site</h2>
                <p>Le contenu du site est fourni à titre informatif. Wedance s’efforce d’assurer l’exactitude des informations mais ne garantit pas leur exhaustivité ni leur actualité.</p>

                <h2>4. Responsabilité de l’utilisateur</h2>
                <ul>
                    <li>L’utilisateur s’engage à ne pas publier de contenus illicites, offensants ou portant atteinte aux droits de tiers.</li>
                    <li>Tout comportement abusif peut entraîner une suspension ou une suppression d’accès au site.</li>
                </ul>

                <h2>5. Propriété intellectuelle</h2>
                <p>Tous les éléments du site (textes, images, graphismes, logos, vidéos, etc.) sont protégés par les droits de propriété intellectuelle et appartiennent à Wedance ou à ses partenaires.
                Toute reproduction ou utilisation sans autorisation écrite est interdite.</p>

                <h2>6. Limitations de responsabilité</h2>
                <p>Wedance décline toute responsabilité en cas d’interruption ou de dysfonctionnement du site, ainsi qu’en cas de dommages indirects liés à l’utilisation du site.</p>

                <h2>7. Modification des CGU</h2>
                <p>Wedance se réserve le droit de modifier les présentes conditions à tout moment et sans préavis. Nous vous conseillons de les consulter régulièrement.</p>
            </div>
        </div>
    </div>
</template>
