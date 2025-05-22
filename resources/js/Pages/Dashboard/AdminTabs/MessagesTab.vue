<template>
  <div>
    <h1 class="text-3xl font-bold text-primary mb-4">Messages</h1>

    <div v-if="messages.length" class="overflow-x-auto">
      <table class="min-w-full table-auto bg-background border border-primary rounded-lg mb-6">
        <thead class="bg-[#1f1f1f] text-white">
          <tr>
            <th class="px-4 py-2 border-b border-primary">Nom</th>
            <th class="px-4 py-2 border-b border-primary">Email</th>
            <th class="px-4 py-2 border-b border-primary">Message</th>
            <th class="px-4 py-2 border-b border-primary">Cours</th>
            <th class="px-4 py-2 border-b border-primary">Essai gratuit</th>
            <th class="px-4 py-2 border-b border-primary">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(msg, index) in messages"
            :key="msg.id"
            :class="[
              'text-gray-100 hover:bg-[#2a2a2a]',
              index === messages.length - 1 ? 'border-b border-primary' : 'border-b border-[#333]'
            ]"
          >
            <td class="px-4 py-2">{{ msg.name }}</td>
            <td class="px-4 py-2">{{ msg.email }}</td>
            <td class="px-4 py-2">{{ msg.message }}</td>
            <td class="px-4 py-2">{{ msg.course?.title ?? '–' }}</td>
            <td class="px-4 py-2">
              <span v-if="msg.course_trial" class="text-primary font-semibold">Oui</span>
              <span v-else class="text-gray-400 italic">Non</span>
            </td>
            <td class="px-4 py-2">{{ formatDate(msg.created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>

    <div v-else class="text-gray-400 italic">Aucun message trouvé.</div>
  </div>
</template>


<script setup>
import { defineProps } from 'vue'

const props = defineProps({
  messages: Array
})

function formatDate(dateStr) {
  return new Date(dateStr).toLocaleDateString('fr-FR', {
    day: '2-digit',
    month: '2-digit',
    year: 'numeric',
    hour: '2-digit',
    minute: '2-digit'
  })
}
</script>
