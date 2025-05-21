<script setup>
import { Head, router } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref } from 'vue'

defineOptions({ layout: BaseLayout })

const { course, is_registered } = defineProps({
    course: Object,
    is_registered: Boolean
})

const isSubmitting = ref(false)

const registerToCourse = () => {
    if (isSubmitting.value) return
    isSubmitting.value = true

    router.post(`/courses/${course.id}/register`, {}, {
        preserveScroll: true,
        onFinish: () => isSubmitting.value = false
    })
}
</script>

<template>
    <Head :title="course.title" />
    <div class="bg-gradient-symmetric text-white min-h-screen font-inter">
        <!-- Page Header -->
        <section class="text-center pt-24 pb-12">
            <h1 class="text-5xl font-bold text-yellow-400 font-title">{{ course.title }}</h1>
            <p class="mt-4 text-gray-300">{{ course.category?.name }} - {{ course.level?.name }}</p>
        </section>

        <!-- Course Content -->
        <section class="max-w-5xl mx-auto flex flex-col md:flex-row items-center justify-center gap-8 px-6 md:px-8 pb-20">
            <!-- Course Image -->
            <div class="flex w-auto md:w-1/2 justify-center items-center h-full min-h-[300px]">
                <img
                    v-if="course.image"
                    :src="`/images/courses/${course.image}`"
                    :alt="course.title"
                    class="w-full rounded-xl shadow-lg"
                />
            </div>

            <!-- Course Details -->
            <div class="w-full md:w-1/2 space-y-4">
                <p class="text-lg text-gray-300">{{ course.description }}</p>

                <div class="text-sm text-gray-400 space-y-1">
                    <div><strong>Duration:</strong> {{ course.duration }}</div>
                    <div><strong>Schedule:</strong> {{ course.day_time }}</div>
                    <div><strong>Price:</strong> {{ course.price }} €</div>
                </div>


                <!-- Instructor Info -->
                <div class="pt-8 border-t border-gray-700 mt-6">
                <h2 class="text-2xl font-semibold text-yellow-400 mb-4">Votre instructeur</h2>

                <div class="flex items-start gap-6">
                    <!-- Instructor photo -->
                    <div class="shrink-0">
                    <img
                        v-if="course.instructor?.team_profile?.photo"
                        :src="course.instructor.team_profile.photo"
                        alt="Photo du professeur"
                        class="w-20 h-20 rounded-full object-cover border-2 border-yellow-400 shadow"
                    />
                    </div>

                    <!-- Instructor info -->
                    <div class="space-y-2">
                    <p class="text-lg font-bold text-white">
                        {{ course.instructor?.name }}
                    </p>
                    <p class="text-sm text-yellow-300 italic">
                        {{ course.instructor?.team_profile?.role }}
                    </p>

                    <!-- Social icons -->
                    <div class="flex gap-4 mt-3 text-yellow-400 text-xl">
                        <a
                        v-if="course.instructor?.team_profile?.telegram_url"
                        :href="course.instructor.team_profile.telegram_url"
                        target="_blank"
                        class="hover:text-secondary transition"
                        >
                        <img src="/images/icons/lettre.svg" alt="Telegram" class="w-5 h-5" />
                        </a>
                        <a
                        v-if="course.instructor?.team_profile?.whatsapp_url"
                        :href="course.instructor.team_profile.whatsapp_url"
                        target="_blank"
                        class="hover:text-secondary transition"
                        >
                        <img src="/images/icons/phone.svg" alt="WhatsApp" class="w-5 h-5" />
                        </a>
                        <a
                        v-if="course.instructor?.team_profile?.vk_url"
                        :href="course.instructor.team_profile.vk_url"
                        target="_blank"
                        class="hover:text-secondary transition"
                        >
                        <img src="/images/icons/vk.svg" alt="VK" class="w-5 h-5" />
                        </a>
                    </div>
                    </div>
                </div>
                </div>


                <!-- Register Button -->
                <div class="pt-4">
                    <button
                        v-if="!is_registered"
                        @click="registerToCourse"
                        class="inline-block bg-primary hover:bg-secondary text-black font-bold px-8 py-3 rounded-full shadow-md hover:scale-105 transition"
                    >
                        Participer
                    </button>

                    <span
                        v-else
                        class="inline-block bg-gray-400 text-white font-bold px-8 py-3 rounded-full shadow-md cursor-not-allowed"
                    >
                        Déjà inscrit
                    </span>
                </div>

                <!-- Back link -->
                <div class="pt-4">
                    <a href="/courses" class="text-secondary hover:underline">&larr; Tous les cours </a>
                </div>
            </div>
        </section>
    </div>
</template>
