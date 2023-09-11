<template>
  <Head title="Us" />
  <div class="relative">
    <!-- whatsapp button -->
    <a
      class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
      href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
      target="_blank"
      rel="noopener noreferrer"
    >
      <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
    </a>

    <!-- mobile menu (hamburger) -->
        <div v-if="showMobileMenu"
            class="flex flex-col z-30 w-2/3 bg-[#262626] rounded-xl fixed top-20 right-1 border-white border py-1 text-white">
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="$inertia.visit('/En')">Home</button>
            <!-- <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Servicios')">Services</button> -->
            <!-- <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Contacto')">Contacto</button> -->
            <button class="mx-2 py-2 hover:bg-[#7F659C] rounded-lg" @click="showMore = !showMore">More <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button>
            <ul v-if="showMore" class="text-center p-3">
                <li @click="$inertia.get(route('us-en'))" class="hover:bg-[#7F659C] rounded-lg p-1">About us</li>
                <li @click="$inertia.get(route('create-quote-en.create'))" class="hover:bg-[#7F659C] rounded-lg p-1">Quote</li>
                <li @click="$inertia.get(route('packages-en'))" class="hover:bg-[#7F659C] rounded-lg p-1">Software packages</li>
             </ul>
            <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C] font-bold text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
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
                <button class="mx-2 hover:text-[#7F659C]" @click="$inertia.visit('/En')">Home</button> |
                <!-- <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Services')">Servicios</button> | -->
                <!-- <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Contact')">Contacto</button> | -->
                <button class="mx-2 hover:text-[#7F659C]" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button> |
                <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C] font-bold text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
             </button>
             <ul v-if="showMore" class="absolute right-0 p-3 bg-white">
                <li @click="$inertia.get(route('us-en'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">About us</li>
                <li @click="$inertia.get(route('create-quote-en.create'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Quote</li>
                <li @click="$inertia.get(route('packages-en'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Software packages</li>
             </ul>
            </div>
        </nav>

    <main class="pt-28 lg:px-28 mx-3">
      <div class="lg:mx-20">
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> We work with tools
           robust that guarantees greater scalability to your projects.
        </p>
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> Custom designs to the store
           of your brand
        </p>
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> Guarantee of delivery on time and
           shape
        </p>

        <p class="mt-7">
          We are a team of specialists in web design and development, with a focus on
           the quality and satisfaction of clients. At Digital TW we firmly believe in
           transparency, ethics and work excellence. Our commitment to
           These values are reflected in every project we undertake. We have had the
           privilege of working with a wide range of clients, from startups
           to large companies, and we always strive to exceed their expectations.
           We offer our tailored services to different countries
        </p>
        <p class="mt-3">Digital TW Guarantees </p>
      </div>
      <h1 class="text-xl font-bold text-center mt-16">PROJECTS</h1>
      <div class="lg:flex lg:mx-28 justify-center mt-8 hidden lg:block">
        <p @click="setActive('allProyects')" :class="allProyects ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 rounded-l-full cursor-pointer">All</p>
        <p @click="setActive('stores')" :class="stores ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 cursor-pointer">Online stores</p>
        <p @click="setActive('erp')" :class="erp ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 text-[#7F659C] cursor-pointer">ERP</p>
        <p @click="setActive('crm')" :class="crm ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 text-[#7F659C] cursor-pointer">CRM</p>
        <p @click="setActive('cms')" :class="cms ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 text-[#7F659C] cursor-pointer">CRS</p>
        <p @click="setActive('websites')" :class="websites ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 px-6 text-[#7F659C] cursor-pointer">Websites</p>
        <p @click="setActive('marketing')" :class="marketing ? 'bg-[#7F659C] text-white' : 'text-[#7F659C]'" class="py-3 rounded-r-full px-6 text-[#7F659C]">Marketing</p>
      </div>


      <div class="rounded-lg w-full h-72 mt-16">
        <div v-if="allProyects" class="flex space-x-7 justify-center">
            <figure>
                <img src="@/../../public/assets/images/PC-suiter.png" alt="Suiter">
            </figure>
            <figure>
                <img src="@/../../public/assets/images/PC-emblems3dusa.png" alt="E3dUSA">
            </figure>
            <figure>
                <img src="@/../../public/assets/images/PC-youpartner.png" alt="YP">
            </figure>

        </div>
        <p class="text-black font-bold z-10" v-if="stores">tiendas en linea</p>
        <p class="text-black font-bold z-10" v-if="erp">ERP</p>
        <p class="text-black font-bold z-10" v-if="crm">CRM</p>
        <p class="text-black font-bold z-10" v-if="cms">CMS</p>
        <p class="text-black font-bold z-10" v-if="websites">Sitios WEB</p>
        <p class="text-black font-bold z-10" v-if="marketing">Publicidad</p>
      </div>
    </main>
    <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative">
      <figure>
        <img
          class="md:w-[3%] w-[7%]"
          src="@/../../public/assets/images/dtw_logo.png"
          alt=""
        />
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
              <p><i class="fa-solid fa-envelope mr-2"></i>contacto@dtw.com.mx</p>
            </div>
          </div>
        </div>

        <div class="flex justify-center items-center">
          <div class="flex flex-col justify-center items-center">
            <h2 class="text-center mb-5 text-xl">Follow us!</h2>
            <div>
              <a
                href="https://www.facebook.com/profile.php?id=100094614796876"
                target="_blank"
                ><i
                  class="fa-brands fa-facebook text-2xl border border-white rounded-full px-3 py-2 cursor-pointer mr-5"
                ></i
              ></a>
              <a
                href="https://instagram.com/digital_tw?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D"
                target="_blank"
                ><i
                  class="fa-brands fa-instagram text-2xl border border-white rounded-full px-3 py-2 cursor-pointer"
                ></i
              ></a>
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
          Copyright | 2023 | Todos los derechos reservados por Digital TW S.A de C.V.
        </p>
      </a>
    </footer>
  </div>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";

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
      allProyects: true,
      stores: false,
      erp: false,
      crm: false,
      cms: false,
      websites: false,
      marketing: false,
      showMore: false,
      currentTestimony: 0,
      lastScrollY: 0,
      showMobileMenu: false,
    };
  },
  components: {
    Head,
    Link,
    InputWithPlaceholder,
  },
  mounted() {
    window.addEventListener("scroll", this.handleScroll);
    this.toast = useToast();
  },
  beforeDestroy() {
    window.removeEventListener("scroll", this.handleScroll);
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
      section.scrollIntoView({ behavior: "smooth" });
      this.showMobileMenu = false;
    },
    store() {
      this.form.post(route("store-quote"), {
        onSuccess: () => {
          this.toast.success(
            "Se han enviado los datos. Te haremos llegar la cotizacion lo mas pronto posible",
            {
              timeout: 5000,
            }
          );

          form.reset();
        },
      });
    },
    setActive(option) {
      // Establece todas las variables en false
      this.allProyects = false;
      this.stores = false;
      this.erp = false;
      this.crm = false;
      this.cms = false;
      this.websites = false;
      this.marketing = false;

      // Establece la variable seleccionada en true
      this[option] = true;
    },
  },
  components: {
    Link,
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
