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
                <a class="cursor-pointer" @click="showProjectInfoModal = false">Close</a>
                <a v-if="selectedProject.canVisitSite" :href="selectedProject.url" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-full text-xs text-white tracking-widest active:bg-primarydark transition-all ease-in-out duration-100 disabled:bg-gray-200 disabled:text-gray-400 disabled:cursor-not-allowed">Visit site</a>
            </div>
        </main>
    </Modal>
</template>

<script>
import padColor from '@/../../public/assets/images/padColor.png';
import ingenieriaZafiro from '@/../../public/assets/images/ingenieriaZafiro.png';
import Emblems3dUSA from '@/../../public/assets/images/Emblems3dUSA.png';
import Emblems3dUSA01 from '@/../../public/assets/images/Emblems3dUSA01.png';
import Emblems3dUSA02 from '@/../../public/assets/images/Emblems3dUSA02.png';
import Construmax from '@/../../public/assets/images/Construmax.png';
import Nala from '@/../../public/assets/images/Nala.png';
import ReporteoADTI from '@/../../public/assets/images/ReporteoADTI.png';
import PuroChurro from '@/../../public/assets/images/PuroChurro.png';
import ADTI from '@/../../public/assets/images/ADTI.png';
import SuitesAcuario from '@/../../public/assets/images/SuitesAcuario.png';
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
                name: 'TICKETS SISTEM- PADCOLOR',
                img: padColor,
                category: ['Management systems', 'All'],
                description: "Ticket system for timely attention, recording resolution times and reporting statistics on the resolution of problems that have arisen in all company branches.",
                url: 'https://www.padcolor.dtw.com.mx/login',
                images: [padColor, padColor, padColor],
                canVisitSite: false
            },
            {
                name: 'WEB SITE INGENIERÍA ZAFIRO',
                img: ingenieriaZafiro,
                category: ['Web sites', 'All'],
                description: "Our client specializes in the construction industry, excelling in design, geographic mapping, and more. Through these views, you will be able to learn about their experience, the services they offer, and the projects they have successfully completed. Their main goal is to connect with new clients and make them aware of the value they can bring to each project.",
                url: 'https://ingenieriazafiro.dtw.com.mx/',
                images: [ingenieriaZafiro, ingenieriaZafiro, ingenieriaZafiro,],
                canVisitSite: true
            },
            {
                name: 'ERP EMBLEMS 3D USA',
                img: Emblems3dUSA,
                category: ['Management systems', 'All'],
                description: "Complete ERP system: comprehensive customer management from prospecting, product catalog, production monitoring, task assignment, project monitoring, comprehensive payroll management, quotes, warehouses and purchases. It also has a financial analysis module which shows best-selling products, sales history of each product and margin for any period of time.",
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Emblems3dUSA, Emblems3dUSA01, Emblems3dUSA02],
                canVisitSite: false
            },
            {
                name: 'CRM Y PMS CONSTRUMAX DE OCCIDENTE',
                img: Construmax,
                category: ['Management systems', 'All'],
                description: "CRM and PMS systems for comprehensive customer management from prospecting to conversion into a client. Sales opportunities module with task assignment for follow-up and flow until the opportunity is won. PMS system that tracks the project of the won opportunity, Gantt chart with times, status and tasks to complete the project. It also has automatic sending of emails and WhatsApp that notifies employees about new assigned tasks.",
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Construmax, Construmax, Construmax],
                canVisitSite: false
            },
            {
                name: 'WEB SITE NALA JEWELRY',
                img: Nala,
                category: ['Web sites', 'Online stores', 'All'],
                description: "Promotional web page showing a jewelry store's product catalog with a button to contact them directly on WhatsApp",
                url: 'https://nala.dtw.com.mx/',
                images: [Nala, Nala, Nala],
                canVisitSite: true
            },
            {
                name: 'REPORTING ADTI',
                img: ReporteoADTI,
                category: ['Management systems', 'All'],
                description: "Production reporting system and real-time working status of machinery through Modbus TCPIP connection, database connection and automatic emails with configurable time intervals. Production visualization from any device with an Internet connection from anywhere in the world',",
                url: 'https://reporteo.dtw.com.mx/',
                images: [ReporteoADTI, ReporteoADTI, ReporteoADTI],
                canVisitSite: false
            },
            {
                name: 'ERP PURO CHURRO',
                img: PuroChurro,
                category: ['Management systems', 'All'],
                description: "ERP system that manages payrolls, products, stock and warehouse, sales and expenditure history to obtain margin and has a point of sale with connection to QR code and barcode scanner to speed up sales.",
                url: 'https://purochurro.dtw.com.mx/',
                images: [PuroChurro, PuroChurro, PuroChurro],
                canVisitSite: false
            },
            {
                name: 'ADTI',
                img: ADTI,
                category: ['Management systems', 'All'],
                description: "Industrial design and automation company. Warehouse management and organization of parts and supplies for the construction of your machines by categories and subcategories. It also has a standardized internal code for correct management in other processes.",
                url: 'https://app.adti.com.mx/',
                images: [ADTI, ADTI, ADTI],
                canVisitSite: true
            },
            {
                name: 'WEB SITE SUITES ACUARIO MAZATLAN',
                img: SuitesAcuario,
                category: ['Web sites', 'All'],
                description: "Promotional website for luxury suites in Mazatlan Sinaloa",
                url: 'https://suitesacuariomazatlan.dtw.com.mx/',
                images: [SuitesAcuario, SuitesAcuario, SuitesAcuario],
                canVisitSite: true
            },
            
        ],
    }
},
computed: {
    filteredProjects() {
        if (this.filterProjects === 'All') {
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