<template>
  <Head>
    <title>{{ pageTitle }}</title>
    <meta name="description" :content="pageDescription" />
    <meta property="og:title" :content="pageTitle" />
    <meta property="og:description" :content="pageDescription" />
    <meta property="og:type" content="website" />
    <meta property="og:url" :content="`https://wedance.maryk.be/${$page.url}`" />
    <meta property="og:image" content="https://wedance.maryk.be/images/og-cover.jpg" />
    <link rel="canonical" :href="`https://wedance.maryk.be/${$page.url}`" />
  </Head>

  <div class="bg-background">
    <ChatModal />
    <CTASection />
    <HeroSection />
    <TeamSection :team-members="teams" />
    <TestimonialsSection :testimonials="testimonials" />
    <CoursesSection :courses="courses" />
    <!-- <EventsSection :events="events" /> -->
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'

import BaseLayout from '@/Layouts/BaseLayout.vue';
import CTASection from '@/Components/Home/CTASection.vue';
import HeroSection from '@/Components/Home/HeroSection.vue';
import TeamSection from '@/Components/Home/TeamSection.vue';
import CoursesSection from '@/Components/Home/CoursesSection.vue';
import EventsSection from '@/Components/Home/EventsSection.vue';
import TestimonialsSection from '@/Components/Home/TestimonialsSection.vue';
import ChatModal from '@/Components/ChatModal.vue';

const pageTitle = 'Wedance – Cours de danse à Bruxelles'
const pageDescription = 'Découvrez nos cours de salsa et bachata, nos professeurs passionnés et nos événements chaleureux à Bruxelles.'

defineOptions({
    layout: BaseLayout
});
defineProps({
    courses: Array,
    events: Array,
    testimonials: Array,
    teams: Array,
});
</script>
