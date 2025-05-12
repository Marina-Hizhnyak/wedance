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
    <h1 class="text-3xl font-bold text-primary mb-6">💬 My Chat Sessions</h1>

    <!-- Show table if chats exist -->
    <div v-if="hasChats" class="overflow-x-auto bg-[#1e1e1e] rounded-lg shadow">
      <table class="min-w-full table-auto text-sm">
        <thead class="bg-primary text-black uppercase text-xs">
          <tr>
            <th class="px-4 py-3 text-left">Chat ID</th>
            <th class="px-4 py-3 text-left">Created At</th>
            <th class="px-4 py-3 text-left">Messages</th>
            <th class="px-4 py-3 text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop user chat sessions -->
          <template v-for="chat in chats" :key="chat.id">
            <tr class="border-b border-gray-700 hover:bg-[#2a2a2a]">
              <td class="px-4 py-3">{{ chat.id }}</td>
              <td class="px-4 py-3">{{ formatDate(chat.created_at) }}</td>
              <td class="px-4 py-3">{{ chat.messages?.length ?? 0 }}</td>
              <td class="px-4 py-3 space-x-2">
                <!-- View / Hide messages -->
                <button
                  @click="toggleMessages(chat.id)"
                  class="text-primary hover:underline"
                >
                  {{ expandedChatId === chat.id ? 'Hide' : 'View' }}
                </button>

                <!-- Delete chat -->
                <button
                  @click="deleteChat(chat.id)"
                  class="text-red-500 hover:underline"
                >
                  Delete
                </button>
              </td>
            </tr>

            <!-- Inline messages viewer -->
            <tr v-if="expandedChatId === chat.id">
              <td colspan="4" class="px-4 py-4 bg-[#2a2a2a]">
                <div class="space-y-3">
                  <div v-for="message in chat.messages" :key="message.id">
                    <div :class="message.role === 'user' ? 'text-right' : ''">
                      <div :class="message.role === 'user' ? 'bg-yellow-100 text-black' : 'bg-gray-100 text-black'"
                        class="inline-block px-4 py-2 rounded-lg text-sm max-w-full break-words leading-relaxed">
                        <p class="mb-1 text-xs text-gray-500">
                          {{ message.role === 'user' ? 'You' : 'Assistant' }}
                          • {{ formatDate(message.created_at) }}
                        </p>
                        <p>{{ message.content }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>

    <!-- If no chats -->
    <div v-else class="text-center text-gray-400 mt-10">
      You don't have any chat sessions yet.
    </div>
  </div>
</template>
