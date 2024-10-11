<template>
    <figure @click="handleProjectSelection(project)" v-for="project in filteredProjects" :key="project.name" class="relative group">
        <img class="cursor-pointer mx-auto mb-7 md:mb-0" :src="project.img" :alt="project.name">
        <div class="absolute inset-x-0 bottom-0 bg-black bg-opacity-50 text-white text-center p-2 opacity-0 group-hover:opacity-100 transform translate-y-full group-hover:translate-y-0 transition-all duration-300 ease-in-out">
            {{ project.name }}
        </div>
        <div class="lg:hidden absolute inset-x-0 bottom-0 bg-black bg-opacity-50 text-white text-center p-2">
            {{ project.name }}
        </div>
    </figure>

    <!-- selected project modal -->
    <Modal :maxWidth="'7xl'" :show="showProjectInfoModal" @close="showProjectInfoModal = false">
        <main class="relative bg-black text-white">
            <body class="lg:py-5 lg:px-12 p-4">
                <div @click="showProjectInfoModal = false"
                    class="cursor-pointer w-5 h-5 rounded-full flex items-center justify-center absolute top-2 right-2 hover:text-red-600">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <h2 class="font-bold ml-3 mb-8">{{ selectedProject.category[0] }}</h2>

                <!-- imagenes -->
                <section>
                    <el-carousel :interval="3000" type="card" :height="carouselHeight">
                        <el-carousel-item v-for="item in selectedProject.images" :key="item">
                            <img class="mx-auto mt-4 w-[90%] object-contain" :src="item" alt="">
                        </el-carousel-item>
                    </el-carousel>
                </section>

                <p class="font-bold mt-9 mb-4">{{ selectedProject.name }}</p>
                <p>{{ selectedProject.description }}</p>
            </body>
            <div class="flex items-center justify-end space-x-5 bg-gray-700 p-3">
                <a class="cursor-pointer" @click="showProjectInfoModal = false">Cerrar</a>
                <a v-if="selectedProject.canVisitSite" :href="selectedProject.url" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-full text-xs text-white tracking-widest active:bg-primarydark transition-all ease-in-out duration-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed">Visitar sitio</a>
            </div>
        </main>
    </Modal>
</template>

<script>
//imagenes
import padColor from '@/../../public/assets/images/padColor.png';
import padColor1 from '@/../../public/assets/images/padColor1.png';
import padColor2 from '@/../../public/assets/images/padColor2.png';
import padColor3 from '@/../../public/assets/images/padColor3.png';
import ingenieriaZafiro from '@/../../public/assets/images/ingenieriaZafiro.png';
import ingenieriaZafiro1 from '@/../../public/assets/images/ingenieriaZafiro1.png';
import ingenieriaZafiro2 from '@/../../public/assets/images/ingenieriaZafiro2.png';
import ingenieriaZafiro3 from '@/../../public/assets/images/ingenieriaZafiro3.png';
import Emblems3dUSA from '@/../../public/assets/images/Emblems3dUSA.png';
import Emblems3dUSA1 from '@/../../public/assets/images/Emblems3dUSA1.png';
import Emblems3dUSA02 from '@/../../public/assets/images/Emblems3dUSA02.png';
import Construmax from '@/../../public/assets/images/Construmax.png';
import Construmax1 from '@/../../public/assets/images/Construmax1.png';
import Construmax2 from '@/../../public/assets/images/Construmax2.png';
import Construmax3 from '@/../../public/assets/images/Construmax3.png';
import Nala from '@/../../public/assets/images/Nala.png';
import Nala1 from '@/../../public/assets/images/Nala1.png';
import Nala2 from '@/../../public/assets/images/Nala2.png';
import Nala3 from '@/../../public/assets/images/Nala3.png';
import ReporteoADTI from '@/../../public/assets/images/ReporteoADTI.png';
import ReporteoADTI1 from '@/../../public/assets/images/ReporteoADTI1.png';
import ReporteoADTI2 from '@/../../public/assets/images/ReporteoADTI2.png';
import PuroChurro from '@/../../public/assets/images/PuroChurro.png';
import PuroChurro1 from '@/../../public/assets/images/PuroChurro1.png';
import PuroChurro2 from '@/../../public/assets/images/PuroChurro2.png';
import ADTI from '@/../../public/assets/images/ADTI.png';
import ADTI1 from '@/../../public/assets/images/ADTI1.png';
import ADTI2 from '@/../../public/assets/images/ADTI2.png';
import ADTI3 from '@/../../public/assets/images/ADTI3.png';
import SuitesAcuario from '@/../../public/assets/images/SuitesAcuario.png';
import SuitesAcuario1 from '@/../../public/assets/images/SuitesAcuario1.png';
import SuitesAcuario2 from '@/../../public/assets/images/SuitesAcuario2.png';
import MudanzasMantenimiento from '@/../../public/assets/images/MudanzasMantenimiento.png';
import MudanzasMantenimiento1 from '@/../../public/assets/images/MudanzasMantenimiento1.png';
import MudanzasMantenimiento2 from '@/../../public/assets/images/MudanzasMantenimiento2.png';
import MudanzasMantenimiento3 from '@/../../public/assets/images/MudanzasMantenimiento3.png';

