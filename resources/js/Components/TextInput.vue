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
        class="border-[#D9D9D9] focus:border-primary focus:ring-0 rounded-full shadow-sm placeholder:text-xs text-sm h-8"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    >
</template>
