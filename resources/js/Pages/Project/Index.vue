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
    <ProjectsTable :projects="filteredTableData" />

<div class="lg:w-full mx-auto mt-6">
    <div class="flex justify-end lg:mr-28">
                <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#FF0000"
                    title="Continuar con la eliminacion?" @confirm="deleteSelections">
                    <template #reference>
                        <el-button type="danger" plain class="mb-3" :disabled="disableMassiveActions">Eliminar</el-button>
                    </template>
                </el-popconfirm>
            </div>
    <div class="lg:w-5/6 mx-auto mt-6 cursor-pointer">
  <el-table :data="projects.data" max-height="650" @row-click="handleRowClick" style="width: 100%" @selection-change="handleSelectionChange"
  ref="multipleTableRef" :row-class-name="tableRowClassName">
    <el-table-column type="selection" width="55" />
    <el-table-column prop="key" label="Clave" width="60" />
    <el-table-column prop="customer_info[name]" label="Cliente" />
    <el-table-column prop="customer_info[company]" label="Empresa" />
    <el-table-column prop="price.formated" label="Precio" />
    <el-table-column prop="start_date" label="Fecha de inicio" />
    <el-table-column prop="finish_date" label="Fecha de termino" />
    <el-table-column prop="created_at" label="Fecha de Creacion" />
    <el-table-column label="Acciones" width="200">
    <template v-slot="scope">
      <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#FF0000"
                    title="Continuar con la acción?" @confirm="finishProject(scope.row)">
                    <template #reference>
                        <el-button v-if="!scope.row.finish_date" @click.stop="" type="success" size="small">Terminar</el-button>
                    </template>
            </el-popconfirm>
      <el-button type="primary" size="small" @click.stop="editProject(scope.row)">Editar</el-button>
    </template>
  </el-table-column>
</el-table>
</div>
  </div>
  </AppLayout>
</template>

<script>
import ProjectsTable from "@/Components//MyComponents/Project/ProjectsTable.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import axios from 'axios';

export default {
  data() {  
    return {
      disableMassiveActions: true,
      toast: null,
      inputSearch: "", //buscador
      search: "", //buscador
    };
  },
  components: {
    ProjectsTable,
    PrimaryButton,
    AppLayout,
    Link
  },
  props: {
    projects: Object,
    messages: {
            type: Array,
            default: []
        },
  },
  methods: {
    handleRowClick(row) {
            this.$inertia.get(route('projects.show', row));
        },
     finishProject(row) {
     this.$inertia.put(route('projects.finish',row.id));
     this.$notify({
                title: 'Success',
                message: "The project has been finished!",
                type: 'success'
            });
  },
  editProject(row){
    this.$inertia.get(route('projects.edit', row.id));
  },
    handleSelectionChange(val) {
            this.$refs.multipleTableRef.value = val;

            if (!this.$refs.multipleTableRef.value.length) {
                this.disableMassiveActions = true;
            } else {
                this.disableMassiveActions = false;
            }
        },
    async deleteSelections() {
            try {
                const response = await axios.post(route('projects.massive-delete', {
                    messages: this.$refs.multipleTableRef.value
                }));

                if (response.status == 200) {
                    // let indexes = [];
                    this.toast.success(response.data.message);

                    // update list of messages
                    let deletedIndexes = [];
                    this.projects.data.forEach((message, index) => {
                        if (this.$refs.multipleTableRef.value.includes(message)) {
                            deletedIndexes.push(index);
                        }
                    });

                    // Ordenar los índices de forma descendente para evitar problemas de desplazamiento al eliminar elementos
                    deletedIndexes.sort((a, b) => b - a);

                    // Eliminar mensajes por índice
                    for (const index of deletedIndexes) {
                        this.projects.data.splice(index, 1);
                    }

                } else {
                    this.toast.error(response.data.message);
                }

            } catch (err) {
                this.toast.error(err);
                console.log(err);
            }
        },
        tableRowClassName({ row, rowIndex }) {
            if (row.finish_date) {
                return 'text-green-600';
            }

            return '';
        },
        handleSearch() {
          this.search = this.inputSearch;
        },
  },
  computed: {
    filteredTableData() {
      if (!this.search) {
        return this.projects.data;
      } else {
        return this.projects.data.filter(
          (project) =>
            project.id.toString().toLowerCase().includes(this.search.toLowerCase()) ||
            project.name.toLowerCase().includes(this.search.toLowerCase()) ||
            // project.status.toLowerCase().includes(this.search.toLowerCase()) ||
            project.customer_info.name.toLowerCase().includes(this.search.toLowerCase())
        );
      }
    },
  },
  mounted() {
        this.toast = useToast();
    }
};
</script>
