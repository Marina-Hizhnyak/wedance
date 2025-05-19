<template>
  <div class="space-y-6">
    <h2 class="text-2xl font-bold text-primary">Tous les témoignages</h2>

    <table class="w-full text-left bg-gray-900 rounded">
      <thead class="bg-gray-800 text-gray-300">
        <tr>
          <th class="p-3">Utilisateur</th>
          <th class="p-3">Contenu</th>
          <th class="p-3">Position</th>
          <th class="p-3">Note</th>
          <th class="p-3">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="t in testimonials" :key="t.id" class="border-t border-gray-700">
          <td class="p-3">
            <div class="flex items-center space-x-2">
              <img v-if="t.avatar" :src="'/storage/' + t.avatar" class="w-10 h-10 rounded-full" />
              <span>{{ t.user?.name || '—' }}</span>
            </div>
          </td>
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

    <!-- Форма редактирования -->
    <form v-if="showForm" @submit.prevent="submit" class="bg-gray-800 p-6 rounded space-y-4">
      <h3 class="text-xl font-semibold text-white">Modifier le témoignage</h3>

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

      <div class="flex space-x-4">
        <button type="submit" class="bg-primary text-black px-4 py-2 rounded">Mettre à jour</button>
        <button type="button" @click="cancel" class="text-white underline">Annuler</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm, router, usePage } from '@inertiajs/vue3'

const props = defineProps({
  testimonials: Array,
})

const showForm = ref(false)
const form = useForm({
  id: null,
  content: '',
  position: '',
  rating: 5,
})

const editTestimonial = (t) => {
  form.id = t.id
  form.content = t.content
  form.position = t.position
  form.rating = t.rating
  showForm.value = true
}

const cancel = () => {
  form.reset()
  showForm.value = false
}

const submit = () => {
  router.post(route('admin.testimonials.update', form.id), {
    _method: 'PUT',
    content: form.content,
    position: form.position,
    rating: form.rating,
  }, {
    preserveScroll: true,
    onSuccess: () => {
      cancel()
      router.reload({ only: ['testimonials'] })
    }
  })
}

const destroy = (id) => {
  if (confirm('Supprimer ce témoignage ?')) {
    router.delete(route('admin.testimonials.destroy', id), {
      onSuccess: () => router.reload({ only: ['testimonials'] })
    })
  }
}
</script>
