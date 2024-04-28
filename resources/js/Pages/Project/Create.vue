<template>
  <AppLayout title="Proyectos-crear">
    <Back class="mt-5 ml-7" />
    <div class="lg:w-[60%] w-[95%] mx-auto p-3 mt-9 lg:py-4 lg:px-5 border border-[#D9D9D9] rounded-lg">
      <h1 class="font-bold">Nuevo proyecto</h1>

      <form class="mt-4 md:grid grid-cols-2 gap-4" @submit.prevent="store">
        <div class="mt-3 md:mt-0">
          <InputLabel value="Nombre del proyecto*" class="ml-3 mb-1" />
          <el-input v-model="form.name" placeholder="Escribe el nombre del proyecto" clearable />
          <InputError :message="$page.props?.errors.name" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Responsable(s) *" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.responsible_id" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
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

        <div class="mt-3 md:mt-0">
          <InputLabel value="Cliente*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.client_id" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="client in clients" :key="client" :label="client.name" :value="client.id" />
          </el-select>
          <InputError :message="$page.props?.errors.client_id" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Cotización*" class="ml-3 mb-1" />
          <el-select @change="getTotalDaysWork" class="w-full" v-model="form.quote_id" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="quote in quotes" :key="quote" :label="quote.name + '  -  $' + quote.total_cost?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',') " :value="quote.id" />
          </el-select>
          <InputError :message="$page.props?.errors.quote_id" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Días hábiles de trabajo" class="ml-3 mb-1" />
          <el-input disabled v-model="form.total_work_days" placeholder="Días hábiles de trabajo" clearable />
          <InputError :message="$page.props?.errors.total_work_days" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Condiciones de pago*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.payment_method" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
              <el-option v-for="payment in payment_methods" :key="payment" :label="payment" :value="payment" />
          </el-select>
          <InputError :message="$page.props?.errors.payment_method" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Categoría*" class="ml-3 mb-1" />
          <el-select class="w-full" v-model="form.category" clearable
              placeholder="Seleccione" no-data-text="No hay opciones registradas"
              no-match-text="No se encontraron coincidencias">
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
          <label class="flex items-center">
              <Checkbox v-model:checked="form.invoice" />
              <span class="ml-2 text-sm text-gray-600">Requiere factura</span>
          </label>
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Horas de trabajo*" class="ml-3 mb-1" />
          <el-input
            v-model="form.hours_work"
            class=""
            placeholder="Horas de trabajo"
            clearable
            type="number"
          />
          <InputError :message="$page.props?.errors.hours_work" class="mb-1" />
        </div>

        <div class="mt-3 md:mt-0">
          <InputLabel value="Precio del proyecto*" class="ml-3 mb-1" />
          <el-input v-model="form.price" placeholder="Precio" clearable />
          <InputError :message="$page.props?.errors.price" class="mb-1" />
        </div>

        <div class="col-span-full mt-3">
          <InputLabel value="Descripción" class="text-sm ml-2 !text-gray-400" />
          <el-input v-model="form.description"
            :autosize="{ minRows: 3, maxRows: 5 }" type="textarea" placeholder="Escribe una descripción (opcional)"
            :maxlength="200" show-word-limit clearable />
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

export default {
  data() {
    const form = useForm({
      name: null,
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
      duration: null, //rango de fechas. separar y guardar en start_date y estimated_date
      payment_methods: ['Al contado', '2 pagos (50% al inicio y 50% a la entrega del proyecto)', '3 pagos ( 30% al inicio, 40 al desarrollo y 30% a la entrega)'],
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
    quotes: Array,
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
    getTotalDaysWork() {
      const quote = this.quotes.find(quote => quote.id === this.form.quote_id);
      this.form.total_work_days = quote.total_work_days;
    }
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
