<template>
    <main class="lg:flex md:space-x-5">
        <!-- lado izquierdo -->
        <section class="rounded-2xl bg-[#232323] p-2 lg:py-3 lg:px-5 lg:w-2/3 lg:flex items-center lg:space-x-5 relative h-[580px] md:h-[700px] xl:h-[500px]">
            <!-- Decoracion -->
            <div class="bg-[#F68C0F] absolute top-5 left-0 py-1">
                <div class="relative">
                    <p class="text-white font-bold text-center px-7">
                      {{ language == 'english' ? 'DISCOVER YOUR EARNINGS INSTANTLY' : 'DESCUBRE TUS GANANCIAS AL MOMENTO' }}
                    </p>
                    <i
                        class="fa-solid fa-play text-3xl text-[#232323] absolute -right-[2px] -bottom-[6px] rotate-180"></i>
                </div>
            </div>

            <div class="space-y-3 mt-16 lg:mt-0">
                <p>{{ language == 'english' ? 'Visual summary of income, expenses and profits to simplify finances.' : 'Resumen visual de ingresos, gastos y ganancias para simplificar las finanzas.' }}</p>
                <p>{{ language == 'english' ? 'Comparison over different periods.' : 'Comparación en diferentes períodos.' }}</p>
                <p>{{ language == 'english' ? 'Projecting sales and expenses to anticipate future needs.' : 'Proyección de ventas y gastos para anticipar necesidades futuras.' }}</p>
            </div>

            <div class="w-full mt-7">
                <el-carousel trigger="click" :height="carouselHeight">
                    <el-carousel-item v-for="item in images" :key="item">
                        <img class="mx-auto" :src="item.url" alt="">
                    </el-carousel-item>
                </el-carousel>
            </div>
        </section>

        <!-- lado derecho -->
        <section class="rounded-2xl border border-white px-4 py-3 lg:w-1/3 mt-5 lg:mt-0 self-start">
            <img class="mx-auto" src="@/../../public/assets/images/logo_ezy_white.png" alt="">
            <p class="text-center mt-7">{{ language == 'english' ? 'Sales point' : 'Punto de venta'}}</p>
            <p class="text-center mt-4">{{ language == 'english' ? 'Find us in our website' : 'Encuéntranos en nuestro sitio'}}</p>
            <p class="text-center mb-10 underline">ezyventas.com</p>
            
            <a href="https://ezyventas.com/" target="_blank" class="bg-[#4B4B4B] rounded-full flex items-center justify-between p-1">
                <p class="w-[95%] text-center">{{ language == 'english' ? 'Visit' : 'Visitar' }}</p>
                <button href="https://ezyventas.com/" target="_blank" class="flex items-center justify-center rounded-full size-7 bg-[#D9D9D9]">
                    <i class="fa-solid fa-arrow-right text-[#4B4B4B]"></i>
                </button>
            </a>
        </section>
    </main>
</template>

<script>
import EzyVentas1 from '@/../../public/assets/images/EzyVentas1.png';
import EzyVentas2 from '@/../../public/assets/images/EzyVentas2.png';

export default {
data() {
    return {
        carouselHeight: '600px',
        images: [
            {
                url: EzyVentas1
            },
            {
                url: EzyVentas2
            },
        ]
    }
},
props:{
  language:{
      type: String,
      default: 'spanish'
    }
},
methods: {
    updateCarouselHeight() {
      const width = window.innerWidth;
      if (width < 430) {
        this.carouselHeight = '340px';
      } else if (width >= 430 && width < 1024) {
        this.carouselHeight = '480px';
      } else if (width >= 1024 && width < 1350) {
        this.carouselHeight = '350px';
      } else {
        this.carouselHeight = '470px';
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
    background-color: rgba(99, 98, 98, 0.562);
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
    background-color: rgba(131, 130, 130, 0.562);
    /* Cambia el fondo al hacer hover */
    /* transform: scale(1.1); Efecto de escalado al hacer hover */
}
</style>
