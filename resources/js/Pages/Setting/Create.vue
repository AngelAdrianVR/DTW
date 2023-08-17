<template>
  <AppLayout title="Configuraciones-crear">
    <template #header>
      <div class="flex justify-between">
        <Link :href="route('projects.index')">
          <i class="fa-solid fa-chevron-left hover:bg-gray-300/50 rounded-full p-2"></i>
        </Link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Agregar una configuración
        </h2>
      </div>
    </template>


    <div class="lg:w-1/3 mx-auto mt-6 shadow-md py-4 px-5 bg-white rounded-lg">
      <form @submit.prevent="store">
        <div class="mt-4">
          <el-input v-model="form.key" placeholder="Nombre del configurable" clearable />

          <InputError :message="$page.props?.errors.key" class="mb-3" />
        </div>

        <div class="mt-4">
          <el-input v-model="form.value" placeholder="Valor del configurable" clearable />

          <InputError :message="$page.props?.errors.value" class="mb-3" />
        </div>

        <div class="mt-4">
          <el-input v-model="form.type" placeholder="Tipo del configurable" clearable />

          <InputError :message="$page.props?.errors.type" class="mb-3" />
        </div>

        <div class="mt-4">
          <el-input
            v-model="form.description"
            :rows="2"
            type="textarea"
            placeholder="Descripción del configurable"
          />

          <InputError :message="$page.props?.errors.description" class="mb-3" />
        </div>

        <PrimaryButton class="mt-4"> Crear </PrimaryButton>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

export default {
  data() {
    const form = useForm({
      key: null,
      value: null,
      type: null,
      description: null,
    });
    return {
      form,
    };
  },
  components: {
    AppLayout,
    SecondaryButton,
    Link,
    TextInput,
    PrimaryButton,
    InputError,
  },
  props: {},
  methods: {
    store() {
      this.form.post(route("settings.store"));
    },
  },
};
</script>

