<template>
    <AppLayout title="Componentes UI">
        <main class="mx-auto p-6">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold mb-6 text-gray-800">Componentes UI</h1>
                <button
                    @click="$inertia.get(route('components.create'))"
                    title="Agregar componente"
                    class="group cursor-pointer outline-none hover:rotate-90 duration-300"
                    >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="40px"
                        height="40px"
                        viewBox="0 0 24 24"
                        class="stroke-purple-400 fill-none group-hover:fill-purple-100 group-active:stroke-purple-200 group-active:fill-purple-600 group-active:duration-0 duration-300"
                    >
                        <path
                        d="M12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22Z"
                        stroke-width="1.5"
                        ></path>
                        <path d="M8 12H16" stroke-width="1.5"></path>
                        <path d="M12 16V8" stroke-width="1.5"></path>
                    </svg>
                </button>
            </div>

            <!-- Filtros -->
            <div class="flex md:justify-end overflow-x-auto space-x-3 mb-6 text-sm scrollbar-hide mt-2">
                <button
                    v-for="category in categories"
                    :key="category"
                    @click="filterCategory(category)"
                    :class="['px-4 py-2 flex-shrink-0 rounded-lg font-medium transition', 
                        selectedCategory === category ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300']">
                    {{ category }}
                </button>
                <button 
                    @click="resetFilter"
                    class="px-4 py-2 flex-shrink-0 rounded-lg font-medium bg-red-500 text-white hover:bg-red-600 transition">
                    Limpiar filtro
                </button>
            </div>


            <Loading class="mt-20" v-if="loading" />

            <div v-if="localComponents.length && !loading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-5">
                <ComponentCard @deleteComponent="deleteComponent" v-for="component in localComponents" :key="component.id" :component="component" />
            </div>

            <div v-else-if="!loading" class="text-gray-500 text-center mt-10">No hay componentes disponibles.</div>

            <section class="mt-7">
                <div v-if="!selectedCategory">
                    <PaginationWithNoMeta :pagination="components"/>
                </div>
            </section>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ComponentCard from "@/Components/MyComponents/ComponentCard.vue";
import Loading from "@/Components/MyComponents/Loading.vue";
import PaginationWithNoMeta from "@/Components/MyComponents/PaginationWithNoMeta.vue";

export default {
data() {
    return {
        localComponents: [... this.components.data],
        selectedCategory: null,
        categories: ["Botones", "Switches", "Estados de carga", "Otro"],
        loading: false
    }
},
components:{
    PaginationWithNoMeta,
    ComponentCard,
    AppLayout,
    Loading,
},
props: {
    components: {
        type: Object,
        required: true
    },
},
methods: {
    deleteComponent(id) {
        this.localComponents = this.localComponents.filter(component => component.id != id);
    },
    async fetchComponents(category = null) {
        try {
            this.loading = true;
            const response = await axios.get(route('components.filter-data', { category }));
            this.localComponents = response.data;
        } catch (error) {
            console.error("Error al cargar los componentes:", error);
        } finally {
            this.loading = false;
        }
    },
    filterCategory(category) {
        this.selectedCategory = category;
        this.fetchComponents(category);
    },
    resetFilter() {
        this.selectedCategory = null;
        this.fetchComponents();
    },
},
};
</script>
