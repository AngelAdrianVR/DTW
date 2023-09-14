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
          <el-input v-model="form.company_address" type="text" placeholder="Dirección de la empresa">
            <template #prefix>
              <el-tooltip content="Dirección de la empresa" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-map-location-dot"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.company_address" />
        </div>
        <div class="mt-3">
          <div class="flex space-x-2">
          <el-input class="w-3/4" v-model="new_feature" type="text" placeholder="Características incluidas">
            <template #prefix>
              <el-tooltip content="Caracterísicas incluidas en la lcotización" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-regular fa-clipboard"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <SecondaryButton :type="'button'" @click="addFeature">Agregar</SecondaryButton>
          </div>
        <el-select class="mt-2 w-full" v-model="form.included_features" multiple clearable placeholder="Caracteristicas"
            no-data-text="Agrega primero una caracteristica">
            <el-option v-for="feature in form.included_features" :key="feature" :label="feature"
                :value="feature"></el-option>
        </el-select>
          <InputError :message="form.errors.included_features" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.total_work_days" type="number" placeholder="Días habiles de trabajo">
            <template #prefix>
              <el-tooltip content="Días habiles de trabajo" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-business-time"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.total_work_days" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.total_cost" type="number" placeholder="Costo total del proyecto">
            <template #prefix>
              <el-tooltip content="Costo total del proyecto" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-dollar"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.total_cost" />
        </div>
        <div class="mt-3">
          <el-input v-model="form.percentage_discount" type="number" max="100" min="1" placeholder="Porcentaje de descuento">
            <template #prefix>
              <el-tooltip content="Porcentaje de descuento" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-percent"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.percentage_discount" />
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
          <div class="flex space-x-2">
          <el-input class="w-2/3" v-model="form.offer_validity_days" type="number" placeholder="Dias de validez de cotizacion">
            <template #prefix>
              <el-tooltip content="Dias de validez de cotizacion despues de emision" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-stopwatch"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <SecondaryButton class="w-1/3" :type="'button'" @click="setExpiredDate">Calcular fecha</SecondaryButton>
          </div>
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
      <div class="text-sm shadow-md py-2 mb-6 px-3 bg-white rounded-lg relative">
    <p class="absolute top-0 right-2 text-gray-400 text-sm">Vista previa</p>
    <figure>
      <img src="@/../../public/assets/images/quote-logo.png" alt="">
    </figure>
    <p class="font-bold text-sm text-center">Cotización</p>
    <p class="text-xs text-right">Fecha de emisión: <span id="fecha-emision">{{ formatearFecha(fechaEmision) }}</span></p>
    <p class="text-xs text-right">Vigencia de la cotización: <span id="fecha-vigencia">{{ formatearFecha(fechaVigencia) }}</span></p>
    <div class="px-4 mt-2">
      <p v-if="form.company" class="text-xs text-left">{{ form.company }}</p>
      <p v-if="form.company_address" class="text-xs text-left">{{ form.company_address }}</p>
      <p v-if="form.included_features?.length" class="text-sm font-bold text-left mt-2">Servicios</p>
      <ul class="ml-4 mt-2" v-if="form.included_features?.length">
        <li class="text-xs" v-for="(feature, index) in form.included_features" :key="feature"><span class="mr-3">{{ (index + 1) + '. ' }}</span>{{feature }}</li>
      </ul>
      <p v-if="form.total_work_days" class="text-sm font-bold text-left mt-2">Duración</p>
      <p class="text-xs" v-if="form.total_work_days">La entrega estimada para la implementación final del proyecto es {{ form.total_work_days }} días hábiles, iniciando a partir del primer pago al
        inicio del proyecto.
      </p>
      <p v-if="form.total_cost" class="text-sm font-bold text-left mt-2">Costo</p>
      <p class="text-xs" v-if="form.total_cost">${{ form.total_cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido</p>
      <p v-if="form.percentage_discount" class="text-xs">Descuento: ${{ ((form.percentage_discount * 0.01) * form.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} (%{{ form.percentage_discount }})</p>
      <p v-if="form.percentage_discount" class="text-sm font-bold text-left mt-2">Total</p>
      <p class="text-xs" v-if="form.percentage_discount">${{ (form.total_cost - (form.percentage_discount * 0.01) * form.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido</p>
      <p class="text-sm font-bold text-left mt-2">Condiciones de pago</p>
      <p class="text-xs">30% al inicio del proyecto. </p>
      <p class="text-xs">40% al finalizar el desarrollo. </p>
      <p class="text-xs">30% al finalizar la implementación. </p>
      <p class="text-xs mt-3">Esta cotización no incluye costos adicionales que puedan surgir debido a cambios significativos en el alcance del proyecto. </p>
    </div>
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
      company_address: null,
      included_features: [],
      suggested_features: [],
      promised_end_date: null,
      total_work_days: null,
      total_cost: null,
      percentage_discount: null,
      email: null,
      advance_payment_percentage: 50,
      total_hours: null,
      offer_validity_days: 30,
    });
    return {
      form,
      fechaEmision: null, // Inicializamos fechaEmision como una cadena vacía
      fechaVigencia: null, // Inicializamos fechaVigencia como una cadena vacía
      new_feature: null,
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
     formatearFecha(fecha) {
      if (!fecha) return ''; // Manejar el caso en que la fecha sea null o undefined

      const options = { day: 'numeric', month: 'long', year: 'numeric' };
      return fecha.toLocaleDateString('es-ES', options);
    },
    addFeature(){
      if (this.new_feature.trim() !== '') {
                this.form.included_features.push(this.new_feature);
                this.included_features.push(this.new_feature);
                this.new_feature = '';
            }
    },
    setExpiredDate() {
      if (this.form.offer_validity_days) {
        const fechaActual = new Date();
        const fechaVigencia = new Date(fechaActual);
        fechaVigencia.setDate(fechaActual.getDate() + this.form.offer_validity_days);
        this.fechaVigencia = fechaVigencia;
      } else {
        this.fechaVigencia = null;
      }
    },
  },
  mounted() {
    this.toast = useToast();

    const fechaEmisionSpan = document.getElementById('fecha-emision');
    const fechaVigenciaSpan = document.getElementById('fecha-vigencia');

    // Crea un objeto de fecha para obtener la fecha actual
    const fechaActual = new Date();

    // Calcula la fecha de vigencia
    const fechaVigencia = new Date();
    fechaVigencia.setDate(fechaVigencia.getDate() + this.form.offer_validity_days);

    // Actualiza las propiedades de fecha
    this.fechaEmision = fechaActual;
    this.fechaVigencia = fechaVigencia
  },
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
