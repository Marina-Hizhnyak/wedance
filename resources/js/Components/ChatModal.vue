<template>
  <div>
    <!-- Floating button -->
    <button @click="openChat"
      class="fixed bottom-6 right-6 bg-red-500 text-white p-4 rounded-full shadow-lg z-50">
      💬
    </button>

    <!-- Popup modal -->
    <div v-if="showChat" class="fixed bottom-6 right-6 w-96 bg-background border border-primary shadow-xl rounded-lg flex flex-col py-4 z-50">
      <!-- Close button -->
      <button @click="showChat = false"
        class="absolute top-2 right-2 text-gray-500 hover:text-black text-2xl leading-none">&times;</button>

      <!-- Messages -->
        <div class="flex-1 min-h-0 overflow-y-auto p-4 max-h-[70vh]" ref="messagesContainer">
            <div class="space-y-3">
                <div v-for="(message, index) in messages" :key="index">
                    <div :class="{'text-right': message.role === 'user'}">
                        <span
                        :class="message.role === 'user' ? 'bg-yellow-100' : 'bg-gray-100'"
                        class="inline-block p-2 rounded max-w-full break-words mx-3 text-sm leading-relaxed"
                        v-html="parseMarkdown(message.content)"
                        ></span>
                    </div>
                </div>

                <!-- typing dots -->
                <div v-if="isLoading">
                    <div>
                        <span class="inline-block p-2 rounded bg-gray-100">
                            <span class="dot-animation">
                                <span>●</span><span>●</span><span>●</span>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>


      <!-- Input -->
      <div class="border-t p-3 flex items-center space-x-2">
        <input
          v-model="newMessage"
          @keydown.enter="sendMessage"
          type="text"
          placeholder="Écrivez votre question..."
          class="flex-1 border rounded px-3 py-2 text-sm"
        >
        <button
          @click="sendMessage"
          class="bg-red-500 text-white px-4 py-2 text-sm rounded"
        >
          Envoyer
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onUpdated } from 'vue'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

// Reactive state variables
const showChat = ref(false)
const newMessage = ref('')
const messages = ref([])
const sessionId = ref(null)
const messagesContainer = ref(null)
const isLoading = ref(false)

// Utility to get Laravel CSRF token from meta tag
const getCsrfToken = () => document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')

// Configure marked.js for safe Markdown parsing
marked.setOptions({
  mangle: false,        // Disable email address obfuscation
  headerIds: false      // Disable automatic heading IDs
})

// Markdown parser function
function parseMarkdown(text) {
  const dirty = marked.parse(text ?? '')
  return DOMPurify.sanitize(dirty)
}

// Open the chat window and create a new session if not already created
async function openChat() {
  showChat.value = true

  // ✅ Add welcome message only once when chat is empty
  if (messages.value.length === 0) {
    messages.value.push({
      role: 'assistant',
      content: "👋 Bonjour ! Je suis l’assistant de Wedance. Comment puis-je vous aider aujourd’hui ? Posez-moi vos questions sur les cours, les événements ou les professeurs."
    })
  }

  if (!sessionId.value) {
    try {
      const response = await fetch('/chat/create-session', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': getCsrfToken(),
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'application/json'
        },
        credentials: 'same-origin'
      })

      const data = await response.json()
      sessionId.value = data.session_id
    } catch (error) {
      console.error('Error creating session:', error)
    }
  }
}


// Send message to backend and receive assistant reply
async function sendMessage() {
  if (!newMessage.value.trim()) return

  // Add user message immediately to the messages array
  messages.value.push({ role: 'user', content: newMessage.value })

  // Store current user message and clear input field
  const userMessage = newMessage.value
  newMessage.value = ''

  // Show assistant typing indicator
  isLoading.value = true

  try {
    const response = await fetch('/chat/send-message', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': getCsrfToken(),
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
      },
      credentials: 'same-origin',
      body: JSON.stringify({
        session_id: sessionId.value,
        message: userMessage
      })
    })

    // Handle error response
    if (!response.ok) {
      const errorData = await response.json()
      console.error('Server error:', errorData)
      isLoading.value = false
      return
    }

    // Append assistant reply to messages array
    const data = await response.json()
    messages.value.push({ role: 'assistant', content: data.reply })
  } catch (error) {
    console.error('Error sending message:', error)
  }

  // Hide assistant typing indicator
  isLoading.value = false
}

// Automatically scroll chat window to the latest message
onUpdated(() => {
  if (messagesContainer.value) {
    messagesContainer.value.scrollTop = messagesContainer.value.scrollHeight
  }
})
</script>

<style scoped>
/* Animation for assistant typing dots */
@keyframes blink {
  0%   { opacity: 0.2; transform: translateY(0); }
  20%  { opacity: 1; transform: translateY(-3px); }
  100% { opacity: 0.2; transform: translateY(0); }
}

/* Styling for each dot in the typing animation */
.dot-animation span {
  animation: blink 1.4s infinite both;
  display: inline-block;
  font-size: 12px;
  line-height: 0;
  margin: 0 2px;
}

/* Delay the animation for each dot for a wave effect */
.dot-animation span:nth-child(1) { animation-delay: 0s; }
.dot-animation span:nth-child(2) { animation-delay: 0.2s; }
.dot-animation span:nth-child(3) { animation-delay: 0.4s; }
</style>
