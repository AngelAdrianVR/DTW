<template>
  <AppLayout title="Proyectos-crear">
    <template #header>
      <div class="flex justify-between">
        <Link :href="route('projects.index')">
          <i class="fa-solid fa-chevron-left hover:bg-gray-300/50 rounded-full p-2"></i>
        </Link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Crear un Proyecto
        </h2>
      </div>
    </template>
    <div class="lg:w-1/3 mx-auto mt-6 shadow-md py-4 px-5 bg-white rounded-lg">
      <form @submit.prevent="store">
        <div class="mt-4">
          <el-input v-model="form.name" placeholder="Nombre del proyecto" clearable />

         <InputError :message="$page.props?.errors.name" class="mb-3" />
        </div>

        <div class="mt-4">
        <el-input v-model="form.client_info.name" class="w-50 m-2" placeholder="Nombre del cliente" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-user"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['client_info.name']" class="mb-3" />
        </div>

        <div class="mt-4">
        <el-input v-model="form.client_info.email" class="w-50 m-2" placeholder="Correo" clearable type="email">
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-envelope"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['client_info.email']" class="mb-3" /> 
        </div>

        <div class="mt-4">
        <el-input v-model="form.client_info.company" class="w-50 m-2" placeholder="Empresa" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-building"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['client_info.company']" class="mb-3" /> 
        </div>

        <div class="mt-4">
        <el-input v-model="form.client_info.phone" class="w-50 m-2" placeholder="Teléfono de contacto" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-phone"></i></el-icon>
            </template>
          </el-input>

        <InputError :message="$page.props?.errors['client_info.phone']" class="mb-3" /> 
       </div>

        <div class="mt-4">
        <el-input v-model="form.hours_work" class="w-50 m-2" placeholder="Horas de trabajo" clearable type="number">
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-clock"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors.hours_work" class="mb-1" />
        </div>

        <div class="mt-4">
          <el-input v-model="form.cuote" class="w-50 m-2" placeholder="Cotización" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-dollar-sign"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors.cuote" class="mb-1" />
        </div>

        <div>
          <div class="demo-date-picker">
            <div class="block">
              <span class="demonstration">Fecha de entrega</span>
              <el-date-picker
                v-model="form.promisse_finish_date"
                type="date"
                placeholder="Selecciona una fecha"
                :default-value="new Date()"
                value-format="YYYY-MM-DD"
              />
            </div>
          </div>

          <InputError :message="$page.props?.errors.promisse_finish_date" class="mb-3" />
        </div>

        <PrimaryButton> Crear </PrimaryButton>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

export default {
  data() {
    const form = useForm({
      name: null,
      client_info: {
        name: null,
        email: null,
        company: null,
        phone: null,
      },
      hours_work: null,
      cuote: null,
      promisse_finish_date: null,
    });
    return {
      form,
    };
  },
  components: {
    ApplicationLogo,
    AppLayout,
    SecondaryButton,
    Link,
    TextInput,
    PrimaryButton,
    InputError
  },
  props: {
  },
  methods: {
    store() {
      this.form.post(route("projects.store"));
    },
  },
};
</script>

<style scoped>
.demo-date-picker {
  display: flex;
  width: 100%;
  padding: 0;
  flex-wrap: wrap;
}
.demo-date-picker .block {
  padding: 30px 0;
  text-align: center;
  border-right: solid 1px var(--el-border-color);
  flex: 1;
}
.demo-date-picker .block:last-child {
  border-right: none;
}
.demo-date-picker .demonstration {
  display: block;
  color: var(--el-text-color-secondary);
  font-size: 14px;
  margin-bottom: 20px;
}
</style>
