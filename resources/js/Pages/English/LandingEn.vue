<template>
    <Head title="Welcome" />
    <div class="relative selection:bg-primarylight selection:text-primary bg-black text-white">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523312155731&text=Hello!%20I%20saw%20your%20webpage%20DTW,%20i'm%20interesting%20on%20a%20service!"
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

            <!-- Poryectos y portafolio -->
            <section class="mt-10">
                <div class="custom-style text-center">
                    <el-segmented v-model="filterProjects" :options="projectsFilter" />
                </div>
            </section>

            <section class="mt-10">
                <h1 class="text-center text-white text-3xl py-6 bg-[#1A1A1A]">Some of our projects</h1>
                <div class="bg-[#262626] py-12 flex">
                    <!-- <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </div> -->
                    <div class="w-full lg:grid grid-cols-3">
                        <a href="https://www.emblemas3d.com" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-01.png">
                        </a>
                        <!-- <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-02.png"> -->
                        <a href="https://youpartner.xphere.com.mx" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-03.png">
                        </a>
                        <!-- <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-04.png"> -->
                        <a href="https://sigmasolutionsmx.com" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-05.png">
                        </a>
                        <!-- <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-06.png"> -->
                    </div>
                    <!-- <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div> -->
                </div>
            </section>

            <!-- landing 3 desktop -->
            <section class="hidden lg:block lg:mx-24 mx-1 mt-9 relative">

                <div class="text-center" id="Servicios">
                    <h2 class="font-bold mb-3 text-xl">SERVICES</h2>
                    <p>
                        We create unique designs, programming and functionality for your brand.
                    </p>
                </div>

                <div class="lg:grid grid-cols-2 gap-x-10">
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing2.png" alt="computer" />
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Custom website design and development
                        </h1>
                        <p class="mt-9 text-center">
                            We create unique and exclusive designs for each client, experience
                             of user (UI/UX), responsiveness and compatibility in different
                             devices, source code development (SEO) for a
                             proper positioning in search engines and much more...
                        </p>
                    </div>

                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Maintenance and updating of web pages
                        </h1>
                        <p class="mt-9 text-center">
                            Updating of content and software, improvements to the design of the
                             page, technical support, performance optimization,
                             routine maintenance on the front and back end and more...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing3.png" alt="computer" />
                    </figure>

                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing4.png" alt="computer" />
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Back end - Front end Develop
                        </h1>
                        <p class="mt-9 text-center">
                            We implement technology to streamline processes, such as ERP, CRM
                             CMS and much more...
                        </p>
                    </div>

                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Marketing digital</h1>
                        <p class="mt-9 text-center">
                            Increase your sales, expand your market and potentiate your
                             business. We create digital advertising through social networks and
                             further...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing5.png" alt="computer" />
                    </figure>
                </div>

                <div class="text-center">
                    <h3>A customized website, with guarantee of operation</h3>
                    <button
                        class="mx-auto mt-2 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Request your quote without obligation
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <!-- landing 3 mobile -->
            <section class="lg:hidden lg:mx-24 mx-1 mt-9 relative">
                <!-- bg decorations -->
                <img class="absolute top-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute top-72 -right-0 -z-10 rotate-180" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute bottom-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <!-- end decorations -->

                <div class="text-center" id="Servicios">
                    <h2 class="font-bold mb-3 text-xl">SERVICES</h2>
                    <p>
                        We create unique designs, programming and functionality for your brand.
                    </p>
                </div>

                <div class="lg:grid grid-cols-2 gap-x-10">
                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Custom website design and development
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing2.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            We create unique and exclusive designs for each client, experience
                             of user (UI/UX), responsiveness and compatibility in different
                             devices, source code development (SEO) for a
                             proper positioning in search engines and much more...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Maintenance and updating of web pages
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing3.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Updating of content and software, improvements to the design of the
                             page, technical support, performance optimization,
                             routine maintenance on the front and back end and more...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                             Back end - Front end Develop
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing4.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            We implement technology to streamline processes, such as ERP, CRM
                             CMS and much more...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Digital marketing
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing5.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Increase your sales, expand your market and potentiate your
                             business. We create digital advertising through social networks and
                             further...
                        </p>
                    </article>
                </div>

                <div class="text-center">
                    <h3>A customized website, with guarantee of operation</h3>
                    <button
                        class="mx-auto mt-2 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Request your quote without obligation
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <section class="mt-10">
                <div class="bg-[#262626] lg:grid grid-cols-2 items-center justify-center px-14 py-2">
                    <figure class="h-72">
                        <img class="h-full" src="@/../../public/assets/images/landing6.png" />
                    </figure>
                    <div class="text-center text-white">
                        <h2 class="font-bold">
                            Responsive websites that look perfect anywhere
                             device
                        </h2>
                        <p>
                            From smartphones and tablets, to desktop computers,
                             our designs fit perfectly to provide a
                             optimal user experience on any screen.
                        </p>
                    </div>
                </div>
                <h1 class="w-full text-center text-white lg:text-3xl text-sm py-6 bg-[#1A1A1A]">
                    Let us know what you need and we will make it possible
                </h1>
            </section>

            <!-- testimonies desktop -->
            <section class="hidden lg:block lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">
                    Our clients speak for us
                </h2>

                <div class="lg:grid grid-cols-2 gap-9">
                    <div v-for="(testimony, index) in testimonies" :key="index"
                        class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2">
                        <div class="grid grid-cols-4 gap-x-2 text-white">
                            <div class="flex-col space-y-2 items-center justify-center">
                                <figure class="rounded-full w-16 h-16">
                                    <img :src="testimony.imgPath" />
                                </figure>
                                <span>{{ testimony.name }}</span>
                            </div>
                            <div class="col-span-3">
                                <p>{{ testimony.text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- testimonies mobil -->
            <section class="lg:hidden lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">
                    Our clients speak for us
                </h2>

                <div class="lg:grid grid-cols-2 gap-9">
                    <div class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2 flex text-white">
                        <div @click="currentTestimony = currentTestimony == 0 ? (testimonies.length - 1) : currentTestimony - 1"
                            class="w-8 mr-2 flex justify-center items-center">
                            <button>
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                        </div>
                        <div class="w-full">
                            <div class="flex-col space-y-2 items-center justify-center mb-3">
                                <figure class="rounded-full w-16 h-16 mx-auto">
                                    <img :src="testimonies[currentTestimony].imgPath" />
                                </figure>
                                <p class="text-center">{{ testimonies[currentTestimony].name }}</p>
                            </div>
                            <div class="col-span-3 text-justify">
                                <p>{{ testimonies[currentTestimony].text }}</p>
                            </div>
                        </div>
                        <div @click="currentTestimony = currentTestimony == (testimonies.length - 1) ? 0 : currentTestimony + 1"
                            class="w-8 ml-2 flex justify-center items-center">
                            <button>
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="lg:mx-24 mx-1 mt-9 relative" id="Contacto">
                <h2 class="font-bold mb-3 text-xl text-center">Tell us your idea</h2>

                <div class="lg:grid grid-cols-2 gap-9 mb-6">
                    <form @submit.prevent="store">
                        <div class="mb-5">
                            <label for="name">Name <span class="text-red-500">*</span></label>
                            <input v-model="form.name" type="text" id="name" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your name" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.name">{{ form.errors?.name }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="email">Email <span class="text-red-500">*</span></label>
                            <input v-model="form.email" type="email" id="email" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your email" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.mail">{{ form.errors?.mail }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="phone">Phone</label>
                            <input v-model="form.phone" type="text" id="phone"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Write your phone" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.phone">{{ form.errors?.phone }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="service">Services</label>
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
import EnglishNav from "@/Components/MyComponents/Landing/EnglishNav.vue";
import EnglishFooter from "@/Components/MyComponents/Landing/EnglishFooter.vue";
import e3dtest from '@/../../public/assets/images/e3dtest.png';
import churrotest from '@/../../public/assets/images/churrotest.png';
import profibratest from '@/../../public/assets/images/profibratest.png';

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
            showMobileMenu: false,
            showMore: false,
            filterProjects: 'Todo', //filtro de proyectos
            projectsFilter: [
                'Todo',
                'Sistemas ERP',
                'Tiendas en línea',
                'Sitios web',
            ],
            testimonies: [
                {
                    imgPath: e3dtest,
                    name: 'J. Sherman',
                    text: 'The ERP system developed by DTW has completely transformed the way we run our business. The customized solution was perfectly adapted to our operations and has allowed us to streamline our processes, improve visibility and make informed decisions in real time.'
                },
                {
                    imgPath: churrotest,
                    name: 'Rocio R.',
                    text: 'I want to thank the DTW team for their creativity and professionalism in creating my website. They have managed to perfectly capture the vision I had in mind and have exceeded my expectations.'
                },
                {
                    imgPath: profibratest,
                    name: 'Jose Ricardo',
                    text: 'I highly recommend DTWs work, it adapts to what you need and even recommends improvements, always attentive to all doubts you have, and also to any changes you need. Widely recommended.'
                },
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
        EnglishFooter,
        EnglishNav,
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
