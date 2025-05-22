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
    <h2 class="text-3xl font-bold text-primary mb-4">Profils des enseignants</h2>

    <!-- Add New Member Button -->
    <div class="flex justify-end mb-4">
      <button @click="selectMember({})" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
        ➕ Ajouter un membre
      </button>
    </div>

    <!-- Members Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-white text-left">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Nom</th>
            <th class="px-4 py-2 border-b border-primary">Rôle</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(member, index) in teamMembers"
            :key="member.id"
            :class="[
              'text-gray-100 hover:bg-[#2a2a2a]',
              index === teamMembers.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
            ]"
          >
            <td class="px-4 py-2">{{ member.user?.name || '—' }}</td>
            <td class="px-4 py-2">{{ member.role }}</td>
            <td class="px-4 py-2 space-x-2">
              <button @click="selectMember(member)" class="px-3 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary">
                Modifier
              </button>
              <button @click="deleteMember(member.id)" class="px-3 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-red-500">
                Supprimer
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Member Form -->
    <div v-if="selected" ref="formSection" class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10">
      <h3 class="text-xl font-bold text-primary mb-4">
        {{ selected.id ? `Modifier le profil de ${selected.user?.name || ''}` : 'Ajouter un membre' }}
      </h3>

      <form @submit.prevent="submit" class="space-y-4">
        <div>
          <label class="block text-sm mb-1">Utilisateur associé</label>
          <select v-model="form.user_id" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
            <option value="">-- Aucun --</option>
            <option v-for="user in users" :key="user.id" :value="user.id">{{ user.name }}</option>
          </select>
        </div>

        <div>
          <label class="block text-sm mb-1">Rôle</label>
          <input v-model="form.role" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
        </div>

        <div>
          <label class="block text-sm mb-1">Description</label>
          <textarea v-model="form.description" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary"></textarea>
        </div>

        <div>
          <label class="block text-sm mb-1">Citation</label>
          <input v-model="form.quote" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
        </div>

        <div>
          <label class="block text-sm mb-1">Photo</label>
          <input type="file" @change="handleFileChange($event, 'photo')" class="w-full px-4 py-2 rounded bg-background border text-white focus:outline-none focus:ring-0 focus:border-primary" />
          <img v-if="photoPreview" :src="photoPreview" class="mt-2 h-24 rounded border border-white/20 object-cover" />
        </div>

        <div>
          <label class="block text-sm mb-1">Avatar</label>
          <input type="file" @change="handleFileChange($event, 'avatar')" class="w-full px-4 py-2 rounded bg-background border text-white focus:outline-none focus:ring-0 focus:border-primary" />
          <img v-if="avatarPreview" :src="avatarPreview" class="mt-2 h-24 rounded border border-white/20 object-cover" />
        </div>

        <div>
          <label class="block text-sm mb-1">Telegram</label>
          <input v-model="form.telegram_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
        </div>

        <div>
          <label class="block text-sm mb-1">WhatsApp</label>
          <input v-model="form.whatsapp_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
        </div>

        <div>
          <label class="block text-sm mb-1">VK</label>
          <input v-model="form.vk_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-4 mt-4">
          <button type="submit" class="px-5 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
            💾 Enregistrer
          </button>
          <button type="button" @click="selected = null" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-400">
            ✖️ Annuler
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

