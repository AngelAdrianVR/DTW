<template>
    <Head title="Bienvenido" />
    <main class="relative selection:bg-primarylight selection:text-primary bg-black text-white">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 rounded-full bg-green-600 shadow-sm shadow-green-400/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl text-gray-100"></i>
        </a>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
            <SpanishNav @scrolling="scrollToSection($event)" />
        </nav>

        <main class="pt-24">
            <!-- first section desktop -->
            <section class="md:grid grid-cols-2 gap-x-10 md:mx-14 mx-2 p-8 border border-white rounded-xl" id="Inicio">
                <div class="flex-col justify-center py-14">
                    <h1 class="font-bold lg:text-7xl text-lg text-center">Diseño web a la medida</h1>
                    <p class="mt-9">
                        Creamos sitios web a la medida, único y personalizado según tus
                        necesidades, desde sitios corporativos, tiendas en línea,
                        informativos.
                        <br>
                        Transformamos tus ideas en soluciones digitales que impulsan el crecimiento empresarial
                    </p>
                </div>

                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                    <button @click="$inertia.get(route('quote-request.create'))"
                        class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Cotizar mi sitio
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </figure>
            </section>

            <!-- Poryectos y portafolio -->
            <section class="my-14">
                <h2 class="text-center font-bold text-xl mt-40 mb-7">PROYECTOS / PORTAFOLIO</h2>
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
                <h2 class="font-bold mb-7 text-2xl text-center col-span-full">
                    Algunos de nuestros clientes
                </h2>
                <Clients />
            </section>
            
            <!-- Proyectos propios -->
            <section class="mt-40 mx-5 lg:w-[60%] lg:mx-auto">
                <h2 class="font-bold mb-7 text-2xl text-center col-span-full">
                    Proyectos propios
                </h2>

            </section>

            <!-- testimonies -->
            <section class="hidden lg:block lg:mx-24 mx-1 mt-9 relative">
                <SpanishTestimonies />
            </section>


            <section class="lg:mx-24 mx-1 mt-9 relative" id="Contacto">
                <h2 class="font-bold mb-3 text-xl text-center">Cuentanos tu idea</h2>

                <div class="lg:grid grid-cols-2 gap-9 mb-6">
                    <form @submit.prevent="store">
                        <div class="mb-5">
                            <label for="name">Nombre <span class="text-red-500">*</span></label>
                            <input v-model="form.name" type="text" id="name" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu nombre" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.name">{{ form.errors?.name }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="email">Correo <span class="text-red-500">*</span></label>
                            <input v-model="form.email" type="email" id="email" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu correo" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.mail">{{ form.errors?.mail }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="phone">Teléfono</label>
                            <input v-model="form.phone" type="text" id="phone"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu telefono" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.phone">{{ form.errors?.phone }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="service">Servicio</label>
                            <select v-model="form.service" id="service"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Selecciona el servicio">
                                <option value="Tienda en linea">Tienda en linea</option>
                                <option value="Marketing digital">Marketing digital</option>
                                <option value="Landing page">Landing page</option>
                                <option value="ERP">ERP</option>
                                <option value="CRM">CRM</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <textarea v-model="form.message" rows="5" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px]"
                                placeholder="Mensaje"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors?.message">{{ form.errors?.message }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="terms" class="flex items-center">
                                <input v-model="form.info" type="checkbox" id="terms"
                                    class="mr-2 active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] text-[#7F659C] rounded-[10px]" />
                                Acepto recibir información sobre el servicio
                            </label>
                        </div>
                        <button type="submit"
                            class="mx-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                            Enviar
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                    <div class="hidden lg:flex items-center justify-center bg-[#262626] rounded-[20px] h-2/3">
                        <video class="rounded-md" autoplay loop>
                            <source src="@/../../public/assets/vidios/dtw.mp4" type="video/mp4">
                            Tu navegador no soporta el elemento de video.
                        </video>
                    </div>
                </div>
            </section>
            
            <!-- Footer -->
            <SpanishFooter />
        </main>
    </main>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import Clients from "@/Components/MyComponents/Landing/Clients.vue";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";
import SpanishFooter from "@/Components/MyComponents/Landing/SpanishFooter.vue";
import SpanishProjects from "@/Components/MyComponents/Landing/SpanishProjects.vue";
import SpanishTestimonies from "@/Components/MyComponents/Landing/SpanishTestimonies.vue";

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
                'Sistemas de gestión',
                'Tiendas en línea',
                'Sitios web',
            ],
        };
    },
    components: {
        SpanishTestimonies,
        SpanishProjects,
        SpanishFooter,
        SpanishNav,
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
