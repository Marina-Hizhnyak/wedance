<template>
  <div class="max-w-7xl mx-auto px-4 py-12 text-white">
    <!-- Post Info -->
    <div class="mb-6">
      <h1 class="text-3xl md:text-4xl font-bold text-primary mb-2">{{ post.title }}</h1>
      <p class="text-sm text-gray-400">
        Publié par {{ post.author.name }} le {{ formatDate(post.created_at) }}
      </p>
    </div>

    <!-- Image + Content block -->
    <div v-if="post.image" class="md:flex md:gap-8 mb-10">
      <!-- Post Image -->
      <div class="md:w-1/3 mb-6 md:mb-0">
        <img
          :src="post.image"
          :alt="post.title"
          class="w-full h-auto rounded shadow object-cover"
        />
      </div>

      <!-- Post Content -->
      <div class="md:w-2/3 prose prose-invert max-w-none" v-html="post.content" />
    </div>

    <div v-else class="prose prose-invert max-w-none mb-10" v-html="post.content" />

    <!-- Like Button -->
    <div class="mb-6 flex items-center space-x-3">
      <button v-if="user"
        @click="toggleLike"
        class="px-4 py-1 text-sm font-bold rounded bg-red-600 hover:bg-red-700 text-white"
      >
        ❤️ {{ isLiked ? 'Unlike' : 'Like' }}
      </button>
      <span class="text-sm text-gray-300">❤️ {{ post.likes.length }} likes</span>
    </div>

    <!-- Comment Form -->
    <div v-if="user" class="mt-12">
      <h2 class="text-xl font-bold mb-2 text-primary">Ajouter un commentaire</h2>
      <form @submit.prevent="submitComment" class="space-y-4">
        <textarea
          v-model="form.content"
          class="w-full p-3 bg-gray-800 text-white border border-gray-600 rounded"
          rows="4"
          placeholder="Votre commentaire..."
        ></textarea>
        <button
          type="submit"
          :disabled="form.processing"
          class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary"
        >
          Publier
        </button>
      </form>
    </div>
    <div v-else class="mt-12 text-gray-400 italic">
      Vous devez être connecté pour commenter.
    </div>

    <!-- Comment List -->
    <div v-if="post.comments && post.comments.length" ref="commentSection" class="mt-10 space-y-6">
      <h2 class="text-xl font-bold text-primary mb-2">Commentaires</h2>
      <div
        v-for="comment in post.comments"
        :key="comment.id"
        class="bg-gray-800 p-4 rounded border border-gray-700"
      >
        <p class="text-sm text-gray-400 mb-1">
          {{ comment.user?.name }} le {{ formatDate(comment.created_at) }}
        </p>
        <p>{{ comment.content }}</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick, computed, onMounted } from 'vue'
import { defineProps } from 'vue'
import { useForm, usePage, router } from '@inertiajs/vue3'
import BaseLayout from '@/Layouts/BaseLayout.vue'

defineOptions({ layout: BaseLayout })

const props = defineProps({
  post: Object,
})
const post = props.post

const user = usePage().props.auth?.user

const form = useForm({
  content: '',
})

const commentSection = ref(null)

const isLiked = computed(() => {
  if (!user || !post.likes) return false
  return post.likes.some(like => like.user_id === user.id)
})

function toggleLike() {
  router.post(route('like.toggle'), {
    likeable_type: 'App\\Models\\BlogPost',
    likeable_id: post.id,
  }, {
    preserveScroll: true,
    onSuccess: () => {
      if (isLiked.value) {
        post.likes = post.likes.filter(like => like.user_id !== user.id)
      } else {
        post.likes.push({ user_id: user.id })
      }
    }
  })
}

function submitComment() {
  localStorage.setItem('scrollToComment', '1')

  router.post(route('blog.comment', post.id), {
    content: form.content,
  }, {
    onSuccess: () => {
      form.reset()
      router.visit(window.location.pathname, {
        preserveState: false,
        preserveScroll: false,
      })
    }
  })
}

onMounted(() => {

  if (localStorage.getItem('scrollToComment')) {
    localStorage.removeItem('scrollToComment')

    setTimeout(() => {
      commentSection.value?.scrollIntoView({ behavior: 'smooth' })
    }, 500)
  }
})

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  })
}
</script>
