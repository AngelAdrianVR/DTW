<template>
  <AppLayout title="Editar usuario">
    <Back class="mt-5 ml-7" />
    <div class="lg:w-[60%] w-[95%] mx-auto p-3 my-9 lg:py-4 lg:px-5 border border-[#D9D9D9] rounded-lg">
      <h1 class="font-bold">Editar usuario</h1>

      <form class="mt-4 md:grid grid-cols-2 gap-4" @submit.prevent="update">
        <p class="font-bold col-span-full my-1">Información personal</p>
        <div class="mt-3 md:mt-0">
          <InputLabel value="Nombre*" class="ml-3 mb-1" />
          <el-input v-model="form.name" placeholder="Escribe el nombre del usuario" clearable />
          <InputError :message="$page.props?.errors.name" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Correo electrónico" class="ml-3 mb-1" />
          <el-input v-model="form.email" placeholder="Escribe el correo electrónico" clearable />
          <InputError :message="$page.props?.errors.email" />
        </div>

        <div class="mt-3 md:mt-0">
            <InputLabel value="Teléfono*" class="ml-3 mb-1" />
            <el-input v-model="form.employee_properties.phone"
            :formatter="(value) => `${value}`.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3')"
            :parser="(value) => value.replace(/\D/g, '')" maxlength="10" clearable
            placeholder="Escribe el número de teléfono" />
            <InputError :message="$page.props?.errors['employee_properties.phone']" />
        </div>
        
        <div class="mt-3 md:mt-0">
            <InputLabel value="Fecha de nacimiento" class="ml-3 mb-1" />
            <el-date-picker v-model="form.employee_properties.birthdate" placeholder="selecciona una fecha" type="date" class="!w-full" />
            <InputError :message="$page.props?.errors['employee_properties.birthdate']" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Estado civil" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.employee_properties.civil_state" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="item in civilStates" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="$page.props?.errors['employee_properties.civil_state']" />
        </div>

        <p class="font-bold col-span-full my-2">Información laboral</p>

        <div class="mt-3 md:mt-0">
            <InputLabel value="Fecha de ingreso*" class="ml-3 mb-1" />
            <el-date-picker v-model="form.created_at" type="date" placeholder="selecciona una fecha" class="!w-full" />
            <InputError :message="$page.props?.errors.created_at" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Departamento*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.employee_properties.department" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="item in departments" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="$page.props?.errors['employee_properties.department']" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Puesto*" class="ml-3 mb-1" />
          <el-input v-model="form.employee_properties.charge" placeholder="Escribe el puesto" clearable />
          <InputError :message="$page.props?.errors['employee_properties.charge']" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Horario laboral" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.employee_properties.schedule" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="item in schedules" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="$page.props?.errors['employee_properties.schedule']" />
        </div>

        <p class="font-bold col-span-full my-2">Información laboral</p>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Nombre" class="ml-3 mb-1" />
          <el-input v-model="form.emergency_contact.name" placeholder="Escribe el nombre del contacto" clearable />
          <InputError :message="$page.props?.errors['emergency_contact.name']" />
        </div>

        <div class="mt-3 md:mt-0">
            <InputLabel value="Teléfono" class="ml-3 mb-1" />
            <el-input v-model="form.emergency_contact.phone"
            :formatter="(value) => `${value}`.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3')"
            :parser="(value) => value.replace(/\D/g, '')" maxlength="10" clearable
            placeholder="Escribe el número de teléfono" />
            <InputError :message="$page.props?.errors['emergency_contact.phone']" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Parentesco" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.emergency_contact.relationship" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="item in relationships" :key="item" :label="item" :value="item" />
          </el-select>
          <InputError :message="$page.props?.errors['emergency_contact.relationship']" />
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
      name: this.user.name,
      email: this.user.email,
      created_at: this.user.created_at,
      employee_properties: {
        phone: this.user.employee_properties?.phone,
        birthdate: this.user.employee_properties?.birthdate,
        civil_state: this.user.employee_properties?.civil_state,
        department: this.user.employee_properties?.department,
        charge: this.user.employee_properties?.charge,
        schedule: this.user.employee_properties?.schedule,
      },
      emergency_contact: {
        name: this.user.emergency_contact?.name,
        phone: this.user.emergency_contact?.phone,
        relationship: this.user.emergency_contact?.relationship,
      },
    });
    return {
      form,
      civilStates: ['Soltero/a', 'Casado/a', 'Unión libre', 'Divorciado/a', 'Viudo/a'],
      departments: ['Desarrollo web', 'Diseño web', 'Ventas'],
      schedules: ['Fijo', 'Flexible'],
      relationships: ['Madre', 'Padre', 'Hijo/a', 'Hermano/a', 'Pareja', 'Abuelo/a', 'Tío/a', 'Primo/a', 'Cuñado/a', 'Otro'],
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
    user: Object,
  },
  methods: {
    update() {
      this.form.put(route("users.update", this.user.id), {
        onSuccess: () => {
          this.$notify({
            title: "Success",
            message: "The user has been updated!",
            type: "success",
          });
        },
      });
    },
  },
};
</script>
