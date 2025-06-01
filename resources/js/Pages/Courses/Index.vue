<script setup>
import BaseLayout from '@/Layouts/BaseLayout.vue'
import { ref, computed } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3'

const pageTitle = 'Wedance – Nos cours de danse'
const pageDescription = 'Explorez tous nos cours de danse latine : salsa, bachata, lindy hop et bien plus encore à Bruxelles.'

defineOptions({ layout: BaseLayout })

const props = defineProps({
    courses: Array,
    category: String,
    level: String
})

// ✅ reactive course list
const courseList = ref([...props.courses])

const title = computed(() =>
    props.level ? `${props.category} – ${props.level}` : props.category
)

const isSubmitting = ref(false)

const registerToCourse = (courseId) => {
    if (isSubmitting.value) return
    isSubmitting.value = true

    router.post(`/courses/${courseId}/register`, {}, {
        preserveScroll: true,
        onSuccess: () => {
            const course = courseList.value.find(c => c.id === courseId)
            if (course) {
                course.is_registered = true
            }
        },
        onFinish: () => {
            isSubmitting.value = false
        }
    })
}

const loadedImages = ref({})

const handleImageLoad = (id) => {
  loadedImages.value[id] = true
}
</script>

<template>
    <Head>
  <title>{{ pageTitle }}</title>
  <meta name="description" :content="pageDescription" />
  <meta property="og:title" :content="pageTitle" />
  <meta property="og:description" :content="pageDescription" />
  <meta property="og:type" content="website" />
  <meta property="og:url" :content="`https://wedance.maryk.be${$page.url}`" />
  <meta property="og:image" content="https://wedance.maryk.be/images/og-cover.jpg" />
  <link rel="canonical" :href="`https://wedance.maryk.be${$page.url}`" />
</Head>

    <section class="px-4 md:px-8 lg:px-16 py-10 bg-gradient-symmetric min-h-screen">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-extrabold text-accent mb-8 text-center">
                Nos cours : {{ title }}
            </h1>

            <!-- Courses Grid -->
            <div v-if="courseList.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div
                    v-for="course in courseList"
                    :key="course.id"
                    class="bg-background rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-shadow border border-primary group"
                >
                    <!-- Clickable Image -->
                    <Link :href="`/courses/${course.category.slug}/${course.level.slug}`">
                        <div class="relative w-full pb-[75%] overflow-hidden rounded-t-lg">
                            <img
                            :src="`/images/courses/${course.image}`"
                            :alt="`Image de ${course.title}`"
                            loading="lazy"
                            @load="handleImageLoad(course.id)"
                            :class="[
                            'absolute inset-0 w-full h-full object-cover transition-all duration-700 group-hover:scale-105',
                            loadedImages[course.id] ? 'opacity-100' : 'opacity-0'
                            ]"
                        />
                        </div>
                    </Link>

                    <div class="p-5">
                        <!-- Clickable Title -->
                        <Link :href="`/courses/${course.category.slug}/${course.level.slug}`">
                            <h2 class="text-xl font-semibold text-accent mb-2 hover:underline text-center">
                                {{ course.title }}
                            </h2>
                        </Link>

                        <!-- <p class="text-gray-600 text-sm">{{ course.description }}</p> -->

                        <div class="mt-4 flex flex-col gap-1 text-sm text-white text-center">
                            <!-- <span><strong>Durée:</strong> {{ course.duration }}</span> -->
                            <span>{{ course.day_time }}</span>
                            <!-- <span><strong>Prix:</strong> {{ course.price }} €</span> -->
                            <span v-if="course.level?.name"><strong>Niveau:</strong> {{ course.level.name }}</span>
                        </div>
                    </div>

                    <!-- Register Button -->
                <div class="mx-5 mb-5 flex justify-between gap-3">
                <button
                    v-if="!course.is_registered"
                    @click="registerToCourse(course.id)"
                    class="flex-1 bg-primary text-black font-bold px-4 py-2 rounded-full hover:scale-105 transition"
                >
                    Participer
                </button>

                <button
                    v-else
                    disabled
                    class="flex-1 bg-gray-400 text-white font-bold px-4 py-2 rounded-full cursor-not-allowed"
                >
                    Déjà inscrit
                </button>

                <Link
                    :href="`/courses/${course.category.slug}/${course.level.slug}`"
                    class="flex-1 border border-primary text-primary font-bold px-4 py-2 rounded-full text-center hover:bg-primary hover:text-black transition"
                >
                    LIRE PLUS
                </Link>
                </div>

                </div>
            </div>

            <!-- No Courses -->
            <div v-else class="text-center text-gray-500 text-lg mt-16">
                Aucun cours trouvé pour cette sélection.
            </div>
        </div>
    </section>
</template>

