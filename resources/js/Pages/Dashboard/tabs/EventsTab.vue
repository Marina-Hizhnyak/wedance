<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Événements</h1>

    <!-- Bouton Ajouter -->
    <div class="flex justify-end mb-4">
      <button
        @click="openCreateForm"
        class="px-4 py-2 bg-primary text-background font-bold rounded hover:bg-green-500"
      >
        ➕ Ajouter un événement
      </button>
    </div>

    <!-- Tableau -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Titre</th>
            <th class="px-4 py-2 border-b border-primary">Date</th>
            <th class="px-4 py-2 border-b border-primary">Lieu</th>
            <th class="px-4 py-2 border-b border-primary">Organisateur</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="event in events" :key="event.id" class="hover:bg-[#2a2a2a] text-gray-100">
            <td class="px-4 py-2 border-b border-[#333]">{{ event.title }}</td>
            <td class="px-4 py-2 border-b border-[#333]">{{ formatDate(event.date) }}</td>
            <td class="px-4 py-2 border-b border-[#333]">{{ event.location }}</td>
            <td class="px-4 py-2 border-b border-[#333]">{{ event.organizer?.name || '—' }}</td>
            <td class="px-4 py-2 border-b border-[#333] space-x-2">
              <button @click="editEvent(event)" class="px-3 py-1 text-sm font-bold bg-yellow-500 text-black rounded hover:bg-yellow-400">Éditer</button>
              <button @click="deleteEvent(event.id)" class="px-3 py-1 text-sm font-bold bg-red-600 text-white rounded hover:bg-red-500">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Formulaire -->
    <div v-if="isCreating || isEditing" class="bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10">
      <h2 class="text-xl font-bold mb-4 text-primary">{{ isEditing ? 'Modifier' : 'Ajouter' }} un événement</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Titre</label>
        <input v-model="form.title" type="text" class="w-full px-4 py-2 rounded bg-background border" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Description</label>
        <textarea v-model="form.description" class="w-full px-4 py-2 rounded bg-background border"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Date</label>
        <input v-model="form.date" type="datetime-local" class="w-full px-4 py-2 rounded bg-background border" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Lieu</label>
        <input v-model="form.location" type="text" class="w-full px-4 py-2 rounded bg-background border" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Organisateur</label>
        <select v-model="form.organizer_id" class="w-full px-4 py-2 rounded bg-background border">
          <option :value="null">—</option>
          <option v-for="user in organizers" :key="user.id" :value="user.id">
            {{ user.name }}
          </option>
        </select>
      </div>

      <div class="flex justify-end space-x-4">
        <button @click="cancelForm" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">Annuler</button>
        <button @click="saveEvent" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
          {{ isEditing ? 'Enregistrer' : 'Créer' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  events: Array,
  organizers: Array,
})

const isCreating = ref(false)
const isEditing = ref(false)

const form = ref({
  id: null,
  title: '',
  description: '',
  date: '',
  location: '',
  organizer_id: null,
})

const resetForm = () => {
  form.value = {
    id: null,
    title: '',
    description: '',
    date: '',
    location: '',
    organizer_id: null,
  }
}

const openCreateForm = () => {
  resetForm()
  isCreating.value = true
  isEditing.value = false
}

const editEvent = (event) => {
  form.value = { ...event }
  isCreating.value = false
  isEditing.value = true
}

const cancelForm = () => {
  resetForm()
  isCreating.value = false
  isEditing.value = false
}

const saveEvent = () => {
  const data = { ...form.value }

  if (isEditing.value) {
    router.put(`/admin/events/${form.value.id}`, data, {
      preserveScroll: true,
      onSuccess: cancelForm,
    })
  } else {
    router.post('/admin/events', data, {
      preserveScroll: true,
      onSuccess: cancelForm,
    })
  }
}

const deleteEvent = (id) => {
  if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
    router.delete(`/admin/events/${id}`, {
      preserveScroll: true,
    })
  }
}

const formatDate = (dateStr) => {
  const date = new Date(dateStr)
  return date.toLocaleString('fr-FR', {
    weekday: 'short',
    day: '2-digit',
    month: 'short',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit',
  })
}
</script>

