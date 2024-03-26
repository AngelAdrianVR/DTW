<template>
    <div class="w-11/12 lg:mx-8 my-10 overflow-auto">
      <table v-if="projects?.length" class="w-full mx-auto text-sm">
        <thead>
          <tr class="text-center">
            <th class="font-bold pb-3 pl-2 text-left">ID</th>
            <th class="font-bold pb-3 text-left">Cliente</th>
            <th class="font-bold pb-3 text-left">Nombre del proyecto</th>
            <th class="font-bold pb-3 text-left">Costo del proyecto</th>
            <th class="font-bold pb-3 text-left">Días</th>
            <th class="font-bold pb-3 text-left">F. inicio</th>
            <th class="font-bold pb-3 text-left">F. est. de término</th>
            <th class="font-bold pb-3 text-left">Estatus</th>
            <th class="font-bold pb-3 text-left">Tareas</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id" class="mb-4 cursor-pointer hover:bg-primarylight group"
            @click="$inertia.get(route('projects.show', project.id))">
            <td class="text-left py-2 pr-2 pl-4 rounded-l-full">{{ project.id }}</td>
            <td class="text-left py-2">{{ project.client?.name ?? project.customer_info?.name }}</td>
            <td :title="project.name" class="text-left py-2 max-w-[220px] truncate pr-2">{{ project.name }}</td>
            <td class="text-left py-2">{{ project.price?.formated }}</td>
            <td class="text-left py-2">{{ project.total_work_days }}</td>
            <td class="text-left py-2">{{ project.start_date }}</td>
            <td class="text-left py-2">{{ project.estimated_date }}</td>
            <td class="text-left py-2">
              <span
                :class="calculateProjectStatus(project.tasks)?.text_color + ' ' + calculateProjectStatus(project.tasks)?.bg"
                class="py-1 px-2 rounded-full border border-white">{{ calculateProjectStatus(project.tasks)?.label
                }}</span>
            </td>
            <td class="text-left py-2 rounded-r-full flex space-x-px items-center">
              <p class="text-[10px] mt-1">{{ project.tasks.filter(task => task.status === 'Terminada').length }}</p>
              <div class="relative bg-gray4 rounded-full h-5 w-24 mt-1 border border-primary group-hover:border-white">
                <div
                  :class="(project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) * 100 == 100 ? 'rounded-full' : 'rounded-l-full'"
                  class="absolute top-0 left-0 bg-primary h-5"
                  :style="{ width: (project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) * 100 + '%' }">
                </div>
                <p class="text-xs mt-px absolute top-0 right-8 text-black">{{ project.tasks.length != 0 ?
                  Math.round((project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) *
                    100) : '0' }}%</p>
              </div>
              <p class="text-[10px] mt-1">{{ project.tasks.length }}</p>
            </td>
            <td class="rounded-e-full text-end pr-4">
              <el-dropdown trigger="click" @command="handleCommand">
                <button @click.stop
                  class="el-dropdown-link justify-center items-center size-6 hover:bg-primary hover:text-primarylight rounded-full text-primary transition-all duration-200 ease-in-out">
                  <i class="fa-solid fa-ellipsis-vertical"></i>
                </button>
                <template #dropdown>
                  <el-dropdown-menu>
                    <el-dropdown-item :command="'edit-' + project.id">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-[14px] mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                      </svg>
                      <span class="text-xs">Editar</span>
                    </el-dropdown-item>
                    <el-dropdown-item :command="'delete-' + project.id">
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
      <el-empty v-else description="No hay proyectos registrados" />
    </div>

    <!-- Delete confirmation modal -->
    <ConfirmationModal :show="showDeleteConfirm" @close="showDeleteConfirm = false">
      <template #title>
        <h1>Eliminar cliente</h1>
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
projects: Array
},
methods:{
  handleCommand(command) {
      const commandName = command.split('-')[0];
      const itemId = command.split('-')[1];

      if (commandName == 'edit') {
        this.$inertia.get(route('projects.edit', itemId));
      } else {
        this.showDeleteConfirm = true;
        this.itemIdToDelete = itemId;
      }
    },
    async deleteItem() {
      try {
        this.showDeleteConfirm = false;
        const response = await axios.delete(route('projects.destroy', this.itemIdToDelete));

        if (response.status === 200) {
          const index = this.projects.findIndex(item => item.id == this.itemIdToDelete);
          this.projects.splice(index, 1);
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
    calculateProjectStatus(tasks) {
      const totalTasks = tasks.length;
      const completedTasks = tasks.filter(task => task.status === 'Terminada').length;
      const inProgressTasks = tasks.filter(task => task.status === 'En curso').length;

      if (totalTasks === 0) {
        return {
          label: 'Sin tareas',
          text_color: 'text-red-600',
          bg: 'bg-red-200',
        };
      }
      if (completedTasks === totalTasks) {
        return {
          label: 'Terminado',
          text_color: 'text-green-600',
          bg: 'bg-green-200',
        };
      } else if (inProgressTasks > 0 || completedTasks > 0) {
        return {
          label: 'En proceso',
          text_color: 'text-secondary',
          bg: 'bg-blue-200',
        };
      } else {
        return {
          label: 'Sin iniciar',
          text_color: 'text-orange-600',
          bg: 'bg-orange-200',
        };
      }
    },
  }
}
</script>