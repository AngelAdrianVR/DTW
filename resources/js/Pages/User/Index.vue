<template>
  <AppLayout title="Usuarios">
    <div class="lg:px-10 px-2 py-5">
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <div class="flex items-center space-x-4">
            <i class="fa-solid fa-user-group text-lg"></i>
            <p>Usuarios</p>
          </div>
        </h2>
          <PrimaryButton @click="$inertia.get(route('users.create'))"> Crear usuario </PrimaryButton>
      </div>  

      <!-- Buscador -->
      <div class="lg:w-1/4 relative mt-4">
          <input v-model="inputSearch" @keyup.enter="handleSearch" class="input w-full !pl-9"
              placeholder="Buscar usuario" type="search">
          <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
      </div>
    </div>

    <!-- Tabla de proyectos -->
    <Loading v-if="loading" class="mt-20" />
      <div v-else class="lg:w-11/12 mx-auto px-2">
          <p v-if="localUsers.length" class="text-gray66 text-[11px]">{{ localUsers.length }} de {{
              total_users }} elementos
          </p>
          <UsersTable :users="filteredTableData" />
          <p v-if="loadingItems" class="text-xs my-4 text-center">
              Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-primary"></i>
          </p>
          <button v-else-if="total_users > 20 && localUsers.length < total_users && localUsers.length"
              @click="fetchItemsByPage" class="w-full text-primary my-4 text-xs mx-auto underline ml-6">
              Cargar más elementos
          </button>
      </div>
  </AppLayout>
</template>

<script>
import UsersTable from "@/Components/MyComponents/User/UsersTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Loading from '@/Components/MyComponents/Loading.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from 'axios';

export default {
  data() {  
    return {
      loading: false,
      localUsers: this.users.data,
      loadingItems: false, //para paginación
      currentPage: 1, //para paginación
      toast: null,
      inputSearch: "", //buscador
      search: null, //buscador
    };
  },
  components: {
    PrimaryButton,
    UsersTable,
    AppLayout,
    Loading,
  },
  props: {
    users: Object,
    total_users: Number,
  },
  methods: {
  handleSearch() {
    this.search = this.inputSearch;
  },
  async fetchItemsByPage() {
    try {
        this.loadingItems = true;
        const response = await axios.get(route('users.get-by-page', this.currentPage));

        if (response.status === 200) {
            this.localUsers = [...this.localUsers, ...response.data.items];
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
        return this.localUsers;
      } else {
        return this.localUsers.filter(
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
