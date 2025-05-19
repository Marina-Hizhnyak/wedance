<script setup>

import { useForm, router } from '@inertiajs/vue3'
import { ref, nextTick } from 'vue'

// Props from parent
const props = defineProps({
  teamMembers: Array,
  users: Array,
})

// Selected team member for editing or creating
const selected = ref(null)

// Image previews
const photoPreview = ref(null)
const avatarPreview = ref(null)

const formSection = ref(null)

// Form object using Inertia useForm (for automatic handling of errors and processing)
const form = useForm({
  role: '',
  description: '',
  quote: '',
  telegram_url: '',
  whatsapp_url: '',
  vk_url: '',
  photo: null,
  avatar: null,
  user_id: '',
})

// Set form values from an existing member
function selectMember(member) {
  selected.value = member
  form.reset()

  form.role = member.role || ''
  form.description = member.description || ''
  form.quote = member.quote || ''
  form.telegram_url = member.telegram_url || ''
  form.whatsapp_url = member.whatsapp_url || ''
  form.vk_url = member.vk_url || ''
  form.user_id = member.user_id || ''
  form.photo = null
  form.avatar = null

  photoPreview.value = null
  avatarPreview.value = null

  // Smooth scroll to the form
  nextTick(() => {
    formSection.value?.scrollIntoView({ behavior: 'smooth' })
  })
}


// Handle file input and preview
function handleFileChange(event, field) {
  const file = event.target.files[0]
  if (!file) return

  form[field] = file

  const reader = new FileReader()
  reader.onload = (e) => {
    if (field === 'photo') photoPreview.value = e.target.result
    if (field === 'avatar') avatarPreview.value = e.target.result
  }
  reader.readAsDataURL(file)
}

// Submit form using router.post and FormData (for file upload support)
function submit() {
  if (!selected.value) return

  const isNew = !selected.value.id
  const url = isNew ? '/admin/team' : `/admin/team/${selected.value.id}`

  const formData = new FormData()

  if (!isNew) {
    formData.append('_method', 'PUT')
  }

  for (const key in form) {
    if (form[key] !== null && key !== 'imagePreview') {
      formData.append(key, form[key])
    }
  }

  router.post(url, formData, {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => {
      form.reset()
      selected.value = null
      photoPreview.value = null
      avatarPreview.value = null
    },
  })
}



// Delete a team member
function deleteMember(id) {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce membre ?")) {
    router.delete(`/admin/team/${id}`, {
      preserveScroll: true,
    })
  }
}
</script>


<template>
  <div>
    <h2 class="text-2xl font-bold mb-4">👨‍🏫 Profils des enseignants</h2>

    <!-- Add New Member Button -->
    <button @click="selectMember({})" class="px-4 py-2 mb-4 bg-primary text-black rounded hover:bg-secondary">
    ➕ Ajouter un membre
    </button>

    <!-- Members Table -->
    <table class="w-full text-sm text-left border border-primary rounded overflow-hidden mb-6">
      <thead class="bg-[#1f1f1f] text-white">
        <tr>
          <th class="px-4 py-2 border-b border-primary">Nom</th>
          <th class="px-4 py-2 border-b border-primary">Rôle</th>
          <th class="px-4 py-2 border-b border-primary">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="member in teamMembers" :key="member.id" class="border-b border-[#333]">
          <td class="px-4 py-2">{{ member.user?.name || '—' }}</td>
          <td class="px-4 py-2">{{ member.role }}</td>
          <td class="px-4 py-2">
            <!-- Edit Button -->
            <button @click="selectMember(member)" class="text-yellow-400 hover:underline">✏️ Modifier</button>
            <!-- Delete Button -->
            <button @click="deleteMember(member.id)" class="text-red-500 hover:underline ml-2">🗑 Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Member Form -->
    <div v-if="selected" ref="formSection" class="bg-[#1e1e1e] p-6 rounded border border-primary max-w-xl">
      <h3 class="text-xl font-bold text-primary mb-4">
        {{ selected.id ? `Modifier le profil de ${selected.user?.name || ''}` : 'Ajouter un membre' }}
      </h3>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
            <label class="block text-sm mb-1">Utilisateur associé</label>
            <select v-model="form.user_id" class="w-full bg-white/10 border border-white/20 p-2 rounded">
                <option value="">-- Aucun --</option>
                <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.name }}
                </option>
            </select>
        </div>
        <div>
          <label class="block text-sm mb-1">Rôle</label>
          <input v-model="form.role" type="text" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
        </div>

        <div>
          <label class="block text-sm mb-1">Description</label>
          <textarea v-model="form.description" class="w-full bg-white/10 border border-white/20 p-2 rounded"></textarea>
        </div>

        <div>
          <label class="block text-sm mb-1">Citation</label>
          <input v-model="form.quote" type="text" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
        </div>

        <div>
            <label class="block text-sm mb-1">Photo</label>
            <input type="file" @change="handleFileChange($event, 'photo')" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
            <img v-if="photoPreview" :src="photoPreview" class="mt-2 h-24 rounded border border-white/20 object-cover" />
        </div>

        <div>
            <label class="block text-sm mb-1">Avatar</label>
            <input type="file" @change="handleFileChange($event, 'avatar')" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
            <img v-if="avatarPreview" :src="avatarPreview" class="mt-2 h-24 rounded border border-white/20 object-cover" />
        </div>

        <div>
          <label class="block text-sm mb-1">Telegram</label>
          <input v-model="form.telegram_url" type="url" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
        </div>

        <div>
          <label class="block text-sm mb-1">WhatsApp</label>
          <input v-model="form.whatsapp_url" type="url" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
        </div>

        <div>
          <label class="block text-sm mb-1">VK</label>
          <input v-model="form.vk_url" type="url" class="w-full bg-white/10 border border-white/20 p-2 rounded" />
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-4">
          <button type="submit" class="px-6 py-2 bg-primary text-black rounded hover:bg-secondary">💾 Enregistrer</button>
          <button type="button" @click="selected = null" class="px-4 py-2 border border-white/20 rounded hover:bg-white/10">✖️ Annuler</button>
        </div>
      </form>
    </div>
  </div>
</template>
