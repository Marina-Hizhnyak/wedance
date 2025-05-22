<script setup>
import { Head } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })
</script>

<template>
    <Head title="Gestion des cookies" />

    <div class="font-sans text-gray-900 antialiased bg-background">
        <div class="min-h-screen flex flex-col items-center justify-center pt-12">

            <!-- Main content block -->
            <div class="w-full max-w-6xl bg-background shadow-xl rounded-xl px-6 sm:px-10 py-8 text-text prose text-gray-800 prose-headings:text-primary prose-a:text-secondary prose-h1:font-bold prose-h2:mt-4 prose-h2:font-semibold prose-p:mt-2 prose-p:leading-relaxed">
                <h1>Gestion des cookies</h1>

                <p>Cette politique de gestion des cookies vous informe sur l’utilisation des cookies sur le site de Wedance.</p>

                <h2>Qu’est-ce qu’un cookie ?</h2>
                <p>Un cookie est un petit fichier texte déposé sur votre terminal (ordinateur, mobile ou tablette) lors de la consultation d’un site Internet. Il permet à son émetteur d’identifier le terminal sur lequel il est enregistré, pendant la durée de validité ou d’enregistrement du cookie.</p>

                <h2>Pourquoi utilisons-nous des cookies ?</h2>
                <p>Les cookies que nous utilisons nous permettent :</p>
                <ul>
                    <li>De faciliter votre navigation sur le site</li>
                    <li>De mémoriser vos préférences et vos choix (ex : langue, identifiant)</li>
                    <li>De réaliser des statistiques d’audience et d’utilisation</li>
                    <li>D’améliorer la performance du site et la qualité de nos services</li>
                </ul>

                <h2>Types de cookies utilisés</h2>
                <ul>
                    <li>Cookies strictement nécessaires : indispensables au fonctionnement du site</li>
                    <li>Cookies de performance : utilisés pour recueillir des informations sur l’utilisation du site</li>
                    <li>Cookies de fonctionnalité : permettent d’améliorer la navigation</li>
                    <li>Cookies de ciblage ou publicitaires : peuvent être utilisés pour afficher des publicités adaptées à vos centres d’intérêt (actuellement non utilisés par Wedance)</li>
                </ul>

                <h2>Consentement</h2>
                <p>Lors de votre première visite, une bannière vous informe de la présence de cookies et vous invite à indiquer votre choix. Ces cookies ne sont déposés que si vous les acceptez.</p>

                <h2>Gestion des cookies</h2>
                <p>Vous pouvez à tout moment choisir de désactiver les cookies via les paramètres de votre navigateur :</p>
                <ul>
                    <li>Google Chrome : Paramètres > Confidentialité et sécurité > Cookies</li>
                    <li>Mozilla Firefox : Options > Vie privée et sécurité > Cookies</li>
                    <li>Safari : Préférences > Confidentialité</li>
                    <li>Edge : Paramètres > Cookies et autorisations de site</li>
                </ul>

                <h2>Mise à jour</h2>
                <p>Cette politique peut être modifiée à tout moment. Nous vous invitons à la consulter régulièrement.</p>
            </div>
        </div>
    </div>
</template>




