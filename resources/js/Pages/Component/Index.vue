<template>
    <AppLayout title="Componentes UI">
        <main class="container mx-auto p-6">
            <h1 class="text-xl font-bold mb-6 text-gray-800">Componentes UI</h1>

            <div v-if="components.length" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <ComponentCard v-for="component in components" :key="component.id" :component="component" />
            </div>

            <div v-else class="text-gray-500 text-center mt-10">No hay componentes disponibles.</div>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ComponentCard from "@/Components/MyComponents/ComponentCard.vue";

export default {
data() {
    return {
        
    }
},
components:{
    ComponentCard,
    AppLayout,
},
props: {
components: {
    type: Array,
    required: true
}
}
};
</script>
