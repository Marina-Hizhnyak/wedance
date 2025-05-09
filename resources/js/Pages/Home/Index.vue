<template>
    <div>
    <CTASection />
    <HeroSection />
    <TeamSection :team-members="teams" />
    <TestimonialsSection :testimonials="testimonials" />
    <CoursesSection :courses="courses" />
    <!-- <EventsSection :events="events" /> -->
    </div>
</template>

<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue';
import CTASection from '@/Components/Home/CTASection.vue';
import HeroSection from '@/Components/Home/HeroSection.vue';
import TeamSection from '@/Components/Home/TeamSection.vue';
import CoursesSection from '@/Components/Home/CoursesSection.vue';
import EventsSection from '@/Components/Home/EventsSection.vue';
import TestimonialsSection from '@/Components/Home/TestimonialsSection.vue';


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