//General
import Modal from '@/Components/Modal.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
data() {
    return {
        selectedProject: null, //Informacion del proyecto seleccionado
        showProjectInfoModal: false, //abre el modal de informacion de proyecto seleccionado
        carouselHeight: '350px', //cambia el tamaño del carusel dependiendo del tamaño del dispositivo
        projects: [
            {
                name: 'SISTEMA DE TICKETS - PADCOLOR',
                img: padColor,
                category: ['Gestión', 'Todo'],
                description: 'Sistema de tickets para su atención oportuna, registrar tiempos de resolución y reportar estadísticas de conclusión de problemas sucitados en todas las sucursales de la empresa.',
                url: 'https://www.padcolor.dtw.com.mx/login',
                images: [padColor1, padColor2, padColor3],
                canVisitSite: false
            },
            {
                name: 'PÁGINA WEB INGENIERÍA ZAFIRO',
                img: ingenieriaZafiro,
                category: ['Sitios web', 'Todo'],
                description: 'Nuestro cliente se especializa en la industria de la construcción, destacándose en el diseño, elaboración de planos geográficos, y más. A través de estas vistas, podrá conocer su experiencia, los servicios que ofrece y los proyectos que ha llevado a cabo con éxito. Su objetivo principal es conectar con nuevos clientes y dar a conocer el valor que puede aportar a cada proyecto.',
                url: 'https://ingenieriazafiro.dtw.com.mx/',
                images: [ingenieriaZafiro1, ingenieriaZafiro2, ingenieriaZafiro3],
                canVisitSite: true
            },
            {
                name: 'ERP EMBLEMAS 3D USA',
                img: Emblems3dUSA,
                category: ['Gestión', 'Todo'],
                description: 'Sistema ERP completo: gestión integral de clientes desde prospección, catálogo de productos, seguimientos de producción, asignación de tareas, seguimiento de proyectos, gestión integral de nóminas, cotizaciónes, almacenes y compras. Ademas cuenta con un módulo de analisis definanzas el cual muestra productos mas vendidos, historial de ventas de cada producto y margen de cualquier periodo de tiempo',
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Emblems3dUSA, Emblems3dUSA1, Emblems3dUSA02],
                canVisitSite: false
            },
            {
                name: 'CRM Y PMS CONSTRUMAX DE OCCIDENTE',
                img: Construmax,
                category: ['Gestión', 'Todo'],
                description: 'Sistemas CRM y PMS para la gestión integral de clientes desde prospección hasta la conversión en cliente. Módulo de oportunidades de venta con asignación de tareas para el seguimiento y flujo hasta ganar la oportunidad. Sistema PMS que da seguimiento al proyecto de la oportunidad ganada, diagrama de gantt con tiempos, estatus y tareas para completar proyecto. Además cuenta son envío automatico de correos y whatsApp que notifica a los empleados sobre nuevas tareas asignadas',
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Construmax, Construmax1, Construmax2, Construmax3],
                canVisitSite: false
            },
            {
                name: 'PÁGINA WEB NALA JEWELRY',
                img: Nala,
                category: ['Sitios web', 'Tiendas en línea', 'Todo'],
                description: 'Página web promocional que muestra catálogo deproductos de una tienda de joyas con boton para contactar directamente a whatsApp',
                url: 'https://nala.dtw.com.mx/',
                images: [Nala, Nala1, Nala2, Nala3],
                canVisitSite: true
            },
            {
                name: 'REPORTEO ADTI',
                img: ReporteoADTI,
                category: ['Gestión', 'Todo'],
                description: 'Sistema de reporteo de producción y estatus de trabajo de la maquinaria en tiempo real a través de conexión modbus TCPIP, conexión a base de datos y correos automáticos con intervalos de tiempo configurables. Visualización de producción desde cualquier dispositivo con conexión a internet desde cualquier parte del mundo',
                url: 'https://reporteo.dtw.com.mx/',
                images: [ReporteoADTI, ReporteoADTI1, ReporteoADTI2],
                canVisitSite: false
            },
            {
                name: 'ERP PURO CHURRO',
                img: PuroChurro,
                category: ['Gestión', 'Todo'],
                description: 'Sistema ERP que gestiona nóminas, productos, estock y almacén, historial de ventas y egresos para obtención de margen y cuenta con un punto de venta con conexión a escaner de codigo qr y de barras para agilizar la venta.',
                url: 'https://purochurro.dtw.com.mx/',
                images: [PuroChurro, PuroChurro1, PuroChurro2],
                canVisitSite: false
            },
            {
                name: 'ADTI',
                img: ADTI,
                category: ['Gestión', 'Todo'],
                description: 'Empresa de diseño y automatización industrial. Gestión de almacén y organización de piezas e insumos para la construcción de sus máquinas por categorías y subcategorías. Además cuenta con codigo interno estandarizado para su correcta gestión en otros procesos.',
                url: 'https://app.adti.com.mx/',
                images: [ADTI, ADTI1, ADTI2, ADTI3],
                canVisitSite: true
            },
            {
                name: 'Página web Suites Acuario',
                img: SuitesAcuario,
                category: ['Sitios web', 'Todo'],
                description: 'Página web promocional de suites de lujo en Mazatlán Sinaloa',
                url: 'https://suitesacuariomazatlan.dtw.com.mx/',
                images: [SuitesAcuario, SuitesAcuario1, SuitesAcuario2],
                canVisitSite: true
            },
            {
                name: 'Página web Mudanzas y Reparaciones',
                img: MudanzasMantenimiento,
                category: ['Sitios web', 'Todo'],
                description: 'Página web promocional de negocio multiservicios de mudanzas, fletes, mantenimiento y reparación de linea blanca y electrónica',
                url: 'http://mudanzasymantenimiento.dtw.com.mx/',
                images: [MudanzasMantenimiento, MudanzasMantenimiento1, MudanzasMantenimiento2, MudanzasMantenimiento3],
                canVisitSite: true
            },
            
        ],
    }
},
computed: {
    filteredProjects() {
        if (this.filterProjects === 'Todo') {
            return this.projects;
        }
        return this.projects.filter(item => 
            item.category.includes(this.filterProjects)
        );
    }
},
components:{
    PrimaryButton,
    Modal,
},
props:{
    filterProjects: String
},
methods:{
    handleProjectSelection(project) {
        this.selectedProject = project;
        this.showProjectInfoModal = true;
    },
    updateCarouselHeight() {
      const width = window.innerWidth;
      if (width < 430) {
        this.carouselHeight = '200px';
      } else if (width >= 430 && width < 1024) {
        this.carouselHeight = '300px';
      } else if (width >= 1024 && width < 1350) {
        this.carouselHeight = '350px';
      } else {
        this.carouselHeight = '450px';
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
    line-height: 200px;
    margin: 0;
    text-align: center;
}

.el-carousel__item:nth-child(2n) {
  background-color: #99a9bf;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #d3dce6;
}
.el-carousel__item:nth-child(2n) {
  background-color: #232323;
}

.el-carousel__item:nth-child(2n + 1) {
  background-color: #232323;
}
</style>