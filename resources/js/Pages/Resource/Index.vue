<template>
  <AppLayout title="Recursos">
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <i class="fa-solid fa-photo-film text-gray-500 text-lg mr-2"></i>Administración de recursos
        </h2>
        <Link :href="route('settings.create')">
          <SecondaryButton> Agregar + </SecondaryButton>
        </Link>
      </div>
    </template>
    <div class="lg:w-5/6 mx-auto mt-6">
      <el-table :data="projects" max-height="450" style="width: 100%">
        <el-table-column type="selection" width="55" />
        <el-table-column prop="name" label="Nombre" width="180" />
        <el-table-column prop="client_info[name]" label="Cliente" width="180" />
        <el-table-column prop="client_info[email]" label="Correo" width="180" />
        <el-table-column prop="client_info[phone]" label="Teléfono" width="180" />
        <el-table-column prop="hours_work" label="Horas de trabajo" width="180" />
        <el-table-column prop="cuote" label="Cotización" width="180" />
        <el-table-column
          prop="promisse_finish_date"
          label="Fecha de entrega"
          width="180"
        />
        <el-table-column prop="created_at" label="Creado el" />
        <el-table-column fixed="right" label="Actiones" width="100">
          <template #default="scope">
            <!-- <Link :href="route('projects.edit', project)"> -->
            <el-button @click="edit(scope.row)" size="small" type="primary">Edit</el-button>
            <!-- </Link> -->
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
    projects: Array,
  },
  methods:{
    edit(row){
        console.log(row);
        this.$inertia.get(route('projects.edit', row.id));
    }
  }
};
</script>
