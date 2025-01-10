<template>

    <Head title="Bienvenida(o)" />
    <main class="relative selection:bg-primarylight selection:text-primary bg-black text-white overflow-hidden">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 rounded-full bg-green-600 shadow-sm shadow-green-400/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523322268824&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl text-gray-100"></i>
        </a>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white"
            data-aos="zoom-in-down" data-aos-duration="800">
            <SpanishNav @scrolling="scrollToSection($event)" />
        </nav>

        <main class="pt-32">
            <!-- first section desktop -->
            <section class="rounded-xl relative" id="Inicio" data-aos="fade-right" data-aos-easing="ease-in-sine"
                data-aos-duration="1200">
                <figure class="mx-auto">
                    <img class="hidden md:block mx-auto w-[85%]" src="@/../../public/assets/images/main_landing.png">
                    <img class="mx-auto md:hidden w-[95%]" src="@/../../public/assets/images/mobil_main_landing.png">
                </figure>
                <div class="flex justify-end mx-5 md:mx-0 md:absolute top-1/2 left-[13%]">
                    <a class="inline-flex items-center px-8 py-2 bg-primary border border-transparent rounded-full text-xs text-white tracking-widest active:bg-primarydark transition-all ease-in-out duration-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed" as="button"
                        href="https://api.whatsapp.com/send?phone=523322268824&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20tu%20servicio!"
                        target="_blank" rel="noopener noreferrer">
                        Contáctanos
                    </a>
                </div>
            </section>

            <!-- Servicios -->
            <section id="Servicios" class="lg:mx-32 mx-5">
                <h2 class="text-center font-bold text-2xl mt-40 mb-7" data-aos="flip-down" data-aos-duration="1000"
                    data-aos-offset="300">SERVICIOS</h2>
                <Services />
            </section>

            <!-- Poryectos y portafolio -->
            <section class="my-14">
                <h2 class="text-center font-bold text-2xl mt-40 mb-7" data-aos="flip-down" data-aos-duration="1000"
                    data-aos-offset="300">PROYECTOS / PORTAFOLIO</h2>
                <div class="custom-style text-center">
                    <el-segmented v-model="filterProjects" :options="projectsFilter" />
                </div>

                <!-- proyectos segun el filtro seleccionado -->
                <article class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-14 mx-5 lg:w-[65%] lg:mx-auto">
                    <SpanishProjects :filterProjects="filterProjects" />
                </article>
            </section>

            <!-- Clients -->
            <section class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-7 mt-40 mx-5 lg:w-[60%] lg:mx-auto">
                <h2 class="font-bold mb-9 text-2xl text-center col-span-full" data-aos="flip-down"
                    data-aos-duration="1200" data-aos-offset="300">
                    ALGUNOS DE NUESTROS CLIENTES
                </h2>
                <Clients />
            </section>

            <!-- Proyectos propios -->
            <section class="mt-40 mx-5 xl:w-[80%] xl:mx-auto">
                <h2 class="font-bold mb-14 text-2xl text-center col-span-full">
                    PROYECTOS PROPIOS
                </h2>
                <OwnProjects />
            </section>

            <!-- testimonies -->
            <section class="block lg:mx-24 mx-3 my-28 relative">
                <h2 class="font-bold mb-10 text-xl text-center" data-aos="flip-down" data-aos-duration="1200"
                    data-aos-offset="300">
                    NUESTROS CLIENTES HABLAN POR NOSOTROS
                </h2>
                <Testimonies />
            </section>
            <!-- Footer -->
            <SpanishFooter />
        </main>
    </main>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Clients from "@/Components/MyComponents/Landing/Clients.vue";
import Services from "@/Components/MyComponents/Landing/Services.vue";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";
import OwnProjects from "@/Components/MyComponents/Landing/OwnProjects.vue";
import Testimonies from "@/Components/MyComponents/Landing/Testimonies.vue";
import SpanishFooter from "@/Components/MyComponents/Landing/SpanishFooter.vue";
import SpanishProjects from "@/Components/MyComponents/Landing/SpanishProjects.vue";
import AOS from 'aos';
import 'aos/dist/aos.css';

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
            filterProjects: 'Todo', //filtro de proyectos
            projectsFilter: [
                'Todo',
                'Gestión',
                'Tiendas en línea',
                'Sitios web',
            ],
        };
    },
    components: {
        SpanishProjects,
        SpanishFooter,
        PrimaryButton,
        Testimonies,
        OwnProjects,
        SpanishNav,
        Services,
        Clients,
        Head,
        Link,
    },
    methods: {
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
            // this.showMobileMenu = false;
        },
        store() {
            this.form.post(route("messages.store"), {
                onSuccess: () => {
                    this.toast.success("Mensaje enviado correctamente", {
                        timeout: 3000
                    });

                    form.reset();
                }
            });
        },
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        this.toast = useToast();
        AOS.init();
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
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

.custom-style .el-segmented {
    --el-segmented-bg-color: #818181;
    --el-segmented-color: #000;
    --el-segmented-item-selected-color: #FFFFFF;
    --el-segmented-item-selected-bg-color: #a1a1a1;
    --el-border-radius-base: 16px;
}
</style>
