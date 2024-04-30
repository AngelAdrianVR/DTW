<template>
    <div class="relative">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
        </a>

        <!-- mobile menu (hamburger) -->
        <div v-if="showMobileMenu"
            class="flex flex-col z-30 w-2/3 bg-[#262626] rounded-xl fixed top-20 right-1 border-white border py-1 text-white">
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Inicio')">Home</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Servicios')">Services</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Contacto')">Contact</button>
            <button class="mx-2 py-2 hover:bg-[#7F659C] rounded-lg" @click="showMore = !showMore">More <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button>
            <ul v-if="showMore" class="text-center p-3 my-2">
                <li @click="$inertia.get(route('us-en'))" class="hover:bg-[#7F659C] rounded-lg p-1">About us</li>
                <li @click="$inertia.get(route('create-quote-en.create'))" class="hover:bg-[#7F659C] rounded-lg p-1">Quote</li>
                <li @click="$inertia.get(route('packages-en'))" class="hover:bg-[#7F659C] rounded-lg p-1">Sowtare packages</li>
             </ul>
            <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C] mt-3">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
             </button>

        </div>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="flex items-center justify-between py-4 lg:px-10 px-6 w-full">
            <div class="flex space-x-2 items-center">
                <img src="@/../../public/assets/images/black_logo.png" class="h-12 cursor-pointer" alt="logo" />
            </div>
            <button @click="showMobileMenu = !showMobileMenu" class="lg:hidden">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="mr-12 hidden lg:inline">
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Inicio')">Home</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Servicios')">Services</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Contacto')">Contact</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="showMore = !showMore">More <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button> |
                <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
             </button>
             <ul v-if="showMore" class="absolute right-24 p-3 bg-white">
                <li @click="$inertia.get(route('us-en'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">About us</li>
                <li @click="$inertia.get(route('create-quote-en.create'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Quote</li>
                <li @click="$inertia.get(route('packages-en'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Software packages</li>
             </ul>
            </div>
        </nav>

        <main class="pt-20">
            <!-- first section desktop -->
            <section class="hidden lg:grid grid-cols-2 gap-x-10 h-96 mx-14" id="Inicio">
                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                </figure>
                <div class="flex-col justify-center py-14">
                    <h1 class="font-bold lg:text-7xl text-lg text-center">Custom web design</h1>
                    <p class="mt-9">
                        We create customized websites, unique and personalized according to your
                         needs, from corporate sites, online stores,
                         informative.
                    </p>
                    <button @click="$inertia.get(route('create-quote-en.create'))"
                        class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Quote my site
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>
            <!-- first section mobile -->
            <section class="h-96 mx-14 mb-24 lg:hidden" id="Inicio">
                <h1 class="font-bold lg:text-7xl text-lg text-center">Custom web design</h1>
                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                </figure>
                <button
                    class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                    Quote my site
                    <i class="fa-solid fa-chevron-right ml-6"></i>
                </button>
                <p class="mt-9 text-justify">
                    We create customized websites, unique and personalized according to your
                     needs, from corporate sites, online stores,
                     informative.
                </p>
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
                    <!-- <figure class="rounded-[20px] hidden lg:block">
                        <img class="rounded-[20px]" src="@/../../public/assets/images/contact.png" />
                    </figure> -->
                </div>
            </section>

            <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative overflow-auto">
                <figure>
                    <img class="md:w-[6%] w-[29%]" src="@/../../public/assets/images/white_logo.png" alt="" />
                </figure>
                <div class="md:grid grid-cols-3 h-28">
                    <div class="border-r border-white flex justify-center items-cente">
                        <p class="text-lg">"Unlocking your online potential"</p>
                    </div>

                    <div class="border-r border-white flex justify-center items-center">
                        <div class="flex flex-col">
                            <h2 class="text-center mb-5 text-xl">Contact</h2>
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
                            <h2 class="text-center mb-5 text-xl">Follow us!</h2>
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
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 md:absolute bottom-2 left-5 hover:underline">
                        Privacy Policy - Cookie Policy
                    </p>
                </a>
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 md:absolute bottom-2 left-96 hover:underline">
                        Copyright | 2023 | All rights reserved by Digital TW S.A
                         de C.V.
                    </p>
                </a>
            </footer>
        </main>
    </div>
</template>

<script>
import { useForm, Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import InputError from "@/Components/InputError.vue";
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
      Link,
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
</style>
