<template>
  <div class="flex flex-wrap gap-2">
    <button @click="editor.chain().focus().toggleBold().run()" :class="buttonClass(editor.isActive('bold'))">B</button>
    <button @click="editor.chain().focus().toggleItalic().run()" :class="buttonClass(editor.isActive('italic'))">I</button>
    <button @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="buttonClass(editor.isActive('heading', { level: 2 }))">H2</button>
    <button @click="editor.chain().focus().toggleBulletList().run()" :class="buttonClass(editor.isActive('bulletList'))">• List</button>
    <button @click="editor.chain().focus().toggleOrderedList().run()" :class="buttonClass(editor.isActive('orderedList'))">1. List</button>
    <button @click="editor.chain().focus().unsetAllMarks().clearNodes().run()" class="px-2 py-1 border text-sm rounded bg-gray-600 text-white">Clear</button>
  </div>
</template>

<script setup>
defineProps({ editor: Object })

function buttonClass(active) {
  return [
    'px-2 py-1 border text-sm rounded',
    active ? 'bg-primary text-white' : 'bg-gray-200 text-black'
  ].join(' ')
}
</script>
