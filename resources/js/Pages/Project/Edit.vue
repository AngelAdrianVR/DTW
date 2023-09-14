<template>
  <AppLayout title="Proyectos-editar">
    <template #header>
      <div class="flex justify-between">
        <Link :href="route('projects.index')" class="hover:bg-gray-300/50 rounded-full w-10 h-10 flex justify-center items-center">
          <i class="fa-solid fa-chevron-left"></i>
        </Link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Editar {{ project.name }}
        </h2>
      </div>
    </template>
    <div class="lg:w-1/2 p-3 mx-auto mt-6 shadow-md lg:py-4 lg:px-5 bg-white rounded-lg">
      <form @submit.prevent="update">
        <div class="">
          <el-input v-model="form.name" placeholder="Nombre del proyecto" clearable />

         <InputError :message="$page.props?.errors.name" />
        </div>

        <div class="mt-3">
          <el-input v-model="form.key" placeholder="Clave del proyecto" clearable />

         <InputError :message="$page.props?.errors.key" />
        </div>

        <el-divider>Datos de cliente</el-divider>

        <div class="">
        <el-input v-model="form.customer_info.name" class="w-50 p-2" placeholder="Nombre del cliente" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-user"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['customer_info.name']" />
        </div>

        <div class="">
        <el-input v-model="form.customer_info.email" class="w-50 p-2" placeholder="Correo" clearable type="email">
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-envelope"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['customer_info.email']" /> 
        </div>

        <div class="">
        <el-input v-model="form.customer_info.company" class="w-50 p-2" placeholder="Empresa" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-building"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors['customer_info.company']" /> 
        </div>

        <div class="">
        <el-input v-model="form.customer_info.phone" class="w-50 p-2" placeholder="Teléfono de contacto" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-phone"></i></el-icon>
            </template>
          </el-input>

        <InputError :message="$page.props?.errors['customer_info.phone']" /> 
       </div>

        <div class="">
        <el-input v-model="form.hours_work" class="w-50 p-2" placeholder="Horas de trabajo" clearable type="number">
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-clock"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors.hours_work" class="mb-1" />
        </div>

        <div class="">
          <el-input v-model="form.price" class="w-50 p-2" placeholder="Precio" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-dollar-sign"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors.price" class="mb-1" />
        </div>

        <div class="">
          <el-input v-model="form.description" class="w-50 p-2" placeholder="Descripción del proyecto" clearable>
          </el-input>

          <InputError :message="$page.props?.errors.description" class="mb-1" />
        </div>

<div class="lg:flex justify-center space-x-3">
        <div>
          <div class="demo-date-picker">
            <div class="block">
              <span class="demonstration">Fecha de inicio</span>
              <el-date-picker
                v-model="form.start_date"
                type="date"
                placeholder="Selecciona una fecha"
                :default-value="new Date()"
                value-format="YYYY-MM-DD"
              />
            </div>
          </div>

          <InputError :message="$page.props?.errors.start_date" />
        </div>
        <div>
          <div class="demo-date-picker">
            <div class="block">
              <span class="demonstration">Fecha de entrega</span>
              <el-date-picker
                v-model="form.finish_date"
                type="date"
                placeholder="Selecciona una fecha"
                :default-value="new Date()"
                value-format="YYYY-MM-DD"
              />
            </div>
          </div>
</div>

          <InputError :message="$page.props?.errors.finish_date" />
        </div>

        <PrimaryButton> Actualizar </PrimaryButton>
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
      name: this.project.name,
      key: this.project.key,
      description: this.project.description,
      customer_info: {
        name: this.project.customer_info.name,
        email: this.project.customer_info.email,
        company: this.project.customer_info.company,
        phone: this.project.customer_info.phone,
      },
      hours_work: this.project.hours_work,
      price: this.project.price,
      start_date: this.project.start_date,
      finish_date: this.project.finish_date,
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
    project: Object
  },
  methods: {
    update() {
            this.form.put(route("projects.update", this.project), {
                onSuccess: () => {
                    this.$notify({
                        title: 'Success',
                        message: "The project has been edited",
                        type: 'success'
                    });
                }
            });
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
