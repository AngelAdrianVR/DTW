<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
    isLoading: {
        type: Boolean,
        default: false
    },
});
</script>

<template>
    <button :type="type"
        class="text-center px-4 py-2 bg-red-500 border border-transparent rounded-full text-xs text-white tracking-widest hover:bg-red-600 active:bg-bg-red-700 active:scale-95 disabled:active:scale-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:bg-gray2 focus:outline-none focus:ring-0 transition ease-in-out duration-100">
        <p v-if="isLoading" class="flex items-center space-x-2">
            <i class="fa-solid fa-circle-notch fa-spin"></i>
            <span class="text-xs">Cargando ...</span>
        </p>

        <slot v-else />
    </button>
</template>
