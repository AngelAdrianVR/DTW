<template>
    <div class="w-1/2 lg:w-1/4 relative">
        <input v-model="query" @keyup.enter="handleSearch" class="input !pl-9" placeholder="Buscar"
            type="text">
        <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
    </div>
</template>
<script>
export default {
    data() {
        return {
            query: null
        }
    },
    methods: {
        handleSearch() {
            this.$emit('search', this.query);
            this.query = null;
        },
    },
}
</script>