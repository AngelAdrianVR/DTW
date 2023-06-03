<template>
  <AppLayout title="Cotizacion-crear">
    <template #header>
      <div class="flex justify-between">
        <Link :href="route('quotes.index')"
          class="hover:bg-gray-300/50 rounded-full w-10 h-10 flex justify-center items-center">
        <i class="fa-solid fa-chevron-left"></i>
        </Link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Crear cotizacion
        </h2>
      </div>
    </template>
    <div class="lg:w-1/3 mx-auto mt-6 shadow-md py-4 px-5 bg-white rounded-lg">
      <form @submit.prevent="store">
        <div class="mt-4">
          <el-input v-model="form.response" autosize type="textarea" placeholder="Respuesta" />
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
    PrimaryButton,
  },
  props: {
    projects: Array,
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
