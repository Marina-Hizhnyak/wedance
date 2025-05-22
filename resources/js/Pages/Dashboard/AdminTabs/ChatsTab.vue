<script setup>
import { ref, computed } from 'vue'
import { usePage, router } from '@inertiajs/vue3'

// Get chats data from page props
const chats = computed(() => usePage().props.chats ?? [])

// Track which chat is expanded
const expandedChatId = ref(null)

// Toggle function for expanding/collapsing messages
function toggleMessages(chatId) {
  expandedChatId.value = expandedChatId.value === chatId ? null : chatId
}

function deleteChat(chatId) {
  if (confirm('Are you sure you want to delete this chat session?')) {
    router.delete(`/admin/chats/${chatId}`)
  }
}
</script>

<template>
  <div>
    <!-- Title -->
    <h1 class="text-3xl font-bold text-primary mb-4">Chat Sessions</h1>

    <!-- Table of chat sessions -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-white text-left">
          <tr>
            <th class="px-4 py-2 border-b border-primary">ID</th>
            <th class="px-4 py-2 border-b border-primary">User</th>
            <th class="px-4 py-2 border-b border-primary">User ID</th>
            <th class="px-4 py-2 border-b border-primary">Created At</th>
            <th class="px-4 py-2 border-b border-primary">Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop all chat sessions -->
          <template v-for="(chat, index) in chats" :key="chat.id">
            <tr
              :class="[
                'text-gray-100 hover:bg-[#2a2a2a]',
                index === chats.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
              ]"
            >
              <td class="px-4 py-2">{{ chat.id }}</td>
              <td class="px-4 py-2">{{ chat.user?.name ?? 'Guest' }}</td>
              <td class="px-4 py-2">{{ chat.user_id ?? 'Anonymous' }}</td>
              <td class="px-4 py-2">{{ new Date(chat.created_at).toLocaleString() }}</td>
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

            <!-- Inline messages -->
            <tr v-if="expandedChatId === chat.id">
              <td colspan="5" class="px-4 py-4 bg-[#2a2a2a]">
                <div class="space-y-3">
                  <div v-for="message in chat.messages" :key="message.id">
                    <div :class="message.role === 'user' ? 'text-right' : ''">
                      <div
                        :class="message.role === 'user'
                          ? 'bg-yellow-100 text-black'
                          : 'bg-gray-100 text-black'"
                        class="inline-block px-4 py-2 rounded-lg text-sm max-w-full break-words leading-relaxed"
                      >
                        <p class="mb-1 text-xs text-gray-500">
                          {{ message.role === 'user' ? 'User' : 'Assistant' }} •
                          {{ new Date(message.created_at).toLocaleString() }}
                        </p>
                        <p>{{ message.content }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </template>

          <!-- No chats -->
          <tr v-if="chats.length === 0">
            <td colspan="5" class="text-center px-4 py-6 text-gray-400 italic">
              No chat sessions found.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>


