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
    <div class="lg:w-3/6 mx-auto mt-6 shadow-md py-4 px-3 bg-white rounded-lg">
      <form @submit.prevent="store">
        <div class="mt-4">
          <TextInput
            v-model="form.name"
            type="text"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Nombre del proyecto"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.client_info.name"
            type="text"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Nombre del cliente"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.client_info.email"
            type="text"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Email del cliente"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.client_info.company"
            type="text"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Compañía"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.client_info.phone"
            type="text"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Teléfono"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.hours_work"
            type="number"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Horas de trabajo"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <TextInput
            v-model="form.cuote"
            type="number"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
            placeholder="Cotización"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>
        <div class="mt-4">
          <label class="text-gray-600 md:ml-48">Fecha de entrega</label>
          <TextInput
            v-model="form.promisse_finish_date"
            type="date"
            class="mt-1 block w-3/4 md:w-1/2 md:mx-auto"
          />
          <!-- <InputError :message="form.error" class="mt-2" /> -->
        </div>

        <PrimaryButton class="mt-4 md:ml-48"> Crear </PrimaryButton>
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
    PrimaryButton
  },
  props: {
    projects: Array,
  },
  methods:{
    store(){
        this.form.post(route('projects.store'));
    }
  },
};
</script>
