<template>
    <div class="bg-white rounded-2xl shadow-lg p-5 border border-gray-200 transition hover:shadow-2xl self-start">
        <!-- Nombre del componente -->
        <div class="flex items-center justify-between mx-2">
            <h2 class="font-semibold text-gray-800 mb-2 truncate w-2/3">{{ component.name }}</h2>
            <div class="flex items-center space-x-2">
                <i class="fa-brands fa-html5 text-orange-500 text-lg"></i>
                <i v-if="component.css_code" class="fa-brands fa-css3-alt text-blue-600 text-lg"></i>
                <i v-if="component.js_code" class="fa-brands fa-square-js text-yellow-400 text-lg"></i>
                <svg v-if="!component.css_code" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="22" height="22" viewBox="0 0 48 48">
                    <linearGradient id="iOmQfjoCC4Hw6zVwRjSDha_x7XMNGh2vdqA_gr1" x1="21.861" x2="25.703" y1="8.237" y2="36.552" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#00c1e0"></stop><stop offset="1" stop-color="#009bb8"></stop></linearGradient><path fill="url(#iOmQfjoCC4Hw6zVwRjSDha_x7XMNGh2vdqA_gr1)" d="M24,9.604c-5.589,0-9.347,2.439-11.276,7.318c-0.2,0.505,0.417,0.92,0.816,0.551 c2.035-1.882,4.322-2.505,6.86-1.871c1.826,0.456,3.131,1.781,4.576,3.247C27.328,21.236,30.051,24,36,24 c5.589,0,9.348-2.44,11.276-7.319c0.2-0.505-0.417-0.92-0.816-0.551c-2.035,1.882-4.322,2.506-6.86,1.872 c-1.825-0.456-3.13-1.781-4.575-3.247C32.672,12.367,29.948,9.604,24,9.604L24,9.604z M12,24c-5.589,0-9.348,2.44-11.276,7.319 c-0.2,0.505,0.417,0.92,0.816,0.551c2.035-1.882,4.322-2.506,6.86-1.871c1.825,0.457,3.13,1.781,4.575,3.246 c2.353,2.388,5.077,5.152,11.025,5.152c5.589,0,9.348-2.44,11.276-7.319c0.2-0.505-0.417-0.92-0.816-0.551 c-2.035,1.882-4.322,2.506-6.86,1.871c-1.826-0.456-3.131-1.781-4.576-3.246C20.672,26.764,17.949,24,12,24L12,24z"></path>
                </svg>
            </div>
        </div>

        <!-- Vista previa del componente -->
        <div class="border h-40 border-gray-300 rounded-lg overflow-hidden p-4 bg-gray-50 flex items-center justify-center">
            <div v-html="component.html_code"></div>
        </div>

        <div class="flex items-center justify-between mt-4 text-right mx-2">
            <div class="flex items-center space-x-3">
                <p class="flex items-center text-sm text-gray-500 space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <span>{{ formatViews(component.views) }}</span>
                </p>

            </div>

            <!-- Acciones -->
            <div class="flex items-center space-x-2">
                <button @click="$inertia.get(route('components.show', component.id))" class="transition ease-linear duration-100 text-gray-500 py-1 px-3 rounded-md hover:bg-gray-100 text-sm">
                    <i class="fa-solid fa-code mr-1"></i> Código
                </button>

                <button @click="$inertia.get(route('components.edit', component.id))" v-if="$page.props.auth?.user" class="transition ease-linear duration-100 text-gray-500 py-1 px-2 rounded-md hover:bg-gray-100 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>
                </button>
                
                <button @click="confirmDelete" v-if="$page.props.auth?.user" class="transition ease-linear duration-100 text-red-500 py-1 px-2 rounded-md hover:bg-red-100 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Código con pestañas -->
        <!-- <details class="mt-4">
            <summary class="text-blue-600 cursor-pointer text-sm font-medium">Ver código</summary>

            <div class="mt-2 bg-gray-100 rounded-lg p-3">
                Pestañas
                <div class="flex border-b border-gray-300">
                    <button 
                        v-for="tab in tabs" 
                        :key="tab" 
                        @click="activeTab = tab.label"
                        class="px-4 py-2 text-sm font-medium"
                        :class="{
                            'bg-white border border-gray-300 border-b-transparent': activeTab === tab.label,
                            'bg-gray-200': activeTab !== tab.label
                        }"
                    >
                        <span :class="tab.color" v-html="tab.icon"></span>
                        {{ tab.label.toUpperCase() }}
                    </button>
                </div>

                Contenido de las pestañas
                <pre class="bg-gray-900 text-white text-xs p-3 rounded mt-2 overflow-auto">
                    <code v-if="activeTab === 'html'">{{ component.html_code }}</code>
                    <code v-if="activeTab === 'css'">{{ component.css_code || 'No tiene código css' }}</code>
                    <code v-if="activeTab === 'js'">{{ component.js_code || 'No tiene código JS' }}</code>
                </pre>
            </div>
        </details> -->
    </div>
</template>

<script>
export default {
    props: {
        component: Object
    },
    emits:['deleteComponent'],
    data() {
        return {
            activeTab: "html",
            tabs: [
                {
                    label: "html",
                    icon: '<i class="fa-brands fa-html5"></i>',
                    color: 'text-orange-500'
                }, 
                {
                    label: "css",
                    icon: '<i class="fa-brands fa-css3-alt"></i>',
                    color: 'text-blue-600'
                }, 
                {
                    label: "js",
                    icon: '<i class="fa-brands fa-square-js"></i>',
                    color: 'text-yellow-400'
                }, 
            ],
        };
    },
    mounted() {
        this.injectStyles();
    },
    methods: {
        injectStyles() {
            if (this.component.css_code) {
                const styleTag = document.createElement("style");
                styleTag.innerHTML = this.component.css_code;
                document.head.appendChild(styleTag);
            }
        },
        formatViews(views) {
            if (views >= 1_000_000) {
                return (views / 1_000_000).toFixed(1) + 'M';
            } else if (views >= 1_000) {
                return (views / 1_000).toFixed(1) + 'K';
            } else {
                return views.toString();
            }
        },
        confirmDelete() {
            ElMessageBox.confirm(
                `¿Estás seguro de que quieres eliminar "${this.component.name}"? Esta acción no se puede deshacer.`,
                "Confirmar eliminación",
                {
                    confirmButtonText: "Eliminar",
                    cancelButtonText: "Cancelar",
                    type: "warning",
                }
            )
            .then(() => {
                this.deleteComponent();
            })
            .catch(() => {
                ElMessage.info("Eliminación cancelada");
            });
        },
        deleteComponent() {
            this.$inertia.delete(route("components.destroy", this.component.id), {
                onSuccess: () => {
                    ElMessage.success("Componente eliminado exitosamente");
                    this.$emit('deleteComponent', this.component.id);
                },
                onError: () => {
                    ElMessage.error("Error al eliminar el componente");
                }
            });
        },
    }
};
</script>
