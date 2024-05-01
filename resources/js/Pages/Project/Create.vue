<template>
  <AppLayout title="Proyectos-crear">
    <Back class="mt-5 ml-7" />
    <div class="lg:w-[60%] w-[95%] mx-auto p-3 mt-9 lg:py-4 lg:px-5 border border-[#D9D9D9] rounded-lg">
      <h1 class="font-bold">Nuevo proyecto</h1>

      <form class="mt-2 md:grid grid-cols-2 gap-4" @submit.prevent="store">
        <div class="col-span-full flex justify-end">
          <el-checkbox v-model="form.internal_project" name="internal_project" label="Es proyecto interno"
            size="small" />
        </div>
        <div v-if="!form.internal_project" class="mt-3 md:mt-0">
          <InputLabel value="Cliente*" class="ml-3 mb-1" />
          <el-select @change="fetchClientQuotes" class="w-full" v-model="form.client_id" clearable
            placeholder="Seleccione" no-data-text="No hay opciones registradas"
            no-match-text="No se encontraron coincidencias">
            <el-option v-for="client in clients" :key="client" :label="client.name" :value="client.id" />
          </el-select>
          <InputError :message="$page.props?.errors.client_id" />
        </div>
        <div v-if="!form.internal_project" class="mt-3 md:mt-0">
          <InputLabel value="Cotización*" class="ml-3 mb-1" />
          <el-select @change="getQuoteInfo" class="w-full" v-model="form.quote_id" clearable placeholder="Seleccione"
            no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
            <el-option v-for="quote in clientQuotes" :key="quote"
              :label="quote.name + '  -  $' + quote.total_cost?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
              :value="quote.id" />
          </el-select>
          <InputError :message="$page.props?.errors.quote_id" />
        </div>
        <div class="mt-3 md:mt-0">
          <InputLabel value="Nombre del proyecto *" class="ml-3 mb-1" />
          <el-input v-model="form.name" placeholder="Escribe el nombre del proyecto" clearable />
          <InputError :message="$page.props?.errors.name" />
        </div>
        <div class="mt-3 md:mt-0">
          <InputLabel value="Responsable *" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.responsible_id" clearable placeholder="Seleccione"
            no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
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
        <div v-if="!form.internal_project" class="mt-3 md:mt-0">
          <InputLabel value="Días hábiles de trabajo" class="ml-3 mb-1" />
          <el-input disabled v-model="form.total_work_days" placeholder="Días hábiles de trabajo" clearable />
          <InputError :message="$page.props?.errors.total_work_days" />
        </div>

        <div v-if="!form.internal_project" class="mt-3 md:mt-0">
          <InputLabel value="Condiciones de pago*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.payment_method" clearable placeholder="Seleccione"
            no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
            <el-option v-for="payment in payment_methods" :key="payment" :label="payment" :value="payment" />
          </el-select>
          <InputError :message="$page.props?.errors.payment_method" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Categoría*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.category" clearable placeholder="Seleccione"
            no-data-text="No hay opciones registradas" no-match-text="No se encontraron coincidencias">
            <el-option v-for="category in categories" :key="category" :label="category" :value="category" />
          </el-select>
          <InputError :message="$page.props?.errors.category" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Duración*" class="ml-3 mb-1" />
          <el-date-picker @change="saveDates" v-model="duration" type="daterange" range-separator="A"
            start-placeholder="Fecha de inicio" end-placeholder="Fecha esperada de fin" class="!w-full" />
          <InputError :message="$page.props?.errors.start_date" />
        </div>

        <div class="mt-3 md:mt-0">
          <div class="flex items-center space-x-2">
            <InputLabel value="Precio del proyecto" class="ml-3 mb-1" />
            <el-tooltip content="Inversión por parte de DTW en costos de operación" placement="right">
              <i class="fa-regular fa-circle-question ml-2 text-primary text-xs"></i>
            </el-tooltip>
          </div>
          <el-input v-model="form.price" placeholder="Sueldos, herramental, etc" clearable />
          <InputError :message="$page.props?.errors.price" class="mb-1" />
        </div>

        <div class="mt-3 md:mt-0">
          <div class="flex items-center space-x-2">
            <InputLabel value="Horas de trabajo*" class="ml-3 mb-1" />
            <el-tooltip content="Dias de trabajo * 3 (trabajadores) * 6 horas por día" placement="right">
              <i class="fa-regular fa-circle-question ml-2 text-primary text-xs"></i>
            </el-tooltip>
          </div>
          <el-input v-model="form.hours_work" class="" placeholder="Horas de trabajo" clearable type="number" />
          <InputError :message="$page.props?.errors.hours_work" class="mb-1" />
        </div>

        <div v-if="!form.internal_project" class="mt-3 md:mt-0">
          <el-checkbox v-model="form.invoice" name="invoice" label="Requiere factura" size="small" />
        </div>

        <div class="col-span-full mt-3">
          <InputLabel value="Descripción" class="text-sm ml-2" />
          <el-input v-model="form.description" :autosize="{ minRows: 3, maxRows: 5 }" type="textarea"
            placeholder="Escribe una descripción (opcional)" :maxlength="255" show-word-limit clearable />
        </div>

        <div class="ml-2 mt-3 md:mt-0 col-span-full">
          <FileUploader @files-selected="this.form.media = $event" />
        </div>

        <div class="col-span-full text-right mt-5">
          <PrimaryButton class="px-12"> Crear proyecto</PrimaryButton>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Checkbox from '@/Components/Checkbox.vue';
