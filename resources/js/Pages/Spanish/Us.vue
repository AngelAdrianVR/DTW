<template>
  <Head title="Nosotros" />
  <main class="relative selection:bg-primarylight selection:text-primary bg-black min-h-screen text-white">
    <!-- whatsapp button -->
    <a
      class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
      href="https://api.whatsapp.com/send?phone=523322268824&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
      target="_blank"
      rel="noopener noreferrer"
    >
      <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
    </a>

    <!-- navbar -->
    <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
        class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
        <SpanishNav @scrolling="scrollToSection($event)" />
    </nav>

    <main class="pt-28 lg:px-28 mx-3">
      <div class="lg:mx-20">
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> Trabajamos con herramientas
          robustas que garantiza mayor escalabilidad a tus proyectos.
        </p>
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> Diseños personalizados a la tienda
          de tu marca
        </p>
        <p>
          <i class="fa-solid fa-circle text-[8px]"></i> Garantía de entrega en tiempo y
          forma
        </p>

        <p class="mt-7">
          Somos un equipo de especialistas en el diseño y desarrollo web, con enfoque en
          la cálidad y la satisfacción de cleinte. En Digital TW creemos firmemente en la
          transparencia, la ética y la excelencia del trabajo. Nuestro compromiso con
          estos valores se refleja en cada proyecto que emprendemos. Hemos tenido el
          privilegio de trabajar con una amplia gama de clientes, desde emprendimientos
          hasta grandes empresas, y siempre nos esforzamos por superar sus expectativas.
          Ofrecemos nuestros servicios a la medida a distintos países
        </p>
        <p class="mt-3">Garantías Digital TW </p>
      </div>
      
      <!-- Poryectos y portafolio -->
      <section class="my-14">
          <h2 class="text-center font-bold text-2xl mt-40 mb-7">PROYECTOS / PORTAFOLIO</h2>
          <div class="custom-style text-center">
              <el-segmented v-model="filterProjects" :options="projectsFilter" />
          </div>

          <!-- proyectos segun el filtro seleccionado -->
          <article class="md:grid md:grid-cols-2 lg:grid-cols-4 gap-4 mt-14 mx-5 lg:w-[95%] lg:mx-auto">
              <SpanishProjects :filterProjects="filterProjects" />
          </article>
      </section>
    </main>

    <!-- footer -->
    <SpanishFooter />
  </main>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";
import SpanishFooter from "@/Components/MyComponents/Landing/SpanishFooter.vue";
import SpanishProjects from "@/Components/MyComponents/Landing/SpanishProjects.vue";

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
    SpanishProjects,
    SpanishFooter,
    SpanishNav,
    Head,
    Link,
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

.custom-style .el-segmented {
  --el-segmented-bg-color: #818181;
  --el-segmented-color: #000;
  --el-segmented-item-selected-color: #FFFFFF;
  --el-segmented-item-selected-bg-color: #a1a1a1;
  --el-border-radius-base: 16px;
}
</style>
