<template>
  <AppLayout title="Crear tarea">
    <!-- <template #header>
      <div class="flex justify-between">
        <div class="flex items-center space-x-2">
          <h2 class="font-semibold text-xl leading-tight">Nueva tarea</h2>
        </div>
      </div>
    </template> -->

    <div class="p-3">
      <Back />
    </div>
    <!-- Form -->
    <form @submit.prevent="store">
      <div class="md:w-1/2 md:mx-auto my-5 border border-[#D9D9D9] rounded-lg lg:p-9 p-4 space-y-3">
      <h1 class="font-bold">Crear nueva tarea</h1>
        <div>
          <InputLabel value="Proyecto*" class="ml-3" />
          <el-select disabled @change="getProject()" class="w-full mt-2" v-model="form.project_id" clearable filterable
            placeholder="Seleccionar proyecto" no-data-text="No hay proyectos registrados"
            no-match-text="No se encontraron coincidencias">
            <el-option v-for="project in projects" :key="project.id" :label="project.name" :value="project.id" />
          </el-select>
          <InputError :message="form.errors.project_id" />
        </div>
        <div>
          <InputLabel value="Nombre de la tarea*" class="ml-3" />
          <el-input v-model="form.title" type="text" placeholder="Escribe el nombre" clearable />
          <InputError :message="form.errors.title" />
        </div>
        <div>
          <InputLabel value="Departamento*" class="ml-3" />
          <el-select class="w-full mt-2" v-model="form.department" clearable filterable
            placeholder="Seleccionar departamento" no-data-text="No hay departamentos registrados"
            no-match-text="No se encontraron coincidencias">
            <el-option v-for="item in departments" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="form.errors.department" />
        </div>
        <div class="mt-5 col-span-full">
          <InputLabel value="Descripción" class="ml-3" />
          <el-input v-model="form.description"
            :autosize="{ minRows: 3, maxRows: 8 }" type="textarea" placeholder="Escribe una descripción (opcional)"
            :maxlength="1200" show-word-limit clearable />
        </div>
        <FileUploader @files-selected="this.form.media = $event" />
        <div>
          <InputLabel value="Participantes*" class="ml-3" />
          <el-select v-model="form.participants" clearable multiple placeholder="Seleccione" class="w-full mt-1"
            no-data-text="No hay opciones para mostrar" no-match-text="No se encontraron coincidencias">
            <el-option v-for="item in users" :key="item.id"
              :label="item.name" :value="item.id">
              <div v-if="$page.props.jetstream.managesProfilePhotos"
                class="flex text-sm rounded-full items-center mt-[3px]">
                <img class="h-7 w-7 rounded-full object-cover mr-4" :src="item.profile_photo_url" :alt="item.name" />
                <p>{{ item.name }}</p>
              </div>
            </el-option>
          </el-select>
          <InputError :message="form.errors.participants" />
        </div>
        <div class="col-span-full">
          <div class="flex items-center space-x-3">
            <InputLabel value="Prioridad*" class="ml-3" />
            <i class="fa-solid fa-circle text-[10px]" :class="{
              'text-transparent': !form.priority,
              'text-[#87CEEB]': form.priority == 'Baja',
              'text-[#D97705]': form.priority == 'Media',
              'text-[#D90537]': form.priority == 'Alta'
            }"></i>
          </div>
          <el-select v-model="form.priority" clearable placeholder="Seleccione" class="w-1/2 mt-1"
            no-data-text="No hay opciones para mostrar" no-match-text="No se encontraron coincidencias">
            <el-option v-for="item in priorities" :key="item.id" :label="item" :value="item" />
          </el-select>
          <InputError :message="form.errors.priority" />
        </div>
        <div class="pt-1">
          <InputLabel value="Duración*" class="ml-3" />
          <el-date-picker @change="handleDateRange" v-model="range" type="daterange" range-separator="A"
            start-placeholder="Fecha de inicio" end-placeholder="Fecha límite" value-format="YYYY-MM-DD" />
        </div>

        <div class="flex col-span-full justify-end items-center mt-4">
          <PrimaryButton :disabled="form.processing">
            Crear tarea
          </PrimaryButton>
        </div>
      </div>
    </form>
  </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import CancelButton from "@/Components/CancelButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import Modal from "@/Components/Modal.vue";
import Back from "@/Components/MyComponents/Back.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { isSameDay, parseISO } from "date-fns";

export default {
  data() {
    const form = useForm({
      project_id: parseInt(this.parent_id),
      title: null,
      description: null,
      department: null,
      participants: null,
      priority: null,
      start_date: '',
      end_date: '',
      media: [],
    });

    return {
      form,
      remainderModal: false,
      range: null,
      selectedProject: null,
      mediaNames: [], // Agrega esta propiedad para almacenar los nombres de los archivos
      priorities: [
        'Baja',
        'Media',
        'Alta',
      ],
      departments: [
        'Programación',
        'Ventas',
        'Diseño',
        'Marketing',
      ],
    };
  },
  components: {
    AppLayout,
    PrimaryButton,
    CancelButton,
    InputLabel,
    FileUploader,
    InputError,
    Modal,
    Back,
    Link
  },
  props: {
    projects: Array,
    parent_id: Number,
    users: Array,
  },
  methods: {
    handleDateRange(range) {
      this.form.start_date = range[0];
      this.form.end_date = range[1];

      const date1 = parseISO(range[0]);
      const date2 = parseISO(range[1]);

      // Compara si son del mismo día
      if (isSameDay(date1, date2)) {
        this.canSelectTime = true;
      } else {
        this.canSelectTime = false;
        this.enabledTime = false;
      }

    },
    store() {
      this.form.post(route("project-tasks.store"), {
        // _method: 'post',
        onSuccess: () => {
          this.$notify({
            title: "Éxito",
            message: "Se ha creado una nueva tarea",
            type: "success",
          });
        },
      });
    },
    updateDescription(content) {
      this.form.description = content;
    },
    getProject() {
      this.selectedProject = this.projects.find(item => item.id == this.form.project_id);
    },
    // Función para deshabilitar fechas fuera del rango [start_date, limit_date]
    disabledStartOrLimitDate(time) {
      if (this.selectedProject && this.selectedProject.is_strict_project) {
        const startTime = new Date(this.selectedProject.start_date).getTime();
        const limitTime = new Date(this.selectedProject.limit_date).getTime();
        return time.getTime() < startTime || time.getTime() > limitTime;
      }
      return false;
    },

  },
};
</script>
