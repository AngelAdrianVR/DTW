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
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-full text-xs text-white tracking-widest active:bg-primarydark transition-all ease-in-out duration-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed">
        <div class="flex items-center">
            <i v-if="isLoading" class="fa-solid fa-circle-notch fa-spin"></i>
            <slot v-else />
        </div>
    </button>
</template>
