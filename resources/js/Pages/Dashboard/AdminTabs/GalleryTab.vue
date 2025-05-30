<template>
  <div class="p-6">
    <h2 class="text-3xl font-bold text-primary mb-4">Galerie</h2>

    <!-- Upload Form -->
    <form @submit.prevent="submit" class="mb-6 space-y-4" enctype="multipart/form-data">
      <div>
        <label class="block mb-1 font-semibold">Titre de l’image (optionnel):</label>
        <input v-model="form.title" type="text" class="w-[50%] border rounded p-2 bg-gray-900 focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Choisir une image:</label>
        <input type="file" @change="handleFileChange" accept="image/*" class="block" />
      </div>

      <div v-if="form.imagePreview" class="mt-2">
        <img :src="form.imagePreview" alt="Preview" class="w-40 rounded shadow" />
      </div>

      <button type="submit" :disabled="form.processing"
        class="bg-primary text-white px-4 py-2 rounded hover:bg-secondary">
        Télécharger
      </button>
    </form>

    <!-- Gallery List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <div
        v-for="item in media"
        :key="item.id"
        class="bg-[#1e1e1e] border border-primary rounded-lg shadow overflow-hidden relative"
    >
        <!-- Image preview with fixed aspect ratio -->
        <div class="aspect-video overflow-hidden">
        <img
            :src="`/storage/${item.image.replace(/^\/+/, '')}`"
            :alt="item.title"
            class="w-full h-full object-cover"
        />
        </div>

        <!-- Title -->
        <p class="px-4 py-2 text-white text-sm truncate">
        {{ item.title || 'Sans titre' }}
        </p>

        <!-- Delete button -->
        <button
        @click="destroy(item.id)"
        class="absolute top-2 right-2 bg-white hover:bg-red-100 text-red-600 border border-red-600 text-xs px-2 py-1 rounded"
        >
        Supprimer
        </button>
    </div>
    </div>

  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import { router } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
  media: Array,
})
console.log('media:', props.media)
const form = useForm({
  title: '',
  image: null,
  imagePreview: null,
})

function handleFileChange(event) {
  const file = event.target.files[0]
  if (file) {
    form.image = file
    form.imagePreview = URL.createObjectURL(file)
  }
}

function submit() {
  const payload = new FormData()
  payload.append('title', form.title)
  payload.append('image', form.image)

  router.post(route('admin.gallery.store'), payload, {
    forceFormData: true,
    onSuccess: () => {
      form.reset()
      form.imagePreview = null
      router.reload({ only: ['media'] })
    }
  })
}


function destroy(id) {
  if (confirm('Are you sure you want to delete this image?')) {
    router.delete(route('admin.gallery.destroy', id))
  }
}
</script>
