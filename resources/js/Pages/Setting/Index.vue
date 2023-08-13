<template>
  <AppLayout title="Configuraciones">
    <template #header>
      <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          <i class="fa-solid fa-gear text-gray-500 text-lg mr-2"></i>Configuraciones
        </h2>
        <Link :href="route('settings.create')">
          <SecondaryButton> Agregar + </SecondaryButton>
        </Link>
      </div>
    </template>
    <!-- tabs section starts -->
    <el-tabs
      v-model="activeName"
      @tab-change="handleTabChange"
      class="demo-tabs lg:ml-10 mx-auto w-11/12"
    >
      <el-tab-pane label="Usuario" name="user">User</el-tab-pane>
      <el-tab-pane label="Recursos" name="resources">Config</el-tab-pane>
      <el-tab-pane label="Finanzas" name="finances">
        <div class="flex flex-col space-y-10 lg:flex-row">
          <div class="lg:mr-10">
            <h1 class="text-2xl text-indigo-800 mb-2">Costos opereativos mensuales:</h1>
            <ul>
              <li v-for="finance in array_settings_filtered" :key="finance.id">
                {{ finance.key }} $<input
                  step="0.1"
                  class="input"
                  type="number"
                  :value="finance.value"
                />
              </li>
              <li class="text-gray-900 mt-4">Gastos mensuales: $ {{month_outcomes}}</li>
              <li class="text-gray-900 font-bold">Costos anuales: $ {{month_outcomes * 12}}</li>
            </ul>
            <h2 class="text-green-600 font-bold">Tarifa por hora: ${{ month_outcomes / (week_hours_work[0]?.value * 4 * 3)}} </h2>
          </div> 
        </div>
      </el-tab-pane>
      <el-tab-pane label="Configuraciones" name="configs"
        ><div class="lg:w-5/6 mx-auto mt-6">
          <el-table :data="settings.data" max-height="450" style="width: 100%">
            <el-table-column type="selection" width="55" />
            <el-table-column prop="key" label="Nombre" width="180" />
            <el-table-column prop="value" label="Valor" width="80" />
            <el-table-column prop="type" label="Tipo" width="80" />
            <el-table-column prop="description" label="Descripción" width="300" />
            <el-table-column prop="created_at" label="Creado el" />
            <el-table-column fixed="right" label="Actiones" width="100">
              <template #default="scope">
                <el-button @click="edit(scope.row)" size="small" type="primary"
                  >Edit</el-button
                >
              </template>
            </el-table-column>
          </el-table>
        </div></el-tab-pane
      >
    </el-tabs>
    <!-- tabs section ends -->
  </AppLayout>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { ref } from "vue";

export default {
  data() {
    const form = useForm({});
    const activeName = ref("user");

    return {
      form,
      activeName: "user",
      array_settings_filtered: [],
      month_outcomes: 0,
      year_outcomes: 0,
      week_hours_work: {},
    };
  },
  components: {
    AppLayout,
    SecondaryButton,
    Link,
  },
  props: {
    settings: Array,
  },
  methods: {
    edit(row) {
      this.$inertia.get(route("settings.edit", row.id));
    },

    handleTabChange() {
      switch (this.activeName) {
        case "user":
          this.array_settings_filtered = this.settings.data.filter(
            (setting) => setting.type == "usuarios"
          );
          break;

        case "resources":
          this.array_settings_filtered = this.settings.data.filter(
            (setting) => setting.type == "recursos"
          );
          break;

        case "finances":
          this.array_settings_filtered = this.settings.data.filter(
            (setting) => setting.type == "finanzas"
          );
          this.week_hours_work = this.settings.data.filter(
            (setting) => setting.key == "Jornada laboral"
          );
          this.month_outcomes =  this.array_settings_filtered.reduce((acumulador, objeto) => {
            return acumulador + parseInt(objeto.value);
          }, 0);
          break;
      }
    },
  },
};
</script>

<style>
.demo-tabs > .el-tabs__content {
  padding: 32px;
  color: #6b778c;
  font-size: 16px;
  font-weight: 300;
}
</style>
