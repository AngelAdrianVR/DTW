<template>
  <AppLayout title="Clientes">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <h1>Clientes</h1>
        <!-- Buscador -->
        <div class="flex flex-col lg:flex-row justify-between space-y-3 space-x-3 lg:items-center mt-4">
          <SearchInput @search="handleSearch" />
          <el-tag v-if="search" size="large" closable @close="handleTagClose">
            Estas buscando: <b>{{ search }}</b>
          </el-tag>
          <PrimaryButton @click="$inertia.visit(route('clients.create'))">Crear cliente</PrimaryButton>
        </div>
      </header>
      <main>
        <Loading v-if="loading" class="mt-20" />
        <article v-else-if="localClients.length" class="w-full mt-7">
          <div class="flex items-center space-x-9 mb-4">
            <p class="text-gray66 text-right text-[11px]">{{ localClients.length }} de {{ localTotalItems }} elementos
            </p>
          </div>
          <table class="w-full">
            <thead>
              <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
                <th>ID</th>
                <th>Cliente</th>
                <th>RFC</th>
                <th>Domicilio</th>
                <th>Estado</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr @click="$inertia.visit(route('clients.show', item))" v-for="item in localClients" :key="item.id"
                class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
                <td class="rounded-s-full">{{ String(item.id).padStart(3, '0') }}</td>
                <td>{{ item.name ?? '-' }}</td>
                <td>{{ item.rfc ?? '-' }}</td>
                <td>{{ item.address ?? '-' }}</td>
                <td>{{ item.state }}</td>
                <td>{{ item.contacts[0].name }}</td>
                <td>{{ item.contacts[0].phone }}</td>
                <td>{{ item.contacts[0].email ?? '-' }}</td>
                <td class="rounded-e-full text-end">
                  <el-dropdown trigger="click" @command="handleCommand">
                    <button @click.stop
                      class="el-dropdown-link justify-center items-center size-6 hover:bg-primary hover:text-primarylight rounded-full text-primary transition-all duration-200 ease-in-out">
                      <i class="fa-solid fa-ellipsis-vertical"></i>
                    </button>
                    <template #dropdown>
                      <el-dropdown-menu>
                        <el-dropdown-item :command="'edit-' + item.id">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-[14px] mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                          </svg>
                          <span class="text-xs">Editar</span>
                        </el-dropdown-item>
                        <el-dropdown-item :command="'delete-' + item.id">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-[14px] mr-2 text-red-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                          </svg>
                          <span class="text-xs text-red-600">Eliminar</span>
                        </el-dropdown-item>
                      </el-dropdown-menu>
                    </template>
                  </el-dropdown>
                </td>
              </tr>
            </tbody>
          </table>
          <p class="text-gray66 text-left mt-4 text-[11px]">{{ localClients.length }} de {{ localTotalItems }}
            elementos
          </p>
          <p v-if="loadingItems" class="text-xs my-4 text-center">
            Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-secondary"></i>
          </p>
          <button
            v-else-if="localClients.length && !search && (localTotalItems > 15 && localClients.length < localTotalItems)"
            @click="fetchItemsByPage" class="w-full text-secondary my-4 text-xs mx-auto underline ml-6">
            Cargar más elementos
          </button>
        </article>
        <el-empty v-else description="No hay clientes para mostrar" />
      </main>
    </div>

    <ConfirmationModal :show="showDeleteConfirm" @close="showDeleteConfirm = false">
      <template #title>
        <h1>Eliminar cliente</h1>
      </template>
      <template #content>
        <p>Se eliminará el cliente y todos los registros relacionados al mismo. ¿Continuar de todas formas?</p>
      </template>
      <template #footer>
        <div class="flex items-center space-x-1">
          <CancelButton @click="showDeleteConfirm = false">Cancelar</CancelButton>
          <DangerButton @click="deleteItem">Eliminar</DangerButton>
        </div>
      </template>
    </ConfirmationModal>
  </AppLayout>
</template>

<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SearchInput from "@/Components/MyComponents/SearchInput.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import CancelButton from "@/Components/CancelButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  data() {
    return {
      loading: false,
      showDeleteConfirm: false,
      localClients: this.clients,
      localTotalItems: this.total_items,
      itemIdToDelete: null,
      // paginacion dinamica
      currentPage: 1,
      loadingItems: false,
      // busqueda
      searchTemp: null,
      search: null,
      itemsBuffer: [],
    };
  },
  components: {
    AppLayout,
    Loading,
    SearchInput,
    PrimaryButton,
    ConfirmationModal,
    DangerButton,
    CancelButton,
  },
  props: {
    clients: Array,
    total_items: Number,
  },
  methods: {
    handleCommand(command) {
      const commandName = command.split('-')[0];
      const itemId = command.split('-')[1];

      if (commandName == 'edit') {
        this.$inertia.get(route('clients.edit', itemId));
      } else {
        this.showDeleteConfirm = true;
        this.itemIdToDelete = itemId;
      }
    },
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
        this.localClients = this.itemsBuffer;
        this.itemsBuffer = [];
      }
    },
    async fetchItemsByPage() {
      try {
        this.loadingItems = true;
        const response = await axios.get(route('clients.get-by-page', this.currentPage));

        if (response.status === 200) {
          this.localClients = [...this.localClients, ...response.data.items];
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
            this.itemsBuffer = this.localClients;
          }
          this.localClients = response.data.items;
        }
      } catch (error) {
        console.log(error);
      } finally {
        this.loading = false;
      }
    },
    async deleteItem() {
      try {
        this.showDeleteConfirm = false;
        this.loading = true;
        const response = await axios.delete(route('clients.destroy', this.itemIdToDelete));

        if (response.status === 200) {
          const index = this.localClients.findIndex(item => item.id == this.itemIdToDelete);
          this.localClients.splice(index, 1);
          this.localTotalItems--;
          this.$notify({
            title: "Correcto",
            message: "",
            type: "success",
          });
        }
      } catch (error) {
        this.$notify({
          title: "No se pudo completar la solicitud",
          message: "El servidor no pudo procesar la petición, inténtalo más tarde",
          type: "error",
        });
        console.log(error);
      } finally {
        this.loading = false;
      }
    },
  }
};
</script>