<template>
<pre>{{  props }}</pre>
  <div class="space-y-6">
    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-bold text-primary">Mes témoignages</h2>
      <button @click="showForm = true" class="bg-primary text-black px-4 py-2 rounded hover:bg-secondary">
        ➕ Ajouter un témoignage
      </button>
    </div>

    <!-- Liste des témoignages -->
    <table v-if="testimonials.length" class="w-full text-left bg-gray-900 rounded">
      <thead class="bg-gray-800 text-gray-300">
        <tr>
          <th class="p-3">Contenu</th>
          <th class="p-3">Position</th>
          <th class="p-3">Note</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="t in testimonials" :key="t.id" class="border-t border-gray-700">
          <td class="p-3">{{ t.content }}</td>
          <td class="p-3">{{ t.position }}</td>
          <td class="p-3">{{ t.rating }}/5</td>
          <td class="p-3 space-x-2">
            <button @click="editTestimonial(t)" class="text-blue-400 hover:underline">Modifier</button>
            <button @click="destroy(t.id)" class="text-red-400 hover:underline">Supprimer</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Formulaire d'ajout/modification -->
    <form v-if="showForm" @submit.prevent="submit" class="bg-gray-800 p-6 rounded space-y-4">
      <h3 class="text-xl font-semibold text-white">
        {{ form.id ? 'Modifier le témoignage' : 'Ajouter un témoignage' }}
      </h3>

      <div>
        <label class="block">Position</label>
        <input v-model="form.position" class="w-full p-2 rounded bg-gray-700 text-white" type="text" />
      </div>

      <div>
        <label class="block">Témoignage</label>
        <textarea v-model="form.content" rows="4" class="w-full p-2 rounded bg-gray-700 text-white"></textarea>
      </div>

      <div>
        <label class="block">Note</label>
        <input v-model="form.rating" type="number" min="1" max="5" class="w-full p-2 rounded bg-gray-700 text-white" />
      </div>

      <div>
        <label class="block">Avatar</label>
        <input type="file" @change="handleFile" class="text-white" />
      </div>

      <div class="flex space-x-4">
        <button type="submit" class="bg-primary text-black px-4 py-2 rounded">
          {{ form.id ? 'Mettre à jour' : 'Envoyer' }}
        </button>
        <button type="button" @click="cancel" class="text-white underline">Annuler</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm, router, usePage } from '@inertiajs/vue3'

const testimonials = computed(() => usePage().props.user.testimonials || [])

const showForm = ref(false)
const avatarFile = ref(null)

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
