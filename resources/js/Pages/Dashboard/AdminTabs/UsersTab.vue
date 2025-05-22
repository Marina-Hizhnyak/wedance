<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Utilisateurs</h1>

    <!-- Add user button -->
    <div class="flex justify-end mb-4">
      <button
        @click="openCreateForm"
        class="px-4 py-2 bg-primary text-background font-bold rounded hover:bg-secondary"
      >
        ➕ Ajouter un utilisateur
      </button>
    </div>

    <!-- Users table -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Nom</th>
            <th class="px-4 py-2 border-b border-primary">Email</th>
            <th class="px-4 py-2 border-b border-primary">Inscription</th>
            <th class="px-4 py-2 border-b border-primary">Rôle</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(u, index) in users"
            :key="u.id"
            :class="[
              'hover:bg-[#2a2a2a] text-gray-100',
              index === users.length - 1 ? '' : 'border-b border-[#333]'
            ]"
          >
            <td class="px-4 py-2">{{ u.name }}</td>
            <td class="px-4 py-2">{{ u.email }}</td>
            <td class="px-4 py-2">{{ formatDate(u.created_at) }}</td>
            <td class="px-4 py-2 capitalize">{{ u.role }}</td>
            <td class="px-4 py-2 space-x-2">
              <button @click="editUser(u)" class="px-3 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary">Éditer</button>
              <button @click="deleteUser(u.id)" class="px-3 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-secondary">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Create User Form -->
    <form
      v-if="isCreating"
      ref="createFormSection"
      @submit.prevent="storeUser"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl mb-10"
    >
      <h2 class="text-xl font-bold mb-4 text-primary">Ajouter un utilisateur</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Nom</label>
        <input v-model="createForm.name" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Email</label>
        <input v-model="createForm.email" type="email" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Mot de passe</label>
        <input v-model="createForm.password" type="password" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Rôle</label>
        <select v-model="createForm.role" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary">
          <option value="user">Utilisateur</option>
          <option value="teacher">Enseignant</option>
          <option value="admin">Administrateur</option>
        </select>
      </div>

      <div class="flex justify-end space-x-4">
        <button type="button" @click="cancelCreate" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">Annuler</button>
        <button type="submit" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">Créer</button>
      </div>
    </form>

    <!-- Edit User Form -->
    <div
      v-if="isEditing"
      ref="editFormSection"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl"
    >
      <h2 class="text-xl font-bold mb-4 text-primary">Modifier l'utilisateur</h2>

      <div class="mb-4">
        <label class="block text-sm mb-1">Nom</label>
        <input v-model="editForm.name" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Email</label>
        <input v-model="editForm.email" type="email" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Rôle</label>
        <select v-model="editForm.role" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0">
          <option value="user">Utilisateur</option>
          <option value="teacher">Enseignant</option>
          <option value="admin">Administrateur</option>
        </select>
      </div>

      <div class="flex justify-end space-x-4">
        <button @click="closeEditModal" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">Annuler</button>
        <button @click="saveUser" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">Enregistrer</button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, nextTick } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  users: Array,
  user: Object,
})

const isCreating = ref(false)
const isEditing = ref(false)
const createFormSection = ref(null)
const editFormSection = ref(null)

const createForm = ref({
  name: '',
  email: '',
  password: '',
  role: 'user',
})

const editForm = ref({
  id: null,
  name: '',
  email: '',
  role: 'user',
})

const openCreateForm = () => {
  isCreating.value = true
  nextTick(() => {
    createFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const cancelCreate = () => {
  isCreating.value = false
  createForm.value = {
    name: '',
    email: '',
    password: '',
    role: 'user',
  }
}

const editUser = (user) => {
  isEditing.value = true
  editForm.value = {
    id: user.id,
    name: user.name,
    email: user.email,
    role: user.role || 'user',
  }
  nextTick(() => {
    editFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const closeEditModal = () => {
  isEditing.value = false
}

const storeUser = () => {
  router.post('/admin/users', createForm.value, {
    preserveScroll: true,
    onSuccess: cancelCreate,
  })
}

const saveUser = () => {
  router.put(`/admin/users/${editForm.value.id}`, editForm.value, {
    preserveScroll: true,
    onSuccess: closeEditModal,
  })
}

const deleteUser = (id) => {
  if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
    router.delete(`/admin/users/${id}`, {
      preserveScroll: true,
    })
  }
}

const formatDate = (date) => {
  return new Date(date).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
  })
}
</script>
