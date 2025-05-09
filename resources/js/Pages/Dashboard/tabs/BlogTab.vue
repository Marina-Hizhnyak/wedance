<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Blog</h1>

    <!-- Add Post Button -->
    <div class="flex justify-end mb-4">
      <button
        @click="startCreating"
        class="px-4 py-2 bg-primary text-background font-bold rounded hover:bg-green-500"
      >
        ➕ Add a post
      </button>
    </div>

    <!-- Blog Posts Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Image</th>
            <th class="px-4 py-2 border-b border-primary">Title</th>
            <th class="px-4 py-2 border-b border-primary">Author</th>
            <th class="px-4 py-2 border-b border-primary">Date</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="post in posts"
            :key="post.id"
            class="hover:bg-[#2a2a2a] text-gray-100"
          >
            <td class="px-4 py-2 border-b border-[#333]">
              <img v-if="post.image" :src="`/storage/${post.image}`" class="w-20 h-14 object-cover rounded" />
            </td>
            <td class="px-4 py-2 border-b border-[#333]">{{ post.title }}</td>
            <td class="px-4 py-2 border-b border-[#333]">{{ post.author?.name }}</td>
            <td class="px-4 py-2 border-b border-[#333]">{{ formatDate(post.created_at) }}</td>
            <td class="px-4 py-2 border-b border-[#333] space-x-2">
              <button @click="edit(post)" class="px-3 py-1 text-sm font-bold bg-yellow-500 text-black rounded hover:bg-yellow-400">Edit</button>
              <button @click="destroy(post.id)" class="px-3 py-1 text-sm font-bold bg-red-600 text-white rounded hover:bg-red-500">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Create/Edit Post Form -->
    <div v-if="showForm" class="bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10">
      <h2 class="text-xl font-bold mb-4 text-primary">{{ editingPost ? 'Edit post' : 'Add new post' }}</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Title</label>
        <input v-model="form.title" type="text" class="w-full px-4 py-2 rounded bg-background border" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Content</label>
        <!-- <textarea v-model="form.content" rows="5" class="w-full px-4 py-2 rounded bg-background border"></textarea> -->
         <div class="mb-4">
  <label class="block text-sm mb-1">Content</label>
  <RichTextEditor v-model="form.content" />
</div>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Image (optional)</label>
        <input type="file" @change="handleFileChange" class="w-full px-4 py-2 rounded bg-background border text-white" />
        <div v-if="form.imagePreview" class="mt-2">
          <img :src="form.imagePreview" alt="Preview" class="h-24 object-cover rounded" />
        </div>
      </div>

      <div class="flex justify-end space-x-4">
        <button @click="cancel" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">Cancel</button>
        <button @click="submit" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
          {{ editingPost ? 'Update' : 'Create' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm, router } from '@inertiajs/vue3'
import { defineProps } from 'vue'
import RichTextEditor from '@/Components/RichTextEditor.vue'

const props = defineProps({
  posts: Array,
})

const showForm = ref(false)
const editingPost = ref(null)

const form = useForm({
  title: '',
  content: '',
  image: null,
  imagePreview: null,
})

function startCreating() {
  showForm.value = true
  editingPost.value = null
  form.reset()
  form.imagePreview = null
}

function edit(post) {
  showForm.value = true
  editingPost.value = post
  form.title = post.title
  form.content = post.content
  form.image = null
  form.imagePreview = post.image ? `/storage/${post.image}` : null
}

function cancel() {
  showForm.value = false
  editingPost.value = null
  form.reset()
  form.imagePreview = null
}

function handleFileChange(e) {
  const file = e.target.files[0]
  if (file) {
    form.image = file
    form.imagePreview = URL.createObjectURL(file)
  }
}

function submit() {
  const payload = new FormData()
  payload.append('title', form.title)
  payload.append('content', form.content)
  if (form.image) payload.append('image', form.image)

  if (editingPost.value) {
    router.post(route('admin.blog.update', editingPost.value.id), payload, {
      method: 'post',
      forceFormData: true,
      onSuccess: () => {
        cancel()
        router.reload({ only: ['posts'] })
      }
    })
  } else {
    router.post(route('admin.blog.store'), payload, {
      forceFormData: true,
      onSuccess: () => {
        cancel()
        router.reload({ only: ['posts'] })
      }
    })
  }
}

function destroy(id) {
  if (confirm('Are you sure you want to delete this post?')) {
    router.delete(route('admin.blog.destroy', id), {
      onSuccess: () => router.reload({ only: ['posts'] })
    })
  }
}

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString()
}
</script>

