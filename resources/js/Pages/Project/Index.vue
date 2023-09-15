<template>
  <AppLayout title="Proyectos">
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <i class="fa-solid fa-laptop text-gray-500 text-lg mr-2"></i>Proyectos
        </h2>
        <Link :href="route('projects.create')">
          <SecondaryButton> Agregar + </SecondaryButton>
        </Link>
      </div>
    </template>

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
  <el-table :data="projects.data" max-height="450" @row-click="handleRowClick" style="width: 100%" @selection-change="handleSelectionChange"
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
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import axios from 'axios';

export default {
  data() {
    return {
      disableMassiveActions: true,
       toast: null,
    };
  },
  components: {
    ApplicationLogo,
    AppLayout,
    SecondaryButton,
    Link,
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
  },
  mounted() {
        this.toast = useToast();
    }
};
</script>
