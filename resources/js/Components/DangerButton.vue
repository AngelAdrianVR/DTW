<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
   <button :type="type" class="text-center px-4 py-2 bg-red-500 border border-transparent rounded-full text-xs text-white tracking-widest hover:bg-red-600 active:bg-bg-red-700 active:scale-95 disabled:active:scale-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:bg-gray2 focus:outline-none focus:ring-0 transition ease-in-out duration-100">
        <slot />
    </button>
</template>
