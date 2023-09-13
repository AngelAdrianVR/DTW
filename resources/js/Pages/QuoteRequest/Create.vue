<template>
    <Head title="Bienvenido" />
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
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="$inertia.visit('/')">Inicio</button>
            <!-- <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Servicios')">Servicios</button> -->
            <!-- <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Contacto')">Contacto</button> -->
            <button class="mx-2 py-2 hover:bg-[#7F659C] rounded-lg" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button>
            <ul v-if="showMore" class="text-center p-3">
                <li @click="$inertia.get(route('us'))" class="hover:bg-[#7F659C] rounded-lg p-1">Nosotros</li>
                <li @click="$inertia.get(route('quote-request.create'))" class="hover:bg-[#7F659C] rounded-lg p-1">Cotizar</li>
                <li @click="$inertia.get(route('packages'))" class="hover:bg-[#7F659C] rounded-lg p-1">Paquetes programación</li>
             </ul>
            <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C] font-bold text-[#7F659C]">ES</span></Link>
             </button>
        </div>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="flex items-center justify-between py-4 lg:px-10 px-6 w-full">
            <div class="flex space-x-2 items-center">
                <img @click="$inertia.visit('/')" src="@/../../public/assets/images/dtw_logo.png" class="h-10 cursor-pointer" alt="logo" />
                <span>Digital TW</span>
            </div>
            <button @click="showMobileMenu = !showMobileMenu" class="lg:hidden">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="mr-12 hidden lg:inline relative">
                <button class="mx-2 hover:text-[#7F659C]" @click="$inertia.visit('/')">Inicio</button> |
                <!-- <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Servicios')">Servicios</button> | -->
                <!-- <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Contacto')">Contacto</button> | -->
                <button class="mx-2 hover:text-[#7F659C]" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button> |
                <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C] font-bold text-[#7F659C]">ES</span></Link>
             </button>
             <ul v-if="showMore" class="absolute right-0 p-3 bg-white">
                <li @click="$inertia.get(route('us'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Nosotros</li>
                <li @click="$inertia.get(route('quote-request.create'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Cotizar</li>
                <li @click="$inertia.get(route('packages'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Paquetes programación</li>
             </ul>
            </div>
        </nav>

        <main class="pt-28 lg:px-28">
            <div class="lg:grid grid-cols-3 gap-x-8">
                <h1 class="text-[#7F659C] text-xl col-start-2 col-span-full mb-4 ml-3">Solicitar cotización</h1>
                <figure>
                    <img @click="$inertia.visit('/')" src="@/../../public/assets/images/quote-image.png">
                </figure>
                <div class="col-span-2">
                    <form @submit.prevent="store" class="grid grid-cols-2 gap-4">
                        <div class="mr-5">
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.name || focusName }"
                                >
                                    Nombre *
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
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.email || focusEmail }"
                                >
                                    Correo electrónico *
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
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.phone || focusPhone }"
                                >
                                    Teléfono *
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
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.business_name || focusBusinessName }"
                                >
                                    Nombre de tu empresa o negocio
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
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.info || focusInfo }"
                                >
                                    Referencias o URL relevantes
                                </label>
                                <input v-model="form.info"
                                    @focus="focusInfo = true"
                                    @blur="focusInfo = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                                <el-tooltip
                                class="box-item"
                                effect="dark"
                                content="Si tienes algún sitio web, dejános el link "
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
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.business_type || focusBusinessType }"
                                >
                                    Tipo de indistria o negocio
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
                                <select v-model="form.proyect_type" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option class="hover:bg-[#7F659C]" value="Tipo de proyecto" disabled>-- Tipo de proyecto --</option>
                                    <option class="hover:bg-[#7F659C]" value="">Página web a la medida</option>
                                    <option class="hover:bg-[#7F659C]" value="">Tienda en línea</option>
                                    <option class="hover:bg-[#7F659C]" value="">Gestor de clientes</option>
                                    <option class="hover:bg-[#7F659C]" value="">Gestor de compras y ventas</option>
                                    <option class="hover:bg-[#7F659C]" value="">Gestor de proyectos</option>
                                    <option class="hover:bg-[#7F659C]" value="">Gestor de inventarios</option>
                                </select>
                                <el-tooltip
                                class="box-item"
                                effect="dark"
                                content="Selecciona el tipo de proyecto que consideres que puedes necesitar"
                                placement="right-start"
                                >
                                <i class="fa-regular fa-circle-question text-[#7F659C] absolute -right-5 top-[12px]"></i>
                                </el-tooltip>
                            </div>
                        </div>
                        <div>
                            <div class="lg:w-full">
                                <select v-model="form.budget" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option value="Presupuesto estimado" selected disabled>-- Presupuesto estimado --</option>
                                    <option value="">Opcion 1</option>
                                    <option value="">Opcion 2</option>
                                    <option value="">Opcion 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full mt-3">
                            <h2 class="text-[#7F659C] text-lg mb-2 ml-3">Describenos tu idea</h2>
                            <textarea
                                class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px]"
                                rows="5"
                                placeholder="Por favor proporcione detalles adicionales o requisitos específicos para su proyecto si es necesario."></textarea>
                        </div>
                        <div>
                            <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-white px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.how_found_us || focusHowFoundUs }"
                                >
                                    ¿Cómo nos encontraste?
                                </label>
                                <input v-model="form.how_found_us"
                                    @focus="focusHowFoundUs = true"
                                    @blur="focusHowFoundUs = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                        </div>
                        </div>
                        <button type="submit"
                            class="col-span-full mx-auto mt-5 rounded-[10px] border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                            Enviar
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                </div>
            </div>
        </main>
        <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative">
            <figure>
                <img class="md:w-[3%] w-[7%]" src="@/../../public/assets/images/dtw_logo.png" alt="site logo" />
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
            <a class="hidden md:block" href="">
                <p class="text-xs mt-3 md:absolute bottom-2 left-5 hover:underline">
                    Política de privacidad - Plítica de cookies
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

export default {
    data() {
        const form = useForm({
            name: null,
            email: null,
            phone: null,
            service: null,
            message: null,
            info: null,
            business_type: null,
            how_found_us: null,
            proyect_type: 'Tipo de proyecto',
            budget: 'Presupuesto estimado',
        });
        return {
            form,
            isNavbarFixed: false,
            showMore:false,
            currentTestimony: 0,
            lastScrollY: 0,
            showMobileMenu: false,
            focusName: false,
            focusEmail: false,
            focusPhone: false,
            focusBusinessName: false,
            focusInfo: false,
            focusBusinessType: false,
            focusHowFoundUs: false,
        };
    },
    components: {
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
    components: {
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
