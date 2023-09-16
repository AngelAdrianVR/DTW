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
          <el-input v-model="form.quote_name" type="text" placeholder="Nombre de la cotización">
            <template #prefix>
              <el-tooltip content="Nombre de la cotización" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-regular fa-file"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.quote_name" />
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
          <el-input v-model="form.quote_description" type="text" placeholder="Descripción de la cotización">
            <template #prefix>
              <el-tooltip content="Descripción de la cotización" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-quote-left"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <InputError :message="form.errors.quote_description" />
        </div>
        <el-select @change="generateFolio" class="mt-2 w-full" v-model="form.project" clearable placeholder="Tipo de proyecto">
            <el-option v-for="project in project_types" :key="project.value" :label="project.label"
                :value="project.key"></el-option>
        </el-select>
        <div class="mt-3">
          <div class="flex space-x-2">
          <el-input class="w-3/4" v-model="new_subtitle" type="text" placeholder="Subtítulo de proyecto">
            <template #prefix>
              <el-tooltip content="Subtítulo de proyecto" placement="top" effect="dark">
                <el-icon class="el-input__icon"><i class="fa-solid fa-heading"></i></el-icon>
              </el-tooltip>
            </template>
          </el-input>
          <SecondaryButton :type="'button'" @click="addSubtitle">Agregar</SecondaryButton>
          </div>
        <el-select class="mt-2 w-full" v-model="form.subtitles" multiple clearable placeholder="Subtítulos"
            no-data-text="Agrega primero un subtitulo">
            <el-option v-for="subtitle in form.subtitles" :key="subtitle" :label="subtitle"
                :value="subtitle"></el-option>
        </el-select>
          <InputError :message="form.errors.subtitles" />
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
          <PrimaryButton @click="store" :disabled="form.processing"> Crear </PrimaryButton>
        </div>
      </form>

      <!-- ------------- quote preview --------------- -->
      <div class="text-sm shadow-md py-2 mb-6 px-3 bg-white rounded-lg relative">
    <p class="absolute top-0 right-2 text-gray-400 text-sm">Vista previa</p>
    <div class="flex justify-between">
      <figure>
        <img src="@/../../public/assets/images/quote-logo.png" alt="">
      </figure>
      <p class="text-xs mt-4">{{ folio }}</p>
    </div>
    <p class="font-bold text-sm text-center">Cotización. {{ form.quote_name }}</p>
    <p class="text-xs text-right">Fecha de emisión: <span id="fecha-emision">{{ formatearFecha(fechaEmision) }}</span></p>
    <p class="text-xs text-right">Vigencia de la cotización: <span id="fecha-vigencia">{{ formatearFecha(fechaVigencia) }}</span></p>
    <div class="px-4 mt-2">
      <p v-if="form.company" class="text-xs text-left">{{ form.company }}</p>
      <p v-if="form.company_address" class="text-xs text-left">{{ form.company_address }}</p>
      <p v-if="form.quote_description" class="text-xs text-left"><strong>Descripción: </strong>{{ form.quote_description }}</p>
      <p v-if="form.included_features?.length" class="text-sm font-bold text-left mt-2">Servicios</p>
      <!-- <p v-if="form.subtitles?.length" class="text-sm font-bold text-[#7F659C] text-left mt-2">{{form.subtitles}}</p> -->
      <ul class="ml-4 mt-2" v-if="form.included_features?.length || form.subtitles?.length">
  <template v-if="form.subtitles?.length">
    <li class="text-sm font-bold text-[#7F659C] text-left mt-2" v-for="(subtitle, subtitleIndex) in form.subtitles" :key="'subtitle-' + subtitleIndex">{{ subtitle }}</li>
    <li class="text-xs ml-4" v-for="(feature, featureIndex) in form.included_features" :key="'feature-' + featureIndex">{{ (featureIndex + 1) + '. ' }}{{ feature }}</li>
  </template>
  <template v-else>
    <li class="text-xs" v-for="(feature, index) in form.included_features" :key="'feature-' + index"><span class="mr-3">{{ (index + 1) + '. ' }}</span>{{ feature }}</li>
  </template>
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
      quote_name: null,
      customer_name: null,
      company: null,
      company_address: null,
      quote_description: null,
      project: null,
      subtitles: [],
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
      fechaEmision: null, 
      fechaVigencia: null,
      new_feature: null,
      new_subtitle: null,
      project_type: null,
      folio: null,
      toast: null,
      project_types: [
        {
          label: 'Tienda online',
          Key: 'ECO'
        },
        {
          label: 'Página web',
          Key: 'WST'
        },
        {
          label: 'Gestión de Relación con los Clientes (CRM)',
          Key: 'CRM'
        },
        {
          label: 'Planificación de Recursos Empresariales (ERP)',
          Key: 'ERP'
        },
        {
          label: 'Gestión de Contenido (CMS)',
          Key: 'CMS'
        },
        {
          label: 'Sistema de Gestión del Aprendizaje (LMS)',
          Key: 'LMS'
        },
        {
          label: 'Sistema de Gestión de Proyectos (PMS)',
          Key: 'PMS'
        },
        {
          label: 'Inteligencia de Negocios (BI)',
          Key: 'BI'
        },
        {
          label: 'Sistemas de Recursos Humanos (HRM)',
          Key: 'HRM'
        },
        {
          label: 'Sistemas de Gestión de Inventarios (IMS)',
          Key: 'IMS'
        },
      ],
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
    quotes: Array,
  },

  methods: {
    store() {
      this.form.post(route("quotes.store"), {
        onSuccess: () => this.toast.success("Cotizacion creada"),
      });
      // this.generatePDF();
        
    },
    generatePDF() {
    // Reemplaza {id} con el ID de la cotización que deseas generar como PDF
    const cotizacionId = 1; // Cambia esto según tu caso
    window.open(`/generar-pdf/${cotizacionId}`, '_blank');
},
    generateFolio() {
      // Obtener las primeras 3 letras del nombre de la empresa en mayúsculas
    const companyPrefix = this.form.company.substr(0, 3).toUpperCase();

    const projectTypePrefix = this.form.project_type;

     // Formatear el número consecutivo con ceros a la izquierda para que tenga 4 dígitos
    const consecutiveNumberFormatted = this.quotes?.length.toString().padStart(4, "0");

      // Combinar los elementos en el formato deseado
    this.folio = `C-${companyPrefix}-${projectTypePrefix}-${consecutiveNumberFormatted}`;
  console.log(this.folio);
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
    addSubtitle(){
      if (this.new_subtitle.trim() !== '') {
                this.form.subtitles.push(this.new_subtitle);
                this.subtitles.push(this.new_subtitle);
                this.new_subtitle = '';
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
