<template>
  <AppLayout title="Proyectos de suscripción">
    <div class="lg:px-10 px-2 py-5">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <div class="flex items-center space-x-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" height="18" width="18" id="Desktop-Dollar--Streamline-Core">
                <desc>Desktop Dollar Streamline Icon: https://streamlinehq.com</desc>
                <g id="Desktop-Dollar--Streamline-Core">
                    <path id="Vector" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.76062 2H1c-0.132608 0 -0.259785 0.05268 -0.353553 0.14645C0.552678 2.24021 0.5 2.36739 0.5 2.5v8c0 0.1326 0.052678 0.2598 0.146447 0.3536C0.740215 10.9473 0.867392 11 1 11h12c0.1326 0 0.2598 -0.0527 0.3536 -0.1464 0.0937 -0.0938 0.1464 -0.221 0.1464 -0.3536v-1" stroke-width="1"></path>
                    <path id="Vector_2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m6 11 -1 2.5" stroke-width="1"></path>
                    <path id="Vector_3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m8 11 1 2.5" stroke-width="1"></path>
                    <path id="Vector_4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M4 13.5h6" stroke-width="1"></path>
                    <path id="Vector 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.4241 2.72214c-0.0585 -0.16561 -0.1488 -0.3162 -0.2636 -0.44444 -0.2441 -0.27278 -0.5989 -0.44445 -0.9938 -0.44445h-1.0321c-0.6573 0 -1.19014 0.53286 -1.19014 1.19018 0 0.55931 0.38944 1.04316 0.93584 1.16268l1.5713 0.34373c0.6121 0.1339 1.0484 0.67634 1.0484 1.30292 0 0.73638 -0.5969 1.33383 -1.3333 1.33383h-0.8889c-0.5806 0 -1.0744 -0.37103 -1.2575 -0.88889" stroke-width="1"></path>
                    <path id="Vector 2489" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M11.7222 1.83333V0.5" stroke-width="1"></path>
                    <path id="Vector 2490" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M11.7222 8.50008V7.16675" stroke-width="1"></path>
                </g>
            </svg>
            <p>Proyectos de suscripción</p>
          </div>
        </h2>
          <PrimaryButton @click="$inertia.get(route('suscription-projects.create'))"> Agregar proyecto </PrimaryButton>
      </div>  

      <!-- Buscador -->
      <div class="lg:w-1/4 relative mt-4">
          <input v-model="inputSearch" @keyup.enter="handleSearch" class="input w-full !pl-9"
              placeholder="Buscar proyecto" type="search">
          <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
      </div>
    </div>

    <!-- Tabla de proyectos de suscripción -->
    <Loading v-if="loading" class="mt-20" />
      <div v-else class="lg:w-11/12 mx-auto px-2">
          <p v-if="localProjects.length" class="text-gray66 text-[11px]">{{ localProjects.length }} de {{
              total_projects }} elementos
          </p>
          <SuscriptionProyectsTable :suscription_projects="filteredTableData" />
          <p v-if="loadingItems" class="text-xs my-4 text-center">
              Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-primary"></i>
          </p>
          <button v-else-if="total_projects > 20 && localProjects.length < total_projects && localProjects.length"
              @click="fetchItemsByPage" class="w-full text-primary my-4 text-xs mx-auto underline ml-6">
              Cargar más elementos
          </button>
      </div>
  </AppLayout>
</template>

<script>
import SuscriptionProyectsTable from "@/Components/MyComponents/SuscriptionProyect/SuscriptionProyectsTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Loading from '@/Components/MyComponents/Loading.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from 'axios';

export default {
  data() {  
    return {
      loading: false,
      localProjects: this.suscription_projects,
      loadingItems: false, //para paginación
      currentPage: 1, //para paginación
      toast: null,
      inputSearch: "", //buscador
      search: null, //buscador
    };
  },
  components: {
    PrimaryButton,
    SuscriptionProyectsTable,
    AppLayout,
    Loading,
  },
  props: {
    suscription_projects: Array,
    total_projects: Number,
  },
  methods: {
  handleSearch() {
    this.search = this.inputSearch;
  },
  async fetchItemsByPage() {
    try {
        this.loadingItems = true;
        const response = await axios.get(route('suscription-projects.get-by-page', this.currentPage));

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
            project.status.toLowerCase().includes(this.search.toLowerCase())
        );
      }
    },
  },
};
</script>
