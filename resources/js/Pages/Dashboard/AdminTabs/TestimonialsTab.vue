<template>
  <div>
    <h2 class="text-3xl font-bold text-primary mb-4">Témoignages</h2>

    <!-- Tableau des témoignages -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-white text-left">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Utilisateur</th>
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
            <td class="px-4 py-2">
              <div class="flex items-center space-x-2">
                <img v-if="t.avatar" :src="'/storage/' + t.avatar" class="w-10 h-10 rounded-full" />
                <span>{{ t.user?.name || '—' }}</span>
              </div>
            </td>
            <td class="px-4 py-2">{{ t.content }}</td>
            <td class="px-4 py-2">{{ t.position }}</td>
            <td class="px-4 py-2">{{ t.rating }}/5</td>
            <td class="px-4 py-2 space-x-2">
              <button @click="editTestimonial(t)" class="px-3 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary">Modifier</button>
              <button @click="destroy(t.id)" class="px-3 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-red-500">Supprimer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Formulaire d'édition -->
    <form
      v-if="showForm"
      ref="testimonialFormSection"
      @submit.prevent="submit"
      class="scroll-mt-36 bg-[#1e1e1e] p-6 rounded-lg border border-primary max-w-xl"
    >
      <h3 class="text-xl font-bold text-primary mb-4">Modifier le témoignage</h3>

      <div class="mb-4">
        <label class="block text-sm mb-1">Position</label>
        <input v-model="form.position" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" type="text" />
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Témoignage</label>
        <textarea v-model="form.content" rows="4" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary"></textarea>
      </div>

      <div class="mb-4">
        <label class="block text-sm mb-1">Note</label>
        <input v-model="form.rating" type="number" min="1" max="5" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="flex justify-end space-x-4">
        <button type="submit" class="px-5 py-2 bg-primary text-black font-bold rounded hover:bg-secondary">Mettre à jour</button>
        <button type="button" @click="cancel" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-400">Annuler</button>
      </div>
    </form>
  </div>
</template>


<script setup>
import { ref, nextTick } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps({
  testimonials: Array,
})

const showForm = ref(false)
const testimonialFormSection = ref(null)

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

  nextTick(() => {
    testimonialFormSection.value?.scrollIntoView({ behavior: 'smooth', block: 'start' })
  })
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

