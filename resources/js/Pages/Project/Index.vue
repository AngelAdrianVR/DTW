<template>
  <AppLayout title="Proyectos">
    <div class="px-10 py-5">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <div class="flex items-center space-x-4">
            <svg width="24" height="24" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <mask id="mask0_8456_162" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="24" height="24">
              <rect width="16" height="16" fill="#D9D9D9"/>
              </mask>
              <g mask="url(#mask0_8456_162)">
              <path d="M6.04818 10.8333L7.99818 9.65001L9.94818 10.8333L9.43151 8.61668L11.1648 7.11668L8.88151 6.93334L7.99818 4.83334L7.11484 6.93334L4.83151 7.11668L6.56484 8.61668L6.04818 10.8333ZM7.99818 15.5333L5.76484 13.3333H2.66484V10.2333L0.464844 8.00001L2.66484 5.76667V2.66667H5.76484L7.99818 0.466675L10.2315 2.66667H13.3315V5.76667L15.5315 8.00001L13.3315 10.2333V13.3333H10.2315L7.99818 15.5333ZM7.99818 13.6667L9.66484 12H11.9982V9.66668L13.6648 8.00001L11.9982 6.33334V4.00001H9.66484L7.99818 2.33334L6.33151 4.00001H3.99818V6.33334L2.33151 8.00001L3.99818 9.66668V12H6.33151L7.99818 13.6667Z" fill="black"/>
              </g>
            </svg>
            <p>Proyectos</p>
          </div>
        </h2>
          <PrimaryButton @click="$inertia.get(route('projects.create'))"> Crear proyecto </PrimaryButton>
      </div>  

      <!-- Buscador -->
      <div class="lg:w-1/4 relative mt-4">
          <input v-model="inputSearch" @keyup.enter="handleSearch" class="input w-full !pl-9"
              placeholder="Buscar proyecto" type="search">
          <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
      </div>
    </div>

    <!-- Tabla de proyectos -->
    <Loading v-if="loading" class="mt-20" />
      <div v-else>
          <p v-if="localProjects.length" class="text-gray66 text-[11px] mx-12">{{ localProjects.length }} de {{
              total_projects }} elementos
          </p>
          <ProjectsTable :projects="filteredTableData" />
          <p v-if="loadingItems" class="text-xs my-4 text-center">
              Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-primary"></i>
          </p>
          <button v-else-if="total_projects > 30 && localProjects.length < total_projects && localProjects.length"
              @click="fetchItemsByPage" class="w-full text-primary my-4 text-xs mx-auto underline ml-6">
              Cargar más elementos
          </button>
      </div>
  </AppLayout>
</template>

<script>
import ProjectsTable from "@/Components/MyComponents/Project/ProjectsTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Loading from '@/Components/MyComponents/Loading.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from 'axios';

export default {
  data() {  
    return {
      loading: false,
      localProjects: this.projects.data,
      loadingItems: false, //para paginación
      currentPage: 1, //para paginación
      inputSearch: "", //buscador
      search: null, //buscador
    };
  },
  components: {
    ProjectsTable,
    PrimaryButton,
    AppLayout,
    Loading,
  },
  props: {
    projects: Object,
    total_projects: Number,
  },
  methods: {
  handleSearch() {
    this.search = this.inputSearch;
  },
  async fetchItemsByPage() {
    try {
        this.loadingItems = true;
        const response = await axios.get(route('projects.get-by-page', this.currentPage));

        if (response.status === 200) {
            this.localProjects = [...this.localProjects, ...response.data.items];
            this.currentPage++;
        }
    } catch (error) {
        console.log(error)
    } finally {
        this.loadingItems = false;
    }
  },
  },
  computed: {
    filteredTableData() {
      if (!this.search) {
        return this.localProjects;
      } else {
        return this.localProjects.filter(
          (project) =>
            project.id.toString().toLowerCase().includes(this.search.toLowerCase()) ||
            project.name.toLowerCase().includes(this.search.toLowerCase()) ||
            project.client?.name.toLowerCase().includes(this.search.toLowerCase())
        );
      }
    },
  },
};
</script>
