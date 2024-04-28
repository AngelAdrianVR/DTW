<template>
  <AppLayout title="Suscripción-editar">
    <Back class="mt-5 ml-7" />
    <div class="lg:w-[60%] w-[95%] mx-auto p-3 mt-9 lg:py-4 lg:px-5 border border-[#D9D9D9] rounded-lg">
      <h1 class="font-bold">Editar proyecto de suscripción</h1>

      <form class="mt-4 md:grid grid-cols-2 gap-4" @submit.prevent="update">
        <div class="mt-3 md:mt-0">
          <InputLabel value="Nombre del proyecto*" class="ml-3 mb-1" />
          <el-input v-model="form.name" placeholder="Escribe el nombre del proyecto" clearable />
          <InputError :message="$page.props?.errors.name" />
        </div>

        <div>
            <InputLabel value="Número de suscritos*" />
            <el-input v-model="form.subscribers_quantity" type="text" placeholder="Ingresa el número de suscriptores"
            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')">
            </el-input>
            <InputError :message="form.errors.subscribers_quantity" />
        </div>

        <div>
            <div class="flex items-center">
                <InputLabel value="Precio de suscripción*" /> 
                <el-tooltip content="Si tiene varios planes ingresa el más barato" placement="right">
                    <i class="fa-regular fa-circle-question ml-2 text-primary text-xs"></i>
                </el-tooltip>
            </div>
            <el-input v-model="form.public_price" type="text" placeholder="Ingresa el precio por suscripción"
            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')">
            <template #prefix>
                <i class="fa-solid fa-dollar"></i>
            </template>
            </el-input>
            <InputError :message="form.errors.public_price" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Número de planes*" class="ml-3 mb-1" />
          <el-input v-model="form.plans_quantity" type="number" placeholder="Ingresa el número de planes" clearable />
          <InputError :message="$page.props?.errors.plans_quantity" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Estatus*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.status" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="item in statuses" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="$page.props?.errors.status" />
        </div>

        <div class="mt-3 md:mt-0">
            <InputLabel value="Fecha de lanzamiento" class="ml-3 mb-1" />
            <el-date-picker v-model="form.release_date" placeholder="Selecciona una fecha" :disabled-date="disabledDate" class="!w-full" />
            <InputError :message="$page.props?.errors.release_date" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Responsable" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.responsible_id" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="user in users" :key="user.id" :label="user.name" :value="user.id">
                <div v-if="$page.props.jetstream.managesProfilePhotos"
                  class="flex text-sm rounded-full items-center mt-[3px]">
                  <img class="h-7 w-7 rounded-full object-cover mr-4" :src="user.profile_photo_url" :alt="user.name" />
                  <p>{{ user.name }}</p>
                </div>
              </el-option>
          </el-select>
          <InputError :message="$page.props?.errors.responsible_id" />
        </div>

        <div class="col-span-full mt-3">
          <InputLabel value="Descripción" class="text-sm ml-2" />
          <el-input v-model="form.description"
            :autosize="{ minRows: 3, maxRows: 5 }" type="textarea" placeholder="Escribe una breve descripción del proyecto (opcional)"
            :maxlength="200" show-word-limit clearable />
        </div>

        <div class="col-span-full text-right mt-5">
          <PrimaryButton class="px-12">Guardar cambios</PrimaryButton>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import Back from "@/Components/MyComponents/Back.vue";
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      name: this.suscription_project.name,
      subscribers_quantity: this.suscription_project.subscribers_quantity,
      public_price: this.suscription_project.public_price,
      plans_quantity: this.suscription_project.plans_quantity,
      status: this.suscription_project.status,
      release_date: this.suscription_project.release_date,
      responsible_id: this.suscription_project.responsible_id,
      description: this.suscription_project.description,
    });
    return {
      form,
      statuses: ['En funcionamiento', 'En mantenimiento', 'Deshabilitado', 'Actualizando'],
    };
  },
  components: {
    SecondaryButton,
    PrimaryButton,
    InputError,
    InputLabel,
    AppLayout,
    Back
  },
  props: {
    suscription_project: Object,
    users: Array,
  },
  methods: {
    update() {
      this.form.put(route("suscription-projects.update", this.suscription_project.id), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "Se ha editado el proyecto de suscripción",
            type: "success",
          });
        },
      });
    },
    disabledDate(time) {
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      return time.getTime() > today.getTime();
    },
  },
};
</script>
