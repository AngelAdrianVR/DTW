<template>
  <Head title="Us" />
  <div class="relative selection:bg-primarylight selection:text-primary bg-black min-h-screen text-white">
    <!-- whatsapp button -->
    <a
      class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
      href="https://api.whatsapp.com/send?phone=523322268824&text=Hello!%20I%20saw%20your%20webpage%20DTW,%20i'm%20interesting%20on%20a%20service!"
      target="_blank"
      rel="noopener noreferrer"
    >
      <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
    </a>

    <!-- navbar -->
    <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
        class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
        <EnglishNav @scrolling="scrollToSection($event)" />
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
      <!-- Poryectos y portafolio -->
      <section class="my-14">
          <h2 class="text-center font-bold text-2xl mt-40 mb-7">PROJECTS / PORTFOLIO</h2>
          <div class="custom-style text-center">
              <el-segmented v-model="filterProjects" :options="projectsFilter" />
          </div>

          <!-- proyectos segun el filtro seleccionado -->
          <article class="md:grid md:grid-cols-2 lg:grid-cols-4 gap-4 mt-14 mx-5 lg:w-[95%] lg:mx-auto">
              <EnglishProjects :filterProjects="filterProjects" />
          </article>
      </section>
    </main>

    <!-- Footer -->
    <EnglishFooter />
  </div>
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import InputWithPlaceholder from "@/Components/MyComponents/InputWithPlaceholder.vue";
import EnglishFooter from "@/Components/MyComponents/Landing/EnglishFooter.vue";
import EnglishProjects from "@/Components/MyComponents/Landing/EnglishProjects.vue";
import EnglishNav from "@/Components/MyComponents/Landing/EnglishNav.vue";

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
      filterProjects: 'All', //filtro de proyectos
      projectsFilter: [
          'All',
          'Management systems',
          'Online stores',
          'Web sites',
      ],
    };
  },
  components: {
    InputWithPlaceholder,
    EnglishProjects,
    EnglishFooter,
    EnglishNav,
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
