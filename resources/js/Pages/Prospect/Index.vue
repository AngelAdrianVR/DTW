<template>
  <AppLayout title="Prospectos">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <h1 class="font-bold text-lg flex items-center space-x-1">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
          </svg>
          <span>Prospectos</span>
        </h1>
        <!-- Buscador -->
        <div class="flex justify-between space-x-3 lg:items-center mt-4">
          <SearchInput @search="handleSearch" />
          <el-tag v-if="search" size="large" closable @close="handleTagClose">
            Estas buscando: <b>{{ search }}</b>
          </el-tag>
          <PrimaryButton @click="$inertia.visit(route('prospects.create'))">Crear prospecto</PrimaryButton>
        </div>
      </header>
      <main>
        <Loading v-if="loading" class="mt-20" />
        <article v-else-if="localProspects.length" class="w-full mt-7 overflow-auto">
          <div class="flex items-center space-x-9 mb-4">
            <p class="text-gray66 text-right text-[11px]">{{ localProspects.length }} de {{ localTotalItems }} elementos
            </p>
          </div>
          <table class="w-full">
            <thead>
              <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
                <th>ID</th>
                <th>Nombre</th>
                <th>Creado el</th>
                <th>Contacto</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Estatus</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr @click="$inertia.visit(route('prospects.show', item))" v-for="item in localProspects" :key="item.id"
                class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
                <td class="rounded-s-full">{{ String(item.id).padStart(3, '0') }}</td>
                <td>{{ item.name ?? '-' }}</td>
                <td>{{ formatDateTime(item.created_at) }}</td>
                <td>{{ item.contact.name }}</td>
                <td>{{ item.contact.phone }}</td>
                <td>{{ item.contact.email ?? '-' }}</td>
                <td>
                  <el-tooltip :content="statuses.find(status => status.label == item.status).tooltip" placement="top">
                    <span class="px-2 py-1 rounded-full" :style="{
                        color: statuses.find(status => status.label == item.status).color,
                        backgroundColor: statuses.find(status => status.label == item.status).bg
                      }">{{ item.status }}
                    </span>
                  </el-tooltip>
                </td>
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
                        <el-dropdown-item :command="'turn-' + item.id">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-[14px] mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="m9 9 6-6m0 0 6 6m-6-6v12a6 6 0 0 1-12 0v-3" />
                          </svg>
                          <span class="text-xs">Convertir a cliente</span>
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
          <p class="text-gray66 text-left mt-4 text-[11px]">{{ localProspects.length }} de {{ localTotalItems }}
            elementos
          </p>
          <p v-if="loadingItems" class="text-xs my-4 text-center">
            Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-secondary"></i>
          </p>
          <button
            v-else-if="localProspects.length && !search && (localTotalItems > 15 && localProspects.length < localTotalItems)"
            @click="fetchItemsByPage" class="w-full text-secondary my-4 text-xs mx-auto underline ml-6">
            Cargar más elementos
          </button>
        </article>
        <el-empty v-else description="No hay prospectos para mostrar" />
      </main>
    </div>

    <ConfirmationModal :show="showDeleteConfirm || showTurnConfirm"
      @close="showDeleteConfirm = false; showTurnConfirm = false">
      <template #title>
        <h1 v-if="showDeleteConfirm">Eliminar prospecto</h1>
        <h1 v-else>Convertir prospecto a cliente</h1>
      </template>
      <template #content>
        <p v-if="showDeleteConfirm">Se eliminará el prospecto y todos los registros relacionados al mismo. ¿Continuar de
          todas formas?</p>
        <p v-else>Al continuar, se creará un nuevo registro de cliente con la información de este prospecto, se
          relacionarán todas las cotizaciones
          y se eliminará el prospecto en este modulo. ¿Continuar de todas formas?</p>
      </template>
      <template #footer>
        <div class="flex items-center space-x-1">
          <CancelButton @click="showDeleteConfirm = false; showTurnConfirm = false" :disabled="turning">Cancelar
          </CancelButton>
          <DangerButton v-if="showDeleteConfirm" @click="deleteItem">Eliminar</DangerButton>
          <DangerButton v-else @click="turnItem" :disabled="turning" :isLoading="turning">Continuar</DangerButton>
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
import { format } from 'date-fns';
import { es } from 'date-fns/locale';

export default {
  data() {
    return {
      loading: false,
      turning: false,
      showDeleteConfirm: false,
      showTurnConfirm: false,
      localProspects: this.prospects,
      localTotalItems: this.total_items,
      itemIdToDelete: null,
      itemIdToTurn: null,
      // paginacion dinamica
      currentPage: 1,
      loadingItems: false,
      // busqueda
      searchTemp: null,
      search: null,
      itemsBuffer: [],
      statuses: [
        {
          label: "Contacto inicial",
          bg: "#F1F996",
          color: "#B1B402",
          tooltip: "El prospecto entra en contacto con la empresa por primera vez",
        },
        {
          label: "En proceso de conversión",
          bg: "#BCF996",
          color: "#37A305",
          tooltip: "El responsable esta trabajando para convertir el prospecto en nuevo cliente",
        },
        {
          label: "Perdido",
          bg: "#F7B7FC",
          color: "#9E0FA9",
          tooltip: "El prospecto no se convierte en cliente ",
        },
      ],
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
    prospects: Array,
    total_items: Number,
  },
  methods: {
    formatDateTime(dateTime) {
      let parsedDate = new Date(dateTime);

      return format(parsedDate, 'd MMM, y • hh:mm a', { locale: es }); // Formato personalizado
    },
    handleCommand(command) {
      const commandName = command.split('-')[0];
      const itemId = command.split('-')[1];

      if (commandName == 'edit') {
        this.$inertia.get(route('prospects.edit', itemId));
      } else if (commandName == 'turn') {
        this.showTurnConfirm = true;
        this.itemIdToTurn = itemId;
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
        this.localProspects = this.itemsBuffer;
        this.itemsBuffer = [];
      }
    },
    async fetchItemsByPage() {
      try {
        this.loadingItems = true;
        const response = await axios.get(route('prospects.get-by-page', this.currentPage));

        if (response.status === 200) {
          this.localProspects = [...this.localProspects, ...response.data.items];
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
        const response = await axios.get(route('prospects.get-matches', { query: this.search }));

        if (response.status === 200) {
          if (!this.itemsBuffer.length) {
            this.itemsBuffer = this.localProspects;
          }
          this.localProspects = response.data.items;
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
        const response = await axios.delete(route('prospects.destroy', this.itemIdToDelete));

        if (response.status === 200) {
          const index = this.localProspects.findIndex(item => item.id == this.itemIdToDelete);
          this.localProspects.splice(index, 1);
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
    turnItem() {
      this.turning = true;
      this.$inertia.post(route('prospects.turn-into-client', this.itemIdToTurn));
    },
  }
};
</script>