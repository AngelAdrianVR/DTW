<template>
    <Head title="Welcome" />
    <div class="relative selection:bg-primarylight selection:text-primary bg-black text-white">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523322268824&text=Hello!%20I%20saw%20your%20webpage%20DTW,%20i'm%20interesting%20on%20a%20service!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
        </a>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
            <EnglishNav @scrolling="scrollToSection($event)" />
        </nav>

        <main class="pt-24">
            <!-- first section desktop -->
            <section class="md:grid grid-cols-2 gap-x-10 md:mx-14 mx-2 p-8 border border-white rounded-xl" id="Inicio">
                <div class="flex-col justify-center py-14">
                    <h1 class="font-bold lg:text-7xl text-lg text-center">Custom web design</h1>
                    <p class="mt-9">
                        We create customized websites, unique and personalized according to your
                        needs, from corporate sites, online stores,
                        informative.
                    </p>
                </div>

                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                    <button @click="$inertia.get(route('quote-request.create'))"
                        class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Quote my site
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </figure>
            </section>

            <!-- Servicios -->
            <section id="Servicios" class="lg:mx-32 mx-5">
                <h2 class="text-center font-bold text-2xl mt-40 mb-7">Services</h2>
                <Services :language="'english'" />
            </section>

            <!-- Poryectos y portafolio -->
            <section class="mt-10">
                <h2 class="text-center font-bold text-2xl mt-40 mb-7">PROJECTS / PORTFOLIO</h2>
                <div class="custom-style text-center">
                    <el-segmented v-model="filterProjects" :options="projectsFilter" />
                </div>

                <!-- proyectos segun el filtro seleccionado -->
                <article class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-4 mt-14 mx-5 lg:w-[65%] lg:mx-auto">
                    <EnglishProjects :filterProjects="filterProjects" />
                </article>
            </section>

             <!-- Clients -->
            <section class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-7 mt-40 mx-5 lg:w-[60%] lg:mx-auto">
                <h2 class="font-bold mb-9 text-2xl text-center col-span-full">
                    SOME OF OUR CLIENTS
                </h2>
                <Clients />
            </section>

            <!-- Proyectos propios -->
            <section class="mt-40 mx-5 xl:w-[80%] xl:mx-auto">
                <h2 class="font-bold mb-14 text-2xl text-center col-span-full">
                    OWN PROJECTS
                </h2>
                <OwnProjects :language="'english'" />
            </section>

            <!-- testimonies -->
            <section class="hidden lg:block lg:mx-24 mx-1 my-28 relative">
                <h2 class="font-bold mb-3 text-xl text-center">
                    OUR CLIENTS SPEAK FOR US
                </h2>
                <Testimonies :language="'english'" />
            </section>

            <section class="lg:mx-24 mx-5 mt-9 relative" id="Contacto">
                <h2 class="font-bold mb-10 text-xl text-center">TELL US YOUR IDEA</h2>

                <div class="lg:grid grid-cols-2 gap-9 mb-6">
                    <form @submit.prevent="store">
                        <div class="mb-5">
                            <label class="ml-4" for="name">Name <span class="text-red-500">*</span></label>
                            <input v-model="form.name" type="text" id="name" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your name" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.name">{{ form.errors?.name }}</p>
                        </div>
                        <div class="mb-5">
                            <label class="ml-4" for="email">Email <span class="text-red-500">*</span></label>
                            <input v-model="form.email" type="email" id="email" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your email" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.mail">{{ form.errors?.mail }}</p>
                        </div>
                        <div class="mb-5">
                            <label class="ml-4" for="phone">Phone</label>
                            <input v-model="form.phone" type="text" id="phone"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your phone" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.phone">{{ form.errors?.phone }}</p>
                        </div>
                        <div class="mb-5">
                            <label class="ml-4" for="service">Services</label>
                            <select v-model="form.service" id="service"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Select a service">
                                <option value="Tienda en linea">E-comerce</option>
                                <option value="Marketing digital">Digital marketing</option>
                                <option value="Landing page">Landing page</option>
                                <option value="ERP">ERP</option>
                                <option value="CRM">CRM</option>
                                <option value="Otro">Other</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <textarea v-model="form.message" rows="5" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px]"
                                placeholder="Message"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors?.message">{{ form.errors?.message }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="terms" class="flex items-center">
                                <input v-model="form.info" type="checkbox" id="terms"
                                    class="mr-2 active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] text-[#7F659C] rounded-[10px]" />
                                I agree to receive information about the service
                            </label>
                        </div>
                        <button type="submit"
                            class="mx-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                            Send
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                    <div class="hidden lg:flex items-center justify-center bg-[#262626] rounded-[20px] h-2/3">
                        <video class="rounded-md" autoplay loop>
                            <source src="@/../../public/assets/vidios/dtw.mp4" type="video/mp4">
                            Your browser does not support the video element.
                        </video>
                    </div>
                </div>
            </section>

            <!-- Footer -->
            <EnglishFooter />
        </main>
    </div>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import Clients from "@/Components/MyComponents/Landing/Clients.vue";
import Services from "@/Components/MyComponents/Landing/Services.vue";
import EnglishNav from "@/Components/MyComponents/Landing/EnglishNav.vue";
import OwnProjects from "@/Components/MyComponents/Landing/OwnProjects.vue";
import EnglishFooter from "@/Components/MyComponents/Landing/EnglishFooter.vue";
import EnglishProjects from "@/Components/MyComponents/Landing/EnglishProjects.vue";
import Testimonies from "@/Components/MyComponents/Landing/Testimonies.vue";

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
            lastScrollY: 0,
            showMobileMenu: false,
            showMore: false,
            filterProjects: 'All', //filtro de proyectos
            projectsFilter: [
                'All',
                'Management systems',
                'Online stores',
                'Web sites',
            ],
        };
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        this.toast = useToast();
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
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
            this.showMobileMenu = false;
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
    components:{
        EnglishProjects,
        EnglishFooter,
        Testimonies,
        OwnProjects,
        EnglishNav,
        Services,
        Clients,
        Link,
        Head,
    }
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
  --el-segmented-color: #FFFFFF;
  --el-segmented-item-selected-color: #7F659C;
  --el-segmented-item-selected-bg-color: #a1a1a1;
  --el-border-radius-base: 16px;
}
</style>
