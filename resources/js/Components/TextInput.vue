<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="border-primary focus:border-secondary focus:ring-secondary rounded-md shadow-sm bg-slate-100"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
