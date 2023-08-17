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
    <div class="lg:w-11/12 lg:grid mx-auto grid-cols-2 gap-5 mt-6">
      <form @submit.prevent="store" class="shadow-md py-4 mb-6 px-5 bg-white rounded-lg">
        <div class="mt-3">
          <el-input v-model="form.customer_name" type="text" placeholder="Nombre de cliente">
            <template #prefix>
              <el-tooltip content="Nombre del cliente" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-user"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.customer_name" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.company" type="text" placeholder="Empresa">
            <template #prefix>
              <el-tooltip content="Nombre de la empresa" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-building"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.company" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.email" type="email" placeholder="Correo electronico">
            <template #prefix>
              <el-tooltip content="Correo electronico" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-envelope"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.email" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.advance_payment_percentage" type="number" placeholder="Porcentaje de anticipo">
            <template #prefix>
              <el-tooltip content="Porcentaje de anticipo" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-percent"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.advance_payment_percentage" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.total_hours" type="number" placeholder="Horas totales">
            <template #prefix>
              <el-tooltip content="Duracion de proyecto en horas" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-business-time"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.total_hours" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.offer_validity_days" type="number" placeholder="Dias de validez de cotizacion">
            <template #prefix>
              <el-tooltip content="Dias de validez de cotizacion despues de emision" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-stopwatch"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.offer_validity_days" />
        </div>
        <div>
          <div class="demo-date-picker">
            <div class="block">
              <el-date-picker v-model="form.promised_end_date" type="date" placeholder="Entrega tentativa"
                :default-value="new Date()" value-format="YYYY-MM-DD" />
            </div>
          </div>

          <InputError :message="form.errors.promised_end_date" />
        </div>
        <div class="flex justify-end">
          <PrimaryButton :disabled="form.processing"> Crear </PrimaryButton>
        </div>
      </form>
      <div class="flex justify-center items-center text-gray-400 text-sm shadow-md py-4 mb-6 px-5 bg-white rounded-lg">
        Vista previa
      </div>
    </div>
  </AppLayout>
</template>

<script>

import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";

export default {
  data() {
    const form = useForm({
      customer_name: null,
      company: null,
      email: null,
      included_features: null,
      suggested_features: null,
      discounts: null,
      advance_payment_percentage: 50,
      total_hours: null,
      promised_end_date: null,
      offer_validity_days: 30,
    });
    return {
      form,
      toast: null,
    };
  },
  components: {
    AppLayout,
    SecondaryButton,
    Link,
    PrimaryButton,
    InputError,
  },
  props: {
    projects: Array,
  },
  methods: {
    store() {
      this.form.post(route("quotes.store"), {
        onSuccess: () => this.toast.success("Cotizacion creada"),
      });
    },
  },
  mounted() {
    this.toast = useToast();
  }
};
</script>

<style scoped>
.demo-date-picker {
  width: 100%;
  padding: 0;
  flex-wrap: wrap;
}

.demo-date-picker .block {
  padding-top: 0.75rem;
  border-right: solid 1px var(--el-border-color);
  /* flex: 1; */
}

.demo-date-picker .block:last-child {
  border-right: none;
}

.demo-date-picker .demonstration {
  display: block;
  color: var(--el-text-color-secondary);
  font-size: 14px;
  margin-top: 0.75rem;
}
</style>
