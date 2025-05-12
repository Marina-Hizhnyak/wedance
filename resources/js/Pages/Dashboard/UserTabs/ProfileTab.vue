<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const user = computed(() => usePage().props.user)

// Get props from parent (Inertia page)
const props = defineProps({
  user: Object
})

// Setup edit state and form data
const isEditing = ref(false)

const form = ref({
  name: props.user.name,
  email: props.user.email
})

const previewPhoto = ref(null)

// Format date for display
const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric'
  })
}

// Save profile changes
const saveProfile = () => {
  const payload = new FormData()
  payload.append('_method', 'put')
  payload.append('name', form.value.name)
  payload.append('email', form.value.email)
  if (form.value.photo) {
    payload.append('photo', form.value.photo)
  }

  router.post('/dashboard/profile', payload, {
    preserveScroll: true,
    forceFormData: true,
    onSuccess: () => {
      isEditing.value = false
      previewPhoto.value = null


      // ✅ Reload user props from server
      router.reload({
        only: ['user'],
        preserveScroll: true
      })
    }
  })
}

// Handle photo preview before upload
const handlePhotoChange = (event) => {
  const file = event.target.files[0]
  if (file) {
    form.value.photo = file
    previewPhoto.value = URL.createObjectURL(file)
  }
}
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-12">Welcome, {{ user.name }}</h1>

    <!-- User profile info -->
    <div class="flex items-center space-x-6 mb-6">
      <!-- Profile photo -->
      <img
        v-if="user.profile_photo_url"
        :src="user.profile_photo_url"
        alt="Profile photo"
        class="w-24 h-24 rounded-full border-2 border-primary"
      />

      <div>
        <p class="text-lg m-4"><strong>Email:</strong> {{ user.email }}</p>
        <p class="text-lg m-4"><strong>Joined:</strong> {{ formatDate(user.created_at) }}</p>
      </div>
    </div>

    <!-- Edit button -->
    <div v-if="!isEditing">
      <button
        @click="isEditing = true"
        class="px-5 py-2 bg-primary text-black font-bold rounded-full hover:bg-secondary transition mt-12"
      >
        Edit Profile
      </button>
    </div>

    <!-- Edit form -->
    <div v-else class="space-y-4" enctype="multipart/form-data">
      <div>
        <label class="block mb-1 text-sm">Name</label>
        <input v-model="form.name" type="text" class="w-[30%] px-4 py-2 rounded bg-background border" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Email</label>
        <input v-model="form.email" type="email" class="w-[30%] px-4 py-2 rounded bg-background border" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Profile Photo</label>
        <input type="file" @change="handlePhotoChange" class="w-[30%] px-4 py-2 rounded bg-background border" />
        <img
          v-if="previewPhoto"
          :src="previewPhoto"
          alt="Photo preview"
          class="w-24 h-24 rounded-full border-2 border-primary"
        />
        <img
          v-else-if="user.profile_photo_url"
          :src="user.profile_photo_url"
          alt="Profile photo"
          class="w-24 h-24 rounded-full border-2 border-primary"
        />
      </div>

      <div class="flex space-x-4 mt-4">
        <button
          @click="saveProfile"
          class="px-5 py-2 bg-primary text-black font-bold rounded-full hover:bg-secondary transition"
        >
          Save
        </button>
        <button
          @click="isEditing = false"
          class="px-5 py-2 bg-gray-600 text-white font-bold rounded-full hover:bg-gray-400 transition"
        >
          Cancel
        </button>
      </div>
    </div>
  </div>
</template>

