<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    isLoading: {
        type: Boolean,
        default: false
    },
});
</script>

<template>
    <button :type="type"
        class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-full text-xs text-white tracking-widest active:bg-primarydark transition-all ease-in-out duration-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed">
        <p v-if="isLoading" class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-notch fa-spin"></i>
            <span class="text-xs">Cargando ...</span>
        </p>

        <slot v-else />
    </button>
</template>
