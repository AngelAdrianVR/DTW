<template>
    <Head title="Componentes UI" />
    <main class="relative selection:bg-primarylight selection:text-primary bg-black min-h-screen text-white p-6">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523322268824&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
        </a>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
            <SpanishNav @scrolling="scrollToSection($event)" />
        </nav>

        <main class="pt-28 lg:px-28">
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-bold mb-6 text-gray-200">Componentes UI</h1>
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
                    Todos
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

        <!-- Footter -->
        <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative">
            <figure>
                <img @click="$inertia.visit('/')" class="md:w-[6%] w-[29%]" src="@/../../public/assets/images/white_logo.png" alt="" />
            </figure>
            <div class="md:grid grid-cols-3 h-28">
                <div class="border-r border-white flex justify-center items-cente">
                    <p class="text-lg">"Liberando tu potencial en linea"</p>
                </div>

                <div class="border-r border-white flex justify-center items-center">
                    <div class="flex flex-col">
                        <h2 class="text-center mb-5 text-xl">Contacto</h2>
                        <div>
                            <p><i class="fa-solid fa-phone mr-2 mb-3"></i>3322268824</p>
                            <p>
                                <i class="fa-solid fa-envelope mr-2"></i>contacto@dtw.com.mx
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center items-center">
                    <div class="flex flex-col justify-center items-center">
                        <h2 class="text-center mb-5 text-xl">Síguenos</h2>
                        <div>
                            <a href="https://www.facebook.com/profile.php?id=100094614796876" target="_blank"><i
                                    class="fa-brands fa-facebook text-2xl border border-white rounded-full px-3 py-2 cursor-pointer mr-5"></i></a>
                            <a href="https://instagram.com/digital_tw?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D"
                                target="_blank"><i
                                    class="fa-brands fa-instagram text-2xl border border-white rounded-full px-3 py-2 cursor-pointer"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 hover:underline">
                        Política de privacidad - Plítica de cookies
                    </p>
                </a>
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 hover:underline">
                        Copyright | 2024 | Todos los derechos reservados por DTW
                    </p>
                </a>
            </div>
        </footer>
    </main>
</template>

<script>
import ComponentCard from "@/Components/MyComponents/ComponentCard.vue";
import Loading from "@/Components/MyComponents/Loading.vue";
import PaginationWithNoMeta from "@/Components/MyComponents/PaginationWithNoMeta.vue";

import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";

export default {
    data() {
        const form = useForm({
            name: null,
            email: null,
            phone: null,
            service: null,
            message: null,
            info: false,
        });
        return {
            form,
            isNavbarFixed: false,
            currentTestimony: 0,
            lastScrollY: 0,

            //componentes
            localComponents: [... this.components.data],
            selectedCategory: null,
            categories: ["Botones", "Switches", "Estados de carga", "Checkboxes", "Otro"],
            loading: false
        };
    },
    components: {
        InputWithPlaceholder,
        PaginationWithNoMeta,
        ComponentCard,
        SpanishNav,
        Loading,
        Head,
        Link,
    },
    props: {
        components: {
            type: Object,
            required: true
        },
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        this.toast = useToast();
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
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
        handleScroll() {
            const currentScrollY = window.scrollY;

            if (currentScrollY > this.lastScrollY && currentScrollY > window.innerHeight) {
                // Si se hace scroll hacia abajo y se ha pasado el alto de la pantalla
                this.isNavbarFixed = false;
            } else {
                // Si se hace scroll hacia arriba
                this.isNavbarFixed = true;
            }

            this.lastScrollY = currentScrollY;
        },
        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({ behavior: 'smooth' });
            this.showMobileMenu = false;
        },
        store() {
            this.form.post(route("store-quote"), {
                onSuccess: () => {
                    this.toast.success("Se han enviado los datos. Te haremos llegar la cotizacion lo mas pronto posible", {
                        timeout: 5000
                    });

                    form.reset();
                }
            });
        },
    },
};
</script>

<style>
/* Estilos para la barra de navegación */
.navbar {
    position: absolute;
    top: 0;
    background-color: #ffffff;
    opacity: 0.9;
}

.fixed-navbar {
    position: fixed;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

html {
    scroll-behavior: smooth;
}
</style>
