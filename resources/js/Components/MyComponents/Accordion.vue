<template>
    <button :id="`accordion-title-${id}`"
        class="w-full text-start px-2 mb- flex justify-between items-center text-xs rounded-full py-1"
        :class="active ? 'font-bold text-primary bg-[#3E3D3F]' : ''" @click.prevent="accordionOpen = !accordionOpen"
        :aria-expanded="accordionOpen" :aria-controls="`accordion-text-${id}`" :title="title">
        <p class="flex items-center">
            <i v-html="icon"></i>
            <span class="ml-2">{{ title }}</span>
        </p>
        <i class="fa-solid fa-angle-down transform origin-center transition duration-200 ease-out"
            :class="{ '!rotate-180': accordionOpen }"></i>
    </button>
    <div :id="`accordion-text-${id}`" role="region" :aria-labelledby="`accordion-title-${id}`"
        class="grid text-sm overflow-hidden transition-all duration-300 ease-in-out ml-3"
        :class="accordionOpen ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
        <div class="overflow-hidden">
            <p>
                <slot />
            </p>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            accordionOpen: this.active,
        }
    },
    props: {
        title: String,
        id: Number,
        active: Boolean,
        icon: String,
    },
    components: {
    }
}
</script>
