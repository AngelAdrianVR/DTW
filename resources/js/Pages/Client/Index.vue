<template>
  <AppLayout title="Clientes">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <h1>Clientes</h1>
        <!-- Buscador -->
        <div class="flex flex-col lg:flex-row justify-between space-y-3 space-x-3 lg:items-center mt-4 mx-2 lg:mx-10">
          <SearchInput @search="handleSearch" />
          <el-tag v-if="search" size="large" closable @close="handleTagClose">
            Estas buscando: <b>{{ search }}</b>
          </el-tag>
        </div>
      </header>
      <main>
        <!-- Tickets -->
        <section v-if="loading" class="mt-32">
          <Loading />
        </section>
        <section v-else class="mt-7">
          <div v-if="localItems.length" class="flex items-center space-x-9 border-b border-grayD9 pb-2">
            <p class="text-gray66 text-right text-[11px]">{{ localItems.length }} de {{ total_items }} elementos </p>
          </div>
          <!-- <TicketRow v-for="ticket in localItems" :key="ticket" :ticket="ticket" :selectTicket="selectAllTickets"
            @selected="selectedTicket" @unselected="unselectedTicket" /> -->
          <p class="text-gray66 text-left ml-8 mt-2 text-[11px]">{{ localItems.length }} de {{ total_items }} elementos
          </p>
          <p v-if="loadingItems" class="text-xs my-4 text-center">
            Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-secondary"></i>
          </p>
          <button v-else-if="localItems.length && !search && (total_items > 15 && localItems.length < total_items)"
            @click="fetchItemsByPage" class="w-full text-secondary my-4 text-xs mx-auto underline ml-6">
            Cargar más elementos
          </button>
          <el-empty image="https://dtw.com.mx/storage/empty.png" v-if="!localItems.length" description="No hay clientes para mostrar" />
        </section>
      </main>
    </div>
  </AppLayout>
</template>

<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import SearchInput from "@/Components/MyComponents/SearchInput.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  data() {
    return {
      loading: false,
      // paginacion dinamica
      currentPage: 1,
      loadingItems: false,
      // busqueda
      searchTemp: null,
      search: null,
      localItems: this.clients,
      itemsBuffer: [],
    };
  },
  components: {
    AppLayout,
    Loading,
    SearchInput,
  },
  props: {
    clients: Array,
    total_items: Number,
  },
  methods: {
    handleSearch(query) {
      this.search = query;
      if (this.search) {
        this.fetchMatches();
      } else {
        this.showAllItems();
      }
    },
    handleTagClose() {
      this.search = null;
      this.showAllItems();
    },
    showAllItems() {
      // solo si hay items en el buffer, para no dejar vacio el arreglo principal
      if (this.itemsBuffer.length) {
        this.localItems = this.itemsBuffer;
        this.itemsBuffer = [];
      }
    },
    async fetchItemsByPage() {
      try {
        this.loadingItems = true;
        const response = await axios.get(route('clients.get-by-page', this.currentPage));

        if (response.status === 200) {
          this.localItems = [...this.localItems, ...response.data.items];
          this.currentPage++;
        }
      } catch (error) {
        console.log(error)
      } finally {
        this.loadingItems = false;
      }
    },
    async fetchMatches() {
      try {
        this.loading = true;
        const response = await axios.get(route('clients.get-matches', { query: this.search }));

        if (response.status === 200) {
          if (!this.itemsBuffer.length) {
            this.itemsBuffer = this.localItems;
          }
          this.localItems = response.data.items;
        }
      } catch (error) {
        console.log(error);
      } finally {
        this.loading = false;
      }
    },
  }
};
</script>