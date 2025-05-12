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
    <h1 class="text-2xl font-bold mb-6">💬 Chat Sessions</h1>

    <!-- Table of chat sessions -->
    <div class="overflow-x-auto bg-[#1e1e1e] rounded-lg shadow">
      <table class="min-w-full table-auto text-sm">
        <thead class="bg-primary text-black uppercase text-xs">
          <tr>
            <th class="px-4 py-3 text-left">ID</th>
            <th class="px-4 py-3 text-left">User</th>
            <th class="px-4 py-3 text-left">User ID</th>
            <th class="px-4 py-3 text-left">Created At</th>
            <th class="px-4 py-3 text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop all chat sessions -->
          <template v-for="chat in chats" :key="chat.id">
            <tr class="border-b border-gray-700 hover:bg-[#2a2a2a]">
              <td class="px-4 py-3">{{ chat.id }}</td>
              <td class="px-4 py-3">{{ chat.user?.name ?? 'Guest' }}</td>
              <td class="px-4 py-3">{{ chat.user_id ?? 'Anonymous' }}</td>
              <td class="px-4 py-3">{{ new Date(chat.created_at).toLocaleString() }}</td>
              <td class="px-4 py-3 space-x-2">
                <!-- View button -->
                <button @click="toggleMessages(chat.id)"
                class="text-primary hover:underline">
                {{ expandedChatId === chat.id ? 'Hide' : 'View' }}
                </button>

                <!-- Delete button -->
                <button @click="deleteChat(chat.id)"
                class="text-red-500 hover:underline">
                Delete
                </button>
              </td>
            </tr>

            <!-- Inline messages viewer -->
            <tr v-if="expandedChatId === chat.id">
              <td colspan="5" class="px-4 py-4 bg-[#2a2a2a]">
                <div class="space-y-3">
                  <div v-for="message in chat.messages" :key="message.id">
                    <div :class="message.role === 'user' ? 'text-right' : ''">
                      <div :class="message.role === 'user'
                          ? 'bg-yellow-100 text-black'
                          : 'bg-gray-100 text-black'"
                        class="inline-block px-4 py-2 rounded-lg text-sm max-w-full break-words leading-relaxed">
                        <!-- Message metadata -->
                        <p class="mb-1 text-xs text-gray-500">
                          {{ message.role === 'user' ? 'User' : 'Assistant' }}
                          • {{ new Date(message.created_at).toLocaleString() }}
                        </p>
                        <!-- Message content -->
                        <p>{{ message.content }}</p>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </template>

          <!-- Show message if no chats found -->
          <tr v-if="chats.length === 0">
            <td colspan="5" class="text-center px-4 py-6 text-gray-400">
              No chat sessions found.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

