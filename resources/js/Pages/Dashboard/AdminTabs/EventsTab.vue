<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Événements</h1>

    <!-- Bouton Ajouter -->
    <div class="flex justify-end mb-4">
      <button
        @click="openCreateForm"
        class="px-4 py-2 bg-primary text-background font-bold rounded hover:bg-secondary"
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
          <tr
            v-for="(event, index) in events"
            :key="event.id"
            :class="[
              'hover:bg-[#2a2a2a] text-gray-100',
              index === events.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
            ]"
          >
            <td class="px-4 py-2">{{ event.title }}</td>
            <td class="px-4 py-2">{{ formatDate(event.date) }}</td>
            <td class="px-4 py-2">{{ event.location }}</td>
            <td class="px-4 py-2">{{ event.organizer?.name || '—' }}</td>
            <td class="px-4 py-2 space-x-2">
              <button @click="editEvent(event)" class="px-3 py-1 text-sm font-bold bg-yellow-500 text-black rounded hover:bg-yellow-400">Éditer</button>
              <button @click="deleteEvent(event.id)" class="px-3 py-1 text-sm font-bold bg-red-600 text-white rounded hover:bg-red-500">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Formulaire -->
    <div
      v-if="isCreating || isEditing"
      ref="eventFormSection"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10"
    >
      <h2 class="text-xl font-bold mb-4 text-primary">{{ isEditing ? 'Modifier' : 'Ajouter' }} un événement</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Titre</label>
        <input v-model="form.title" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Description</label>
        <textarea v-model="form.description" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Date</label>
        <input v-model="form.date" type="datetime-local" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Lieu</label>
        <input v-model="form.location" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Organisateur</label>
        <select v-model="form.organizer_id" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
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
import { ref, nextTick } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps({
  events: Array,
  organizers: Array,
})

const isCreating = ref(false)
const isEditing = ref(false)
const eventFormSection = ref(null)

const form = useForm({
  id: null,
  title: '',
  description: '',
  date: '',
  location: '',
  organizer_id: null,
})

const resetForm = () => {
  form.reset()
  form.clearErrors()
  form.id = null
}

const openCreateForm = () => {
  resetForm()
  isCreating.value = true
  isEditing.value = false
  nextTick(() => {
    eventFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const editEvent = (event) => {
  form.id = event.id
  form.title = event.title
  form.description = event.description
  form.date = event.date
  form.location = event.location
  form.organizer_id = event.organizer_id
  isCreating.value = false
  isEditing.value = true
  nextTick(() => {
    eventFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const cancelForm = () => {
  resetForm()
  isCreating.value = false
  isEditing.value = false
}

const saveEvent = () => {
  if (isEditing.value) {
    form.put(route('admin.events.update', form.id), {
      preserveScroll: true,
      onSuccess: cancelForm
    })
  } else {
    form.post(route('admin.events.store'), {
      preserveScroll: true,
      onSuccess: cancelForm
    })
  }
}

const deleteEvent = (id) => {
  if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
    router.delete(route('admin.events.destroy', id), {
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



