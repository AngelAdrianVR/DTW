<template>
  <AppLayout title="Prospectos |">
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <i class="fa-solid fa-user-plus text-gray-500 text-lg mr-2"></i>Prospectos
        </h2>
        <Link :href="route('prospects.create')">
          <SecondaryButton> Agregar + </SecondaryButton>
        </Link>
      </div>
    </template>
    <div class="lg:w-5/6 mx-auto mt-6">
      <el-table :data="prospects.data" max-height="650" style="width: 100%" :row-class-name="tableRowClassName">
        <el-table-column type="selection" width="55" />
        <el-table-column prop="prospect_name" label="Nombre prospecto" width="180" />
        <el-table-column prop="company" label="Empresa" width="180" />
        <el-table-column prop="project_type" label="Tipo de proyecto" width="180" />
        <el-table-column prop="notes" label="Notas" width="250" />
        <el-table-column prop="user.name" label="Usuario" width="100" />
        <el-table-column prop="created_at" label="creado el" width="150" />
        <el-table-column fixed="right" label="Actiones" width="110" >
          <template #default="scope">
            <div class="flex flex-col space-y-2 justify-center">
            <el-button @click="edit(scope.row)" size="small" type="primary">Edit</el-button>
            <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#FF0000"
                    title="Continuar con la acción?" @confirm="aprovedProspect(scope.row)">
                    <template #reference>
                        <el-button v-if="scope.row.is_aproved === null" size="small" type="success">Aceptado</el-button>
                    </template>
            </el-popconfirm>
            <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#FF0000"
                    title="Continuar con la acción?" @confirm="rejectedProspect(scope.row)">
                    <template #reference>
                        <el-button v-if="scope.row.is_aproved === null" size="small" type="danger">Rechazado</el-button>
                    </template>
            </el-popconfirm>
            </div>
          </template>
        </el-table-column>
      </el-table>
    </div>
  </AppLayout>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
  data() {
    return {};
  },
  components: {
    AppLayout,
    SecondaryButton,
    Link,
  },
  props: {
    prospects: Array,
  },
  methods:{
    edit(row){
        this.$inertia.get(route('prospects.edit', row.id));
    },
    aprovedProspect(row){
        this.$inertia.put(route('prospects.aproved',row.id));
        this.$inertia.get(route('projects.create'));
    },
    rejectedProspect(row){
        this.$inertia.put(route('prospects.rejected',row.id));
    },
    tableRowClassName({ row, rowIndex }) {
            if (row.is_aproved == 1) {
                return 'text-green-600';
            } else if (row.is_aproved == 0){
                return 'text-red-600';
            }

            return '';
        },
  }
};
</script>