import InputLabel from "@/Components/InputLabel.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import FileUploader from "@/Components/MyComponents/FileUploader.vue";
import Back from "@/Components/MyComponents/Back.vue";
import { useForm } from "@inertiajs/vue3";
import axios from 'axios';

export default {
  data() {
    const form = useForm({
      name: null,
      internal_project: false, //indica si es proyecto interno
      responsible_id: null, //nuevo agregado
      client_id: null, //nuevo agregado
      quote_id: null, //nuevo agregado
      payment_method: null, //nuevo agregado
      estimated_date: null, //nuevo agregado
      category: null, //nuevo agregado
      invoice: false, //nuevo agregado
      total_work_days: null, //nuevo agregado
      media: null, //nuevo agregado
      key: null,
      description: null,
      hours_work: null,
      price: null,
      start_date: null,
      finish_date: null,
    });
    return {
      form,
      clientQuotes: [], //cotizaciones del cliente seleccionado
      duration: null, //rango de fechas. separar y guardar en start_date y estimated_date
      categories: ['Página web', 'Tienda en linea', 'Punto de venta', 'ERP (Planificación de recursos empresariales)',
        'CRM (Gestión de relaciones con los clientes)', 'PMS (Planificación de recursos empresariales)', 'CMS (Gestión de contenido)',
        'LMS (Sistema de gestión del aprendizaje)', 'BI (Inteligencia de negocios)', 'Otro'],
    };
  },
  components: {
    SecondaryButton,
    PrimaryButton,
    FileUploader,
    InputError,
    InputLabel,
    AppLayout,
    Checkbox,
    Back
  },
  props: {
    users: Array,
    clients: Array
  },
  methods: {
    store() {
      this.form.post(route("projects.store"), {
        onSuccess: () => {
          this.$notify({
            title: "Success",
            message: "The project has been registered",
            type: "success",
          });
        },
      });
    },
    saveDates() {
      this.form.start_date = this.duration[0];
      this.form.estimated_date = this.duration[1];
    },
    async fetchClientQuotes() {
      try {
        const response = await axios.get(route('clients.fetch-quotes', this.form.client_id));
        if (response.status === 200) {
          this.clientQuotes = response.data.quotes;
        }
      } catch (error) {
        console.log(error);
      }
    },
    getQuoteInfo() {
      const quote = this.clientQuotes.find(quote => quote.id === this.form.quote_id);
      const client = this.clients.find(item => item.id === this.form.client_id);
      this.form.total_work_days = quote.total_work_days;
      this.form.payment_method = quote.payment_type;
      this.form.hours_work = quote.total_work_days * 3 * 6;
      this.form.name = client.name + ' - ' + quote.name;
      this.form.description = quote.description;
    }
  },
};
</script>