<template>
  <main>
    <section class="lg:flex md:space-x-5">
      <!-- lado izquierdo -->
      <div class="lg:w-[80%] h-full">
        <el-carousel trigger="click" :height="carouselHeight">
          <el-carousel-item v-for="item in imagesEzy" :key="item">
            <img class="mx-auto" :src="item.url">
          </el-carousel-item>
        </el-carousel>
      </div>
      <!-- lado derecho -->
      <article class="rounded-2xl border border-white px-4 py-3 lg:w-[20%] mt-5 lg:mt-0 self-start">
        <img class="mx-auto" src="@/../../public/assets/images/logo_ezy_white.png">
        <p class="text-center mt-7">{{ language == 'english' ? 'Sales point' : 'Punto de venta' }}</p>
        <p class="text-center mt-4">
          {{ language == 'english'
            ? 'Find us in our website'
            : 'Encuéntranos en nuestro sitio' }}</p>
        <p class="text-center mb-10 underline">ezyventas.com</p>

        <a href="https://ezyventas.com/" target="_blank"
          class="bg-[#4B4B4B] rounded-full flex items-center justify-between p-1">
          <p class="w-[95%] text-center">{{ language == 'english' ? 'Visit' : 'Visitar' }}</p>
          <button href="https://ezyventas.com/" target="_blank"
            class="flex items-center justify-center rounded-full size-7 bg-[#D9D9D9]">
            <i class="fa-solid fa-arrow-right text-[#4B4B4B]"></i>
          </button>
        </a>
      </article>
    </section>

    <section class="lg:flex md:space-x-5 mt-10">
      <!-- lado izquierdo -->
      <div class="lg:w-[80%] h-full">
        <el-carousel trigger="click" :height="carouselHeight">
          <el-carousel-item v-for="item in imagesFinanzas" :key="item">
            <img class="mx-auto" :src="item.url">
          </el-carousel-item>
        </el-carousel>
      </div>
      <!-- lado derecho -->
      <article class="rounded-2xl border border-white px-4 py-3 lg:w-[20%] mt-5 lg:mt-0 self-start">
        <img class="mx-auto" src="@/../../public/assets/images/finanzas_logo.png">
        <p class="text-center mt-7">{{ language == 'english' ? 'Financial control' : 'Control de finanzas' }}</p>
        <p class="text-center mt-4">
          {{ language == 'english'
            ? 'Find us in our website'
            : 'Encuéntranos en nuestro sitio' }}</p>
        <p class="text-center mb-10 underline">finanzas.dtw.com.mx</p>
        <a href="https://finanzas.dtw.com.mx/" target="_blank"
          class="bg-[#4B4B4B] rounded-full flex items-center justify-between p-1">
          <p class="w-[95%] text-center">{{ language == 'english' ? 'Visit' : 'Visitar' }}</p>
          <button href="https://ezyventas.com/" target="_blank"
            class="flex items-center justify-center rounded-full size-7 bg-[#D9D9D9]">
            <i class="fa-solid fa-arrow-right text-[#4B4B4B]"></i>
          </button>
        </a>
      </article>
    </section>
  </main>
</template>

<script>
import EzyVentas1 from '@/../../public/assets/images/EzyVentas1.webp';
import EzyVentas2 from '@/../../public/assets/images/EzyVentas2.webp';
import finanzas1 from '@/../../public/assets/images/finanzas1.webp';
import finanzas2 from '@/../../public/assets/images/finanzas2.webp';

export default {
  data() {
    return {
      carouselHeight: '200px',
      imagesEzy: [
        {
          url: EzyVentas1
        },
        {
          url: EzyVentas2
        },
      ],
      imagesFinanzas: [
        {
          url: finanzas1
        },
        {
          url: finanzas2
        },
      ],
    }
  },
  props: {
    language: {
      type: String,
      default: 'spanish'
    }
  },
  methods: {
    updateCarouselHeight() {
      const width = window.innerWidth;
      if (width < 430) {
        this.carouselHeight = '250px';
      } else if (width >= 430 && width < 1024) {
        this.carouselHeight = '400px';
      } else if (width >= 1024 && width < 1350) {
        this.carouselHeight = '450px';
      } else {
        this.carouselHeight = '540px';
      }
    },
  },
  mounted() {
    this.updateCarouselHeight();
    window.addEventListener('resize', this.updateCarouselHeight);
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.updateCarouselHeight);
  },
}
</script>

<style>
.el-carousel__item h3 {
  color: #475669;
  opacity: 0.75;
  line-height: 150px;
  margin: 0;
  text-align: center;
}

.el-carousel__item:nth-child(2n) {
  background-color: transparent;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: transparent;
}

.el-carousel__arrow {
  background-color: rgba(131, 129, 129, 0.562);
  /* Fondo semitransparente */
  border-radius: 50%;
  /* Bordes redondeados */
  color: white;
  /* Color del icono */
}

.el-carousel__arrow--left {
  left: 10px;
  /* Ajusta la posición de la flecha izquierda */
}

.el-carousel__arrow--right {
  right: 10px;
  /* Ajusta la posición de la flecha derecha */
}

/* Puedes agregar más estilos personalizados aquí */
.el-carousel__arrow:hover {
  background-color: rgba(163, 161, 161, 0.562);
  /* Cambia el fondo al hacer hover */
  /* transform: scale(1.1); Efecto de escalado al hacer hover */
}
</style>
