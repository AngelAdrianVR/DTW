<script>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';

export default {
    data() {
        return {
            showMore: false,
            isNavbarFixed: false,
            lastScrollY: 0,
            showMobileMenu: false,
        }
    },
    props: {
        title: String
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
    },
    components: {
        Head,
        Link,
        ApplicationMark,
        Banner,
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        this.toast = useToast();
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
}


</script>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen bg-zinc-200">
            <!-- navbar -->
            <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
                class="flex items-center justify-between py-4 lg:px-10 px-6 w-full">
                <div class="flex space-x-2 items-center">
                    <img src="../../../public/assets/images/dtw_logo.png" class="h-10 cursor-pointer" alt="logo" />
                    <span>Digital TW</span>
                </div>
                <button @click="showMobileMenu = !showMobileMenu" class="lg:hidden">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>
                <div class="mr-12 hidden lg:inline relative">
                    <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Inicio')">Inicio</button> |
                    <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Servicios')">Servicios</button> |
                    <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Contacto')">Contacto</button> |
                    <button class="mx-2 hover:text-[#7F659C]" @click="showMore = !showMore">Más <i
                            class="fa-solid fa-angle-down ml-1 text-sm"></i></button> |
                    <button class="mx-2">
                        <Link :href="route('dtw-en')"><span
                            :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : ''"
                            class="hover:text-[#7F659C]">EN</span></Link>
                        /
                        <Link :href="route('dtw')"><span
                            :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : ''"
                            class="hover:text-[#7F659C]">ES</span></Link>
                    </button>
                    <ul v-if="showMore" class="absolute right-0 p-3 bg-white">
                        <li @click="$inertia.get(route('us'))"
                            class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Nosotros</li>
                        <li @click="$inertia.get(route('create-quote'))"
                            class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Cotizar</li>
                        <li @click="$inertia.get(route('packages'))"
                            class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Paquetes programación</li>
                    </ul>
                </div>
            </nav>

            <!-- mobile menu (hamburger) -->
            <div v-if="showMobileMenu"
                class="flex flex-col z-30 w-2/3 bg-[#262626] rounded-xl fixed top-20 right-1 border-white border py-1 text-white">
                <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg"
                    @click="scrollToSection('Inicio')">Inicio</button>
                <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg"
                    @click="scrollToSection('Servicios')">Servicios</button>
                <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg"
                    @click="scrollToSection('Contacto')">Contacto</button>
                <button class="mx-2">
                    <Link :href="route('dtw-en')"><span
                        :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : ''"
                        class="hover:text-[#7F659C]">EN</span></Link>
                    /
                    <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : ''"
                        class="hover:text-[#7F659C]">ES</span></Link>
                </button>
            </div>

            <!-- Page Content -->
            <main>
                <slot />

                <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative">
                    <figure>
                        <img class="md:w-[3%] w-[7%]" src="../../../public/assets/images/dtw_logo.png" alt="" />
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
        </div>
    </div>
</template>
