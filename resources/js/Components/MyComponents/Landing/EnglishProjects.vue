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
    <Modal :maxWidth="'5xl'" :show="showProjectInfoModal" @close="showProjectInfoModal = false">
        <main class="relative bg-black text-white">
            <body class="lg:py-5 lg:px-12 p-4">
                <div @click="showProjectInfoModal = false"
                    class="cursor-pointer w-5 h-5 rounded-full flex items-center justify-center absolute top-2 right-2 hover:text-red-600">
                    <i class="fa-solid fa-xmark"></i>
                </div>

                <h2 class="font-bold ml-3 mb-8">{{ selectedProject.category[0] }}</h2>

                <!-- imagenes -->
                <section>
                    <el-carousel :interval="4000" type="card" height="350px">
                        <el-carousel-item v-for="item in selectedProject.images" :key="item">
                            <img class="mx-auto mt-4 w-[90%]" :src="selectedProject.img" alt="">
                        </el-carousel-item>
                    </el-carousel>
                </section>

                <p class="font-bold mt-9 mb-4">{{ selectedProject.name }}</p>
                <p>{{ selectedProject.description }}</p>
            </body>
            <div class="text-right bg-gray-700 p-3">
                <PrimaryButton @click="showProjectInfoModal = false">Close</PrimaryButton>
            </div>
        </main>
    </Modal>
</template>

<script>
import padColor from '@/../../public/assets/images/padColor.png';
import ingenieriaZafiro from '@/../../public/assets/images/ingenieriaZafiro.png';
import Emblems3dUSA from '@/../../public/assets/images/Emblems3dUSA.png';
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
        projects: [
            {
                name: 'TICKETS SISTEM- PADCOLOR',
                img: padColor,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://www.padcolor.dtw.com.mx/login',
                images: [padColor, padColor, padColor]
            },
            {
                name: 'WEB SITE INGENIERÍA ZAFIRO',
                img: ingenieriaZafiro,
                category: ['Web sites', 'All'],
                description: "Project's description",
                url: 'https://ingenieriazafiro.dtw.com.mx/',
                images: [ingenieriaZafiro, ingenieriaZafiro, ingenieriaZafiro,]
            },
            {
                name: 'ERP EMBLEMS 3D USA',
                img: Emblems3dUSA,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Emblems3dUSA, Emblems3dUSA, Emblems3dUSA]
            },
            {
                name: 'CRM Y PMS CONSTRUMAX DE OCCIDENTE',
                img: Construmax,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
                images: [Construmax, Construmax, Construmax]
            },
            {
                name: 'WEB SITE NALA JEWELRY',
                img: Nala,
                category: ['Web sites', 'Online stores', 'All'],
                description: "Project's description",
                url: 'https://nala.dtw.com.mx/',
                images: [Nala, Nala, Nala]
            },
            {
                name: 'REPORTING ADTI',
                img: ReporteoADTI,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://reporteo.dtw.com.mx/',
                images: [ReporteoADTI, ReporteoADTI, ReporteoADTI]
            },
            {
                name: 'ERP PURO CHURRO',
                img: PuroChurro,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://purochurro.dtw.com.mx/',
                images: [PuroChurro, PuroChurro, PuroChurro]
            },
            {
                name: 'ADTI',
                img: ADTI,
                category: ['Management systems', 'All'],
                description: "Project's description",
                url: 'https://app.adti.com.mx/',
                images: [ADTI, ADTI, ADTI]
            },
            {
                name: 'WEB SITE SUITES ACUARIO MAZATLAN',
                img: SuitesAcuario,
                category: ['Web sites', 'All'],
                description: "Project's description",
                url: 'https://suitesacuariomazatlan.dtw.com.mx/',
                images: [SuitesAcuario, SuitesAcuario, SuitesAcuario]
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
    }
}
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