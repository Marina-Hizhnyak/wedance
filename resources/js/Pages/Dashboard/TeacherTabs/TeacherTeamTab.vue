<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  teamMember: Object
})
import { ref } from 'vue'

const editing = ref(false)

const form = useForm({
  role: props.teamMember.role || '',
  description: props.teamMember.description || '',
  quote: props.teamMember.quote || '',
  telegram_url: props.teamMember.telegram_url || '',
  whatsapp_url: props.teamMember.whatsapp_url || '',
  vk_url: props.teamMember.vk_url || '',
})

function submit() {
  form.put('/teacher/my-profile')
}
</script>

<template>
  <div class="max-w-xl space-y-6">
    <h2 class="text-2xl font-bold">💼 Profil de l'équipe</h2>

    <!-- Affichage -->
    <div v-if="!editing" class="space-y-3">
      <p><strong>Rôle :</strong> {{ form.role }}</p>
      <p><strong>Description :</strong> {{ form.description }}</p>
      <p><strong>Citation :</strong> <em>{{ form.quote }}</em></p>

        <div class="space-y-2 mt-4 text-sm">
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


      <button @click="editing = true" class="mt-4 px-4 py-2 bg-primary text-black font-semibold rounded shadow hover:bg-secondary transition">
        ✏️ Modifier
      </button>
    </div>

    <!-- Formulaire de modification -->
    <form v-else @submit.prevent="submit" class="space-y-4">
      <div>
        <label class="block mb-1 text-sm">Rôle</label>
        <input v-model="form.role" type="text" class="w-full rounded p-2 bg-white/10 border border-white/20" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Description</label>
        <textarea v-model="form.description" class="w-full rounded p-2 bg-white/10 border border-white/20"></textarea>
      </div>

      <div>
        <label class="block mb-1 text-sm">Citation</label>
        <input v-model="form.quote" type="text" class="w-full rounded p-2 bg-white/10 border border-white/20" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Lien Telegram</label>
        <input v-model="form.telegram_url" type="url" class="w-full rounded p-2 bg-white/10 border border-white/20" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Lien WhatsApp</label>
        <input v-model="form.whatsapp_url" type="url" class="w-full rounded p-2 bg-white/10 border border-white/20" />
      </div>

      <div>
        <label class="block mb-1 text-sm">Lien VK</label>
        <input v-model="form.vk_url" type="url" class="w-full rounded p-2 bg-white/10 border border-white/20" />
      </div>

      <div class="flex gap-4 mt-4">
        <button type="submit" class="px-6 py-2 bg-primary text-black rounded shadow hover:bg-secondary transition">
          💾 Enregistrer
        </button>
        <button type="button" @click="editing = false" class="px-4 py-2 border border-white/20 rounded hover:bg-white/10 transition">
          ✖️ Annuler
        </button>
      </div>
    </form>
  </div>
</template>

