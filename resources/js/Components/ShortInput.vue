<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: String,
    disable: Boolean
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
    <input ref="input" style="border: 1px black solid;" :disabled="disable"
        class="px-1 py-1 text-xs border-black rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 read-only:bg-gray-300"
        :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
</template>