<template>
    <Head title="Cotiza tu servicio" />
    <div class="relative selection:bg-primarylight selection:text-primary bg-black text-white">
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

        <main class="pt-28 lg:px-10 mx-7">
            <div class="lg:grid grid-cols-3 lg:gap-x-5">
                <h1 class="text-white text-xl text-center font-bold col-start-2 col-span-full mb-7 ml-3">Solicitar cotización</h1>
                <figure class="hidden lg:block mb-5">
                    <img src="@/../../public/assets/images/quote-image.webp">
                </figure>
                <div class="col-span-2">
                    <form @submit.prevent="store" class="md:grid grid-cols-2 md:gap-5 space-y-4 md:space-y-0">
                        <div class="md:mr-5">
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.name || focusName }"
                                >
                                    Nombre *
                                </label>
                                <input v-model="form.name"
                                    @focus="focusName = true"
                                    @blur="focusName = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
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
                                    Correo electrónico *
                                </label>
                                <input v-model="form.email"
                                    @focus="focusEmail = true"
                                    @blur="focusEmail = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.email">{{ form.errors?.email }}</p>
                        </div>
                        <div class="md:mr-5">
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.phone || focusPhone }"
                                >
                                    Teléfono *
                                </label>
                                <input v-model="form.phone"
                                    @focus="focusPhone = true"
                                    @blur="focusPhone = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
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
                                    Nombre de tu empresa o negocio
                                </label>
                                <input v-model="form.business_name"
                                    @focus="focusBusinessName = true"
                                    @blur="focusBusinessName = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
                                </div>
                            </div>
                            <p class="text-red-600 text-xs" v-if="form.errors?.business_name">{{ form.errors?.business_name
                            }}</p>
                        </div>
                        <div class="md:mr-5">
                            <div class="lg:w-full relative">
                                <div class="input-container">
                                <label
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.related_sites || focusrelated_sites }"
                                >
                                    Referencias o URL relevantes
                                </label>
                                <input v-model="form.related_sites"
                                    @focus="focusrelated_sites = true"
                                    @blur="focusrelated_sites = false"
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
                                    class="input-placeholder text-gray-500 bg-black px-2 rounded-sm text-sm"
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
                        <div class="md:mr-5">
                            <div class="lg:w-full relative">
                                <select v-model="form.project_type" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option class="hover:bg-[#7F659C]" value="Tipo de proyecto" disabled>-- Tipo de proyecto --</option>
                                    <option class="hover:bg-[#7F659C]" value="Página web a la medida">Página web a la medida</option>
                                    <option class="hover:bg-[#7F659C]" value="Tienda en línea">Tienda en línea</option>
                                    <option class="hover:bg-[#7F659C]" value="Gestor de clientes">Gestor de clientes</option>
                                    <option class="hover:bg-[#7F659C]" value="Gestor de compras y ventas">Gestor de compras y ventas</option>
                                    <option class="hover:bg-[#7F659C]" value="Gestor de proyectos">Gestor de proyectos</option>
                                    <option class="hover:bg-[#7F659C]" value="Gestor de inventarios">Gestor de inventarios</option>
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
                                <select v-model="form.estimate" class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] text-[#9a9a9a] outline-none bg-transparent block w-full rounded-[10px] h-11 px-5">
                                    <option value="Presupuesto estimado" disabled>-- Presupuesto estimado --</option>
                                    <option value="2,000 - 6,000 $MXN">2,000 - 10,000 $MXN</option>
                                    <option value="6,000 - 12,000 $MXN">10,000 - 20,000 $MXN</option>
                                    <option value="12,000 - 25,000 $MXN">20,000 - 40,000 $MXN</option>
                                    <option value="25,000 - 50,000 $MXN">40,000 - 100,000 $MXN</option>
                                    <option value="+ 50,000 $MXN">+ 100,000 $MXN</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-full mt-3">
                            <h2 class="text-[#7F659C] text-lg mb-2 ml-3">Describenos tu idea</h2>
                            <textarea v-model="form.project_description"
                                class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px]"
                                rows="5"
                                placeholder="Por favor proporcione detalles adicionales o requisitos específicos para su proyecto si es necesario."></textarea>
                        </div>
                        <div>
                            <div>
                            <div class="lg:w-full">
                                <div class="input-container">
                                <label
                                    class="input-placeholder placeholder:text-sm text-gray-500 bg-black px-2 rounded-sm text-sm"
                                    :class="{ 'active': form.way_of_knowing || focusHowFoundUs }"
                                >
                                    ¿Cómo nos encontraste?
                                </label>
                                <input v-model="form.way_of_knowing"
                                    @focus="focusHowFoundUs = true"
                                    @blur="focusHowFoundUs = false"
                                    class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-sm placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full rounded-[10px] h-9 px-5" />
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

        <!-- footer -->
        <SpanishFooter />
    </div>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";
import SpanishFooter from "@/Components/MyComponents/Landing/SpanishFooter.vue";

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
            project_type: 'Tipo de proyecto',
            estimate: 'Presupuesto estimado',
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
        SpanishFooter,
        SpanishNav,
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
        },
        store() {
            this.form.post(route("quote-request.store"), {
                onSuccess: () => {
                    this.$notify({
                        title: 'Éxito',
                        message: "Se ha en viado la related_sitesrmación. Se enviará la cotización lo antes posible",
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
