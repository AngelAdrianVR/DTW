<template>
    <figure v-for="project in filteredProjects" :key="project.name" class="relative group">
        <img class="cursor-pointer mx-auto mb-7 md:mb-0" :src="project.img" :alt="project.name">
        <div class="absolute inset-x-0 bottom-0 bg-black bg-opacity-50 text-white text-center p-2 opacity-0 group-hover:opacity-100 transform translate-y-full group-hover:translate-y-0 transition-all duration-300 ease-in-out">
            {{ project.name }}
        </div>
        <div class="lg:hidden absolute inset-x-0 bottom-0 bg-black bg-opacity-50 text-white text-center p-2">
            {{ project.name }}
        </div>
    </figure>
</template>

<script>
import padColor from '@/../../public/assets/images/padColor.png';
import ingenieriaZafiro from '@/../../public/assets/images/ingenieriaZafiro.png';
import Emblems3dUSA from '@/../../public/assets/images/Emblems3dUSA.png';
import Construmax from '@/../../public/assets/images/Construmax.png';
import Nala from '@/../../public/assets/images/Nala.png';
import ReporteoADTI from '@/../../public/assets/images/ReporteoADTI.png';

export default {
data() {
    return {
        projects: [
            {
                name: 'SISTEMA DE TICKETS - PADCOLOR',
                img: padColor,
                category: ['Sistemas de gestión', 'Todo'],
                url: 'https://www.padcolor.dtw.com.mx/login',
            },
            {
                name: 'PÁGINA WEB INGENIERÍA ZAFIRO',
                img: ingenieriaZafiro,
                category: ['Sitios web', 'Todo'],
                url: 'https://ingenieriazafiro.dtw.com.mx/',
            },
            {
                name: 'ERP EMBLEMAS 3D USA',
                img: Emblems3dUSA,
                category: ['Sistemas de gestión', 'Todo'],
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
            },
            {
                name: 'CRM Y PMS CONSTRUMAX DE OCCIDENTE',
                img: Construmax,
                category: ['Sistemas de gestión', 'Todo'],
                url: 'https://www.intranetemblems3d.dtw.com.mx/login',
            },
            {
                name: 'PÁGINA WEB NALA JEWELRY',
                img: Nala,
                category: ['Sitios web', 'Tiendas en línea', 'Todo'],
                url: 'https://nala.dtw.com.mx/',
            },
            {
                name: 'REPORTEO ADTI',
                img: ReporteoADTI,
                category: ['Sistemas de gestión', 'Todo'],
                url: 'https://nala.dtw.com.mx/',
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

},
props:{
    filterProjects: String
},
methods:{

}
}
</script>