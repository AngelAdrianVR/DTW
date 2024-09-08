<template>
    <Head title="Welcome" />
    <div class="relative selection:bg-primarylight selection:text-primary bg-black min-h-screen text-white">
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

        <main class="pt-28 lg:px-28">
            <div class="lg:grid grid-cols-3 gap-x-8">
                <h1 class="text-[#7F659C] text-xl col-start-2 col-span-full mb-4 ml-3">Request quote</h1>
                <figure>
                    <img @click="$inertia.visit('/')" src="@/../../public/assets/images/quote-image.png">
                </figure>
                <div class="col-span-2">
                    <form @submit.prevent="store" class="grid grid-cols-2 gap-4">
                        <div class="mr-5">
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.name || focusName }"
                                >
                                    Name *
                                </label>
                                <input v-model="form.name"
                                    @focus="focusName = true"
                                    @blur="focusName = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.name">{{ form.errors?.name }}</p>
                        </div>
                        <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.email || focusEmail }"
                                >
                                    Email*
                                </label>
                                <input v-model="form.email"
                                    @focus="focusEmail = true"
                                    @blur="focusEmail = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.email">{{ form.errors?.email }}</p>
                        </div>
                        <div class="mr-5">
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.phone || focusPhone }"
                                >
                                    Phone *
                                </label>
                                <input v-model="form.phone"
                                    @focus="focusPhone = true"
                                    @blur="focusPhone = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.phone">{{ form.errors?.phone }}</p>
                        </div>
                        <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.business_name || focusBusinessName }"
                                >
                                    Name of your company or business
                                </label>
                                <input v-model="form.business_name"
                                    @focus="focusBusinessName = true"
                                    @blur="focusBusinessName = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.business_name">{{ form.errors?.business_name
                            }}</p>
                        </div>
                        <div class="mr-5">
                            <div class="lg:w-full relative">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.related_sites || focusrelated_sites }"
                                >
                                    Relevant references or URLs
                                </label>
                                <input v-model="form.related_sites"
                                    @focus="focusrelated_sites = true"
                                    @blur="focusrelated_sites = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                                <el-tooltip
                                class="box-item"
                                effect="dark"
                                content="If you have a website, leave us the link"
                                placement="right-start"
                                >
                                <i class="fa-regular fa-circle-question text-[#7F659C] absolute -right-5 top-[10px]"></i>
                                </el-tooltip>
                            </div>
                        </div>
                        <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.business_type || focusBusinessType }"
                                >
                                    Type of industry or business
                                </label>
                                <input v-model="form.business_type"
                                    @focus="focusBusinessType = true"
                                    @blur="focusBusinessType = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                        </div>
                        <div class="mr-5">
                            <div class="lg:w-full relative">
                                <select v-model="form.project_type" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option class="hover:bg-[#7F659C]" value="Tipo de proyecto" disabled>-- Type of project --</option>
                                    <option class="hover:bg-[#7F659C]" value="Custom website">Custom website</option>
                                    <option class="hover:bg-[#7F659C]" value="Online store">Online store</option>
                                    <option class="hover:bg-[#7F659C]" value="Client manager">Client manager</option>
                                    <option class="hover:bg-[#7F659C]" value="Purchasing and sales manager">Purchasing and sales manager</option>
                                    <option class="hover:bg-[#7F659C]" value="Project manager">Project manager</option>
                                    <option class="hover:bg-[#7F659C]" value="Inventory manager">Inventory manager</option>
                                </select>
                                <el-tooltip
                                class="box-item"
                                effect="dark"
                                content="Select the type of project that you think you may need"
                                placement="right-start"
                                >
                                <i class="fa-regular fa-circle-question text-[#7F659C] absolute -right-5 top-[12px]"></i>
                                </el-tooltip>
                            </div>
                        </div>
                        <div>
                            <div class="lg:w-full">
                                <select v-model="form.estimate" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option value="Presupuesto estimado" selected disabled>-- Estimated budget --</option>
                                    <option value="100 - 500 $USD">100 - 500 $USD </option>
                                    <option value="500 - 1,500 $USD">500 - 1,500 $USD</option>
                                    <option value="1,500 - 3,000 $USD">1,500 - 3,000 $USD</option>
                                    <option value="+ 3,000 $USD">+ 3,000 $USD</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full mt-3">
                            <h2 class="text-[#7F659C] text-lg mb-2 ml-3">Describe us your idea</h2>
                            <textarea v-model="form.project_description"
                                class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px]"
                                rows="5"
                                placeholder="Please provide additional details or specific requirements for your project if necessary."></textarea>
                        </div>
                        <div>
                            <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.way_of_knowing || focusWay_of_knowing }"
                                >
                                    How did you find us?
                                </label>
                                <input v-model="form.way_of_knowing"
                                    @focus="focusWay_of_knowing = true"
                                    @blur="focusWay_of_knowing = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                        </div>
                        </div>
                        <button type="submit"
                            class="col-span-full mx-auto mt-5 rounded-[10px] border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                            Send
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative">
            <figure>
                <img class="md:w-[6%] w-[29%]" src="@/../../public/assets/images/white_logo.png" alt="site logo" />
            </figure>
            <div class="md:grid grid-cols-3 h-28">
                <div class="border-r border-white flex justify-center items-cente">
                    <p class="text-lg">"Unlocking your potential online"</p>
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
                    Privacy policy - Cookies policy
                </p>
            </a>
            <a class="hidden md:block" href="">
                <p class="text-xs mt-3 md:absolute bottom-2 left-96 hover:underline">
                    Copyright | 2023 | Todos los derechos reservados por Digital TW S.A
                    de C.V.
                </p>
            </a>
        </footer>
    </div>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import EnglishNav from "@/Components/MyComponents/Landing/EnglishNav.vue";

export default {
    data() {
        const form = useForm({
            name: null,
            email: null,
            phone: null,
            service: null,
            message: null,
            related_sites: null,
            business_type: null,
            business_name: null,
            way_of_knowing: null,
            project_description: null,
            project_type: 'Type of project',
            estimate: 'Estimated budget',
        });
        return {
            form,
            isNavbarFixed: false,
            currentTestimony: 0,
            lastScrollY: 0,
            focusName: false,
            focusEmail: false,
            focusPhone: false,
            focusBusinessName: false,
            focusrelated_sites: false,
            focusBusinessType: false,
            focusHowFoundUs: false,
        };
    },
    components: {
        EnglishNav,
        Head,
        Link,
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
            this.form.post(route("quote-request.store"), {
                onSuccess: () => {
                    this.$notify({
                        title: 'Success',
                        message: "The data has been sent. We will send you the quote as soon as possible",
                        type: 'success'
                    });
                    this.form.reset();
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
.input-container {
  position: relative;
}
.input-placeholder {
  position: absolute;
  top: 55%;
  left: 8px;
  transform: translateY(-50%);
  transition: transform 0.2s ease-in-out, color 0.1s ease-in-out;
  pointer-events: none;
}
.input-placeholder.active {
  transform: translateY(-150%) scale(0.75);
  color: #7F659C;
}
select option:checked {
  background-color: #7F659C; /* Cambia este color al que desees */
  color: white; /* Cambia el color del texto si es necesario */
}
select option:hover {
  background-color: #7F659C; /* Cambia este color al que desees */
  color: white; /* Cambia el color del texto si es necesario */
}
select option {
  background-color: #fff; /* Cambia este color al que desees */
  color: black; /* Cambia el color del texto si es necesario */
  border-radius: 5px; /* Redondea las esquinas */
  padding: 5px; /* Agrega padding de 5px */
}
</style>
