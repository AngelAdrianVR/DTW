<template>
  <div class="overflow-auto">
    <table v-if="suscription_projects?.length" class="w-full">
        <thead>
            <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
            <th>ID</th>
            <th>Nombre</th>
            <th>Suscriptores</th>
            <th>Precio</th>
            <th>Planes</th>
            <th>Estatus</th>
            <th>Fecha de lanzamiento</th>
            <th>Responsable</th>
            <th></th>
            </tr>
        </thead>
        <tbody>
            <tr @click="$inertia.visit(route('suscription-projects.show', item))" v-for="item in suscription_projects" :key="item.id"
            class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
            <td class="rounded-s-full">{{ String(item.id).padStart(3, '0') }}</td>
            <td>{{ item.name ?? '-' }}</td>
            <td>{{ item.subscribers_quantity ?? '-' }}</td>
            <td>${{ item.public_price?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? '-' }}</td>
            <td>{{ item.plans_quantity }}</td>
            <td> <p :class="getStatusStyles(item.status)" class="border rounded-full text-center p-1">{{ item.status ?? 'estatus' }}</p></td>
            <td>{{ item.release_date }}</td>
            <td>{{ item.responsible?.name ?? '-' }}</td>
            <td class="rounded-e-full text-end">
                <el-dropdown trigger="click" @command="handleCommand">
                <button @click.stop
                    class="el-dropdown-link justify-center items-center size-6 hover:bg-primary hover:text-primarylight rounded-full text-primary transition-all duration-200 ease-in-out">
                    <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <template #dropdown>
                    <el-dropdown-menu>
                    <el-dropdown-item :command="'x-edit-' + item.id">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-[14px] mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>
                        <span class="text-xs">Editar</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'En funcionamiento-update_status-' + item.id">
                        <i class="fa-solid fa-check text-xs text-green-600"></i>
                        <span class="text-xs text-green-600">En funcionamiento</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'En mantenimiento-update_status-' + item.id">
                        <i class="fa-solid fa-hammer text-xs text-amber-600"></i>
                        <span class="text-xs text-amber-600">En mantenimiento</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'Actualizando-update_status-' + item.id">
                      <i class="fa-solid fa-cloud-arrow-up text-xs text-blue-600"></i>
                        <span class="text-xs text-blue-600">Actualizando</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'Deshabilitado-update_status-' + item.id">
                        <i class="fa-solid fa-ban text-xs text-red-600"></i>
                        <span class="text-xs text-red-600">Deshabilitado</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'x-delete-' + item.id">
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
    <el-empty v-else description="No hay usuarios registrados" />
  </div>


    <!-- Delete confirmation modal -->
    <ConfirmationModal :show="showDeleteConfirm" @close="showDeleteConfirm = false">
    <template #title>
        <h1>Eliminar proyecto</h1>
    </template>
    <template #content>
        <p>Se eliminará el proyecto y todos los registros relacionados al mismo. ¿Continuar de todas formas?</p>
    </template>
    <template #footer>
        <div class="flex items-center space-x-1">
        <CancelButton @click="showDeleteConfirm = false">Cancelar</CancelButton>
        <DangerButton @click="deleteItem">Eliminar</DangerButton>
        </div>
    </template>
    </ConfirmationModal>
</template>

<script>
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import CancelButton from "@/Components/CancelButton.vue";

export default {
data() {
    return {
        showDeleteConfirm: false,
        itemIdToDelete: null,
    }
},
components:{
ConfirmationModal,
DangerButton,
CancelButton
},
props:{
suscription_projects: Array
},
methods:{
    handleCommand(command) {
      const status = command.split('-')[0];
      const commandName = command.split('-')[1];
      const itemId = command.split('-')[2];

      if (commandName == 'edit') {
        this.$inertia.get(route('suscription-projects.edit', itemId));
      } else if (commandName == 'update_status') {
        this.$inertia.put(route('suscription-projects.update-status', [itemId, status]));
        this.updateStatus(itemId, status);
      } else if (commandName == 'delete') {
        this.showDeleteConfirm = true;
        this.itemIdToDelete = itemId;
      }
    },
    getStatusStyles(status) {
      if (status === 'En funcionamiento') {
        return 'text-green-500 border-green-500 bg-green-100';
      } else if (status === 'En mantenimiento') {
        return 'text-amber-600 border-amber-600 bg-amber-100';
      } else if (status === 'Actualizando') {
        return 'text-blue-600 border-blue-600 bg-blue-100';
      } else if (status === 'Deshabilitado') {
        return 'text-red-600 border-red-600 bg-red-100';
      }
    },
    updateStatus(itemId, status) {    
      this.suscription_projects.findIndex(item => item.id == itemId )
      this.suscription_projects[0].status = status;
      this.$notify({
        title: "Correcto",
        message: "Se cambió el estatus a '" + status + "'",
        type: "success",
      });
    },
    async deleteItem() {
      try {
        this.showDeleteConfirm = false;
        const response = await axios.delete(route('suscription-projects.destroy', this.itemIdToDelete));

        if (response.status === 200) {
          const index = this.suscription_projects.findIndex(item => item.id == this.itemIdToDelete);
          this.suscription_projects.splice(index, 1);
          this.$notify({
            title: "Correcto",
            message: "Proyecto eliminado con éxito",
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
}
</script>
