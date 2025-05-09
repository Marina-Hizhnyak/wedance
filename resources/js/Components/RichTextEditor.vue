<template>
  <div class="bg-background border rounded p-4">
    <MenuBar v-if="editor" :editor="editor" class="mb-4" />
    <EditorContent :editor="editor" class="prose max-w-none bg-white text-black p-4 rounded min-h-[150px]" />
  </div>
</template>

<script setup>
import { onBeforeUnmount, watch } from 'vue'
import { Editor, EditorContent } from '@tiptap/vue-3'
import StarterKit from '@tiptap/starter-kit'
import Placeholder from '@tiptap/extension-placeholder'
import MenuBar from './MenuBar.vue'

const props = defineProps({
  modelValue: String,
})
const emit = defineEmits(['update:modelValue'])

const editor = new Editor({
  content: props.modelValue,
  extensions: [
    StarterKit,
    Placeholder.configure({
      placeholder: 'Write your blog post here...',
    }),
  ],
  editorProps: {
    attributes: {
      class: 'focus:outline-none',
    },
  },
  onUpdate: ({ editor }) => {
    emit('update:modelValue', editor.getHTML())
  },
})

watch(() => props.modelValue, (value) => {
  if (editor && value !== editor.getHTML()) {
    editor.commands.setContent(value)
  }
})

onBeforeUnmount(() => {
  editor.destroy()
})
</script>


