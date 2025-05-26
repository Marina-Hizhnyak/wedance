<template>
  <div>
    <h2 class="text-3xl font-bold text-primary mb-4">Mes témoignages</h2>

    <!-- Bouton -->
    <div class="flex justify-end mb-4">
      <button @click="openForm" class="px-4 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
        ➕ Ajouter un témoignage
      </button>
    </div>

    <!-- Liste des témoignages -->
    <div class="overflow-x-auto">
      <table v-if="testimonials.length" class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Contenu</th>
            <th class="px-4 py-2 border-b border-primary">Position</th>
            <th class="px-4 py-2 border-b border-primary">Note</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(t, index) in testimonials"
            :key="t.id"
            :class="[
              'text-gray-100 hover:bg-[#2a2a2a]',
              index === testimonials.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
            ]"
          >
            <td class="px-4 py-2">{{ t.content }}</td>
            <td class="px-4 py-2">{{ t.position }}</td>
            <td class="px-4 py-2">{{ t.rating }}/5</td>
            <td class="px-2 py-2 space-x-2">
              <button @click="editTestimonial(t)" class="px-2 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary">Modifier</button>
              <button @click="destroy(t.id)" class="px-2 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-red-500">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Formulaire -->
    <form
      v-if="showForm"
      ref="formSection"
      @submit.prevent="submit"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl"
    >
      <h3 class="text-xl font-bold text-primary mb-4">
        {{ form.id ? 'Modifier le témoignage' : 'Ajouter un témoignage' }}
      </h3>

      <div class="mb-4">
        <label class="block text-sm mb-1">Position</label>
        <input v-model="form.position" type="text" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Témoignage</label>
        <textarea v-model="form.content" rows="4" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Note</label>
        <input v-model="form.rating" type="number" min="1" max="5" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Avatar</label>
        <input type="file" @change="handleFile" class="w-full px-4 py-2 rounded bg-background border text-white focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="flex justify-end space-x-4">
        <button type="submit" class="px-5 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">
          {{ form.id ? 'Mettre à jour' : 'Envoyer' }}
        </button>
        <button type="button" @click="cancel" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-400">Annuler</button>
      </div>
    </form>
  </div>
</template>


<script setup>
import { ref, computed, nextTick } from 'vue'
import { useForm, router, usePage } from '@inertiajs/vue3'

const testimonials = computed(() => usePage().props.user.testimonials || [])

const showForm = ref(false)
const avatarFile = ref(null)
const formSection = ref(null)

const form = useForm({
  id: null,
  position: '',
  content: '',
  rating: 5,
  avatar: null,
})

const handleFile = (e) => {
  avatarFile.value = e.target.files[0]
}

const openForm = () => {
  showForm.value = true
  nextTick(() => {
    formSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const submit = () => {
  const formData = new FormData()
  formData.append('content', form.content)
  formData.append('position', form.position)
  formData.append('rating', form.rating)
  if (avatarFile.value) {
    formData.append('avatar', avatarFile.value)
  }

  if (form.id) {
    formData.append('_method', 'PUT')
    router.post(route('testimonials.update', form.id), formData, {
      forceFormData: true,
      preserveScroll: true,
      onSuccess: () => {
        reset()
        reload()
      }
    })
  } else {
    router.post(route('testimonials.store'), formData, {
      forceFormData: true,
      preserveScroll: true,
      onSuccess: () => {
        reset()
        reload()
      }
    })
  }
}

const editTestimonial = (t) => {
  form.id = t.id
  form.content = t.content
  form.position = t.position
  form.rating = t.rating
  showForm.value = true
  nextTick(() => {
    formSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
}

const reset = () => {
  form.reset()
  form.id = null
  avatarFile.value = null
  showForm.value = false
}

const cancel = () => {
  reset()
}

const destroy = (id) => {
  if (confirm('Supprimer ce témoignage ?')) {
    router.delete(route('testimonials.destroy', id), {
      onSuccess: () => reload()
    })
  }
}

const reload = () => {
  router.reload({ only: ['user'] })
}
</script>

