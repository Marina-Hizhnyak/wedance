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

    router.post(`/courses/${props.course.id}/register`, {}, {
        preserveScroll: true,
        onFinish: () => isSubmitting.value = false
    })
}
</script>

<template>
    <pre>{{ props }}</pre>
    <Head :title="course.title" />

    <div class="bg-gradient-to-b from-[#1a0a05] to-background text-white min-h-screen font-inter">
        <!-- Page Header -->
        <section class="text-center pt-24 pb-12">
            <h1 class="text-5xl font-bold text-yellow-400 font-title">{{ course.title }}</h1>
            <p class="mt-4 text-gray-300">{{ course.category?.name }} - {{ course.level?.name }}</p>
        </section>

        <!-- Course Content -->
        <section class="max-w-5xl mx-auto flex flex-col md:flex-row items-center md:items-start gap-8 px-6 md:px-8 pb-20">
            <!-- Course Image -->
            <div class="w-full md:w-1/2">
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

                <!-- Register Button -->
                <div class="pt-4">
                    <button
                        v-if="!is_registered"
                        @click="registerToCourse"
                        class="inline-block bg-gradient-to-r from-yellow-300 to-orange-400 text-black font-bold px-8 py-3 rounded-full shadow-md hover:scale-105 transition"
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
                    <a href="/courses" class="text-secondary hover:underline">&larr; Retour aux cours</a>
                </div>
            </div>
        </section>
    </div>
</template>
