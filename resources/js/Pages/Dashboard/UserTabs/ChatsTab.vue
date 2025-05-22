<script setup>
import { ref, computed } from 'vue'
import { router } from '@inertiajs/vue3'

// Get user chat sessions from props
const props = defineProps({
  chats: Array
})

// Check if user has chats
const hasChats = computed(() => props.chats.length > 0)

// State for expanded chat (to show messages)
const expandedChatId = ref(null)

// Toggle messages visibility
function toggleMessages(chatId) {
  expandedChatId.value = expandedChatId.value === chatId ? null : chatId
}

// Delete chat session
function deleteChat(chatId) {
  if (confirm('Are you sure you want to delete this chat session?')) {
    router.delete(`/dashboard/user/chats/${chatId}`)
  }
}

// Helper for date formatting
const formatDate = (date) => {
  if (!date) return ''
  return new Date(date).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>

<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-6">Mes sessions de chat</h1>

    <!-- Table -->
    <div v-if="hasChats" class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg text-sm mb-6">
        <thead class="bg-[#1f1f1f] text-left text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Chat ID</th>
            <th class="px-4 py-2 border-b border-primary">Créé le</th>
            <th class="px-4 py-2 border-b border-primary">Messages</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(chat, index) in chats" :key="chat.id">
            <tr
              :class="[
                'text-gray-100 hover:bg-[#2a2a2a]',
                index === chats.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
              ]"
            >
              <td class="px-4 py-2">{{ chat.id }}</td>
              <td class="px-4 py-2">{{ formatDate(chat.created_at) }}</td>
              <td class="px-4 py-2">{{ chat.messages?.length ?? 0 }}</td>
              <td class="px-4 py-2 space-x-2">
                <button
                  @click="toggleMessages(chat.id)"
                  class="px-3 py-1 text-sm font-bold bg-primary text-black rounded hover:bg-secondary"
                >
                  {{ expandedChatId === chat.id ? 'Masquer' : 'Voir' }}
                </button>
                <button
                  @click="deleteChat(chat.id)"
                  class="px-3 py-1 text-sm font-bold bg-accent text-white rounded hover:bg-red-500"
                >
                  Supprimer
                </button>
              </td>
            </tr>

            <!-- Messages -->
            <tr v-if="expandedChatId === chat.id">
              <td colspan="4" class="px-4 py-4 bg-[#2a2a2a]">
                <div class="space-y-3">
                  <div
                    v-for="message in chat.messages"
                    :key="message.id"
                    :class="message.role === 'user' ? 'text-right' : 'text-left'"
                  >
                    <div
                      :class="message.role === 'user'
                        ? 'bg-yellow-100 text-black'
                        : 'bg-gray-100 text-black'"
                      class="inline-block px-4 py-2 rounded-lg text-sm max-w-full break-words leading-relaxed"
                    >
                      <p class="mb-1 text-xs text-gray-500">
                        {{ message.role === 'user' ? 'Vous' : 'Assistant' }}
                        • {{ formatDate(message.created_at) }}
                      </p>
                      <p>{{ message.content }}</p>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <!-- Empty -->
    <div v-else class="text-center text-gray-400 mt-10 italic">
      Vous n'avez encore aucune session de chat.
    </div>
  </div>
</template>

