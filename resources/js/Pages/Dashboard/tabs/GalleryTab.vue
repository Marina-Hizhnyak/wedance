<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Gallery Manager</h1>

    <!-- Upload Form -->
    <form @submit.prevent="submit" class="mb-6 space-y-4" enctype="multipart/form-data">
      <div>
        <label class="block mb-1 font-semibold">Image title (optional):</label>
        <input v-model="form.title" type="text" class="w-full border rounded p-2" />
      </div>

      <div>
        <label class="block mb-1 font-semibold">Choose image:</label>
        <input type="file" @change="handleFileChange" accept="image/*" class="block" />
      </div>

      <div v-if="form.imagePreview" class="mt-2">
        <img :src="form.imagePreview" alt="Preview" class="w-40 rounded shadow" />
      </div>

      <button type="submit" :disabled="form.processing"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Upload
      </button>
    </form>

    <!-- Gallery List -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
      <div v-for="item in media" :key="item.id" class="border rounded p-2 shadow relative">
        <img :src="`/storage/${item.image}`" :alt="item.title" class="w-full h-48 object-cover rounded" />
        <p class="mt-2 text-sm text-gray-700">{{ item.title || 'Untitled' }}</p>
        <button @click="destroy(item.id)"
          class="absolute top-1 right-1 bg-white hover:bg-red-100 text-red-600 border border-red-600 text-xs px-2 py-1 rounded">
          Delete
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
      // 🔁 Обновить только media после загрузки
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
