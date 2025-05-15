<script setup>
import { Link } from '@inertiajs/vue3';
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";


</script>

<template>
    <div class="relative flex flex-col min-h-screen bg-background">
        <div class="absolute min-w-[500px] min-h-[500px] top-0 left-0 bg-no-repeat bg-cover z-[-1]"
            style="background-image: url('/images/backgrounds/Ellipse.png');"></div>
        <Header />
        <!-- Контент страницы -->
        <main class="flex-grow pt-32">
            <slot />
        </main>

        <!-- Подвал -->
       <Footer />
    </div>
</template>


