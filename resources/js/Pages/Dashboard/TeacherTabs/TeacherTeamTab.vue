<script setup>
import { ref, computed } from 'vue'
import { useForm, router } from '@inertiajs/vue3'

const props = defineProps({
  teamMember: Object
})

const editing = ref(!props.teamMember)
const formSection = ref(null)

const form = useForm({
  role: props.teamMember?.role || '',
  description: props.teamMember?.description || '',
  quote: props.teamMember?.quote || '',
  telegram_url: props.teamMember?.telegram_url || '',
  whatsapp_url: props.teamMember?.whatsapp_url || '',
  vk_url: props.teamMember?.vk_url || '',
  photo: null,
  avatar: null,
})

const previewPhoto = ref(null)
const previewAvatar = ref(null)

const isNew = computed(() => !props.teamMember?.id)

function handleFileChange(event, field) {
  const file = event.target.files[0]
  if (file) {
    form[field] = file
    const reader = new FileReader()
    reader.onload = (e) => {
      if (field === 'photo') previewPhoto.value = e.target.result
      if (field === 'avatar') previewAvatar.value = e.target.result
    }
    reader.readAsDataURL(file)
  }
}

function submit() {
  const payload = new FormData()
  for (const key in form) {
    if (form[key] !== null) {
      payload.append(key, form[key])
    }
  }

  const routeUrl = isNew.value ? '/teacher/my-profile' : '/teacher/my-profile'
  if (!isNew.value) {
    payload.append('_method', 'PUT')
  }

  router.post(routeUrl, payload, {
    forceFormData: true,
    preserveScroll: true,
    onSuccess: () => editing.value = false
  })
}
</script>

<template>
  <div class="max-w-xl space-y-6">
    <h2 class="text-2xl font-bold">
      💼 {{ isNew ? 'Créer mon profil' : 'Profil de l\'équipe' }}
    </h2>

    <!-- Affichage -->
    <div v-if="!editing" class="space-y-3">
      <p><strong>Rôle :</strong> {{ form.role }}</p>
      <p><strong>Description :</strong> {{ form.description }}</p>
      <p><strong>Citation :</strong> <em>{{ form.quote }}</em></p>

      <div class="space-y-2 text-sm mt-4">
        <div v-if="props.teamMember?.photo">
          <strong>Photo :</strong><br />
          <img :src="`/storage/${props.teamMember.photo}`" class="h-20 rounded border" />
        </div>
        <div v-if="props.teamMember?.avatar">
          <strong>Avatar :</strong><br />
          <img :src="`/storage/${props.teamMember.avatar}`" class="h-20 rounded-full border" />
        </div>
        <div v-if="form.telegram_url">
          <strong>Telegram :</strong>
          <a :href="form.telegram_url" class="text-primary underline" target="_blank">{{ form.telegram_url }}</a>
        </div>
        <div v-if="form.whatsapp_url">
          <strong>WhatsApp :</strong>
          <a :href="form.whatsapp_url" class="text-primary underline" target="_blank">{{ form.whatsapp_url }}</a>
        </div>
        <div v-if="form.vk_url">
          <strong>VK :</strong>
          <a :href="form.vk_url" class="text-primary underline" target="_blank">{{ form.vk_url }}</a>
        </div>
      </div>

      <button @click="editing = true" class="mt-4 px-4 py-2 bg-primary text-black font-semibold rounded hover:bg-secondary">
         {{ isNew ? 'Créer mon profil' : 'Modifier' }}
      </button>
    </div>

    <!-- Formulaire -->
    <form v-else @submit.prevent="submit" ref="formSection" class="space-y-4 bg-[#1e1e1e] p-6 rounded-lg border border-primary scroll-mt-36">
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

      <!-- Upload photo -->
      <div>
        <label class="block text-sm mb-1">Photo</label>
        <input type="file" @change="e => handleFileChange(e, 'photo')" class="w-full px-4 py-2 rounded bg-background border text-white" />
        <div v-if="previewPhoto" class="mt-2">
          <img :src="previewPhoto" class="h-20 rounded border" />
        </div>
      </div>

      <!-- Upload avatar -->
      <div>
        <label class="block text-sm mb-1">Avatar</label>
        <input type="file" @change="e => handleFileChange(e, 'avatar')" class="w-full px-4 py-2 rounded bg-background border text-white" />
        <div v-if="previewAvatar" class="mt-2">
          <img :src="previewAvatar" class="h-20 rounded-full border" />
        </div>
      </div>

      <div>
        <label class="block text-sm mb-1">Lien Telegram</label>
        <input v-model="form.telegram_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div>
        <label class="block text-sm mb-1">Lien WhatsApp</label>
        <input v-model="form.whatsapp_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div>
        <label class="block text-sm mb-1">Lien VK</label>
        <input v-model="form.vk_url" type="url" class="w-full px-4 py-2 rounded bg-background border focus:outline-none focus:ring-0 focus:border-primary" />
      </div>

      <div class="flex gap-4 mt-4">
        <button type="submit" class="px-6 py-2 bg-primary text-black rounded hover:bg-secondary">
          Enregistrer
        </button>
        <button type="button" @click="editing = false" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-400">
          ✖️ Annuler
        </button>
      </div>
    </form>
  </div>
</template>
