<template>
  <AppLayout title="Crear prospecto">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <Back />
      </header>
      <main class="border border-grayD9 rounded-[10px] px-5 py-4 mx-2 md:mx-24 mt-10">
        <h1 class="font-bold">Crear prospecto</h1>
        <form @submit.prevent="store" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-x-3 gap-y-2">
          <div>
            <InputLabel class="mb-1 ml-2" value="Nombre de la empresa *" />
            <el-input v-model="form.name" placeholder="Escribe el nombre de la empresa" clearable />
            <InputError :message="form.errors.name" />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Dirección" />
            <el-input v-model="form.address" placeholder="Escribe la dirección" clearable />
            <InputError :message="form.errors.address" />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Estado *" />
            <el-select v-model="form.state" filterable placeholder="Selecciona el estado de la república" class="w-full"
              no-data-text="No hay opciones para mostrar" no-match-text="No se encontraron coincidencias">
              <el-option v-for="(item, index) in states" :key="index" :label="item" :value="item" />
            </el-select>
            <InputError :message="form.errors.state" />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Nombre del contacto *" />
            <el-input v-model="form.contact.name" placeholder="Escribe el nombre del contacto " clearable />
            <InputError :message="form.errors['contact.name']" />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Correo electrónico" />
            <el-input v-model="form.contact.email" placeholder="Escribe el correo electrónico" clearable />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Teléfono *" />
            <el-input v-model="form.contact.phone"
              :formatter="(value) => `${value}`.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3')"
              :parser="(value) => value.replace(/\D/g, '')" maxlength="10" clearable
              placeholder="Escribe el número de teléfono" />
            <InputError :message="form.errors['contact.phone']" />
          </div>
          <div class="self-end">
            <InputLabel class="mb-1 ml-2">
              <status class="mr-1">Estatus *</status>
              <el-tooltip :content="statuses.find(item => item.label == form.status).tooltip" placement="top">
                <i class="fa-solid fa-circle text-[10px] mt-1"
                  :style="{ color: statuses.find(item => item.label == form.status).color }"></i>
              </el-tooltip>
            </InputLabel>
            <el-select v-model="form.status" placeholder="Selecciona el estatus" class="w-full"
              no-data-text="No hay opciones para mostrar" no-match-text="No se encontraron coincidencias">
              <el-option v-for="(item, index) in statuses" :key="index" :label="item.label" :value="item.label">
                <p class="flex items-center space-x-2">
                  <i class="fa-solid fa-circle text-[10px] mt-1" :style="{ color: item.color }"></i>
                  <span class="text-sm">{{ item.label }}</span>
                </p>
              </el-option>
            </el-select>
            <InputError :message="form.errors.status" />
          </div>
          <div>
            <InputLabel class="mb-1 ml-2" value="Responsable *" />
            <el-select v-model="form.responsible_id" placeholder="Selecciona el responsable de dar seguimiento">
              <el-option v-for="item in sellers" :key="item.id" :label="item.name" :value="item.id">
                <figure style="float: left">
                  <img class="object-cover size-7 rounded-full mt-1" :src="item.profile_photo_url" />
                </figure>
                <span class="ml-2">{{ item.name }}</span>
              </el-option>
            </el-select>
            <InputError :message="form.errors.responsible_id" />
          </div>
          <div class="md:col-span-full">
            <InputLabel class="mb-1 ml-2" value="Notas" />
            <el-input v-model="form.abstract" maxlength="500" :autosize="{ minRows: 3, maxRows: 5 }" show-word-limit
              type="textarea" placeholder="Escribe las notas" />
          </div>
          <div class="md:col-span-full flex justify-end mt-3">
            <PrimaryButton :isLoading="form.processing" :disabled="form.processing">Crear prospecto</PrimaryButton>
          </div>
        </form>
      </main>
    </div>
  </AppLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Back from "@/Components/MyComponents/Back.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
  data() {
    const form = useForm({
      name: null,
      responsible_id: null,
      address: null,
      state: 'Jalisco',
      status: 'Contacto inicial',
      abstract: null,
      contact: {
        name: null,
        phone: null,
        email: null,
      }
    });

    return {
      form,
      states: [
        'Aguascalientes',
        'Baja California',
        'Baja California Sur',
        'Campeche',
        'Chiapas',
        'Chihuahua',
        'Ciudad de México',
        'Coahuila',
        'Colima',
        'Durango',
        'Estado de México',
        'Guanajuato',
        'Guerrero',
        'Hidalgo',
        'Jalisco',
        'Michoacán',
        'Morelos',
        'Nayarit',
        'Nuevo León',
        'Oaxaca',
        'Puebla',
        'Querétaro',
        'Quintana Roo',
        'San Luis Potosí',
        'Sinaloa',
        'Sonora',
        'Tabasco',
        'Tamaulipas',
        'Tlaxcala',
        'Veracruz',
        'Yucatán',
        'Zacatecas',
      ],
      statuses: [
        {
          label: "Contacto inicial",
          bg: "#F1F996",
          color: "#B1B402",
          tooltip: "El prospecto entra en contacto con la empresa por primera vez",
        },
        {
          label: "En proceso de conversión",
          bg: "#BCF996",
          color: "#37A305",
          tooltip: "El responsable esta trabajando para convertir el prospecto en nuevo cliente",
        },
        {
          label: "Perdido",
          bg: "#F7B7FC",
          color: "#9E0FA9",
          tooltip: "El prospecto no se convierte en cliente ",
        },
      ],
    };
  },
  components: {
    AppLayout,
    PrimaryButton,
    InputLabel,
    InputError,
    Back,
  },
  props: {
    sellers: Array,
  },
  methods: {
    store() {
      this.form.post(route('prospects.store'), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "Se ha creado un prospecto nuevo",
            type: "success",
          })
        }
      });
    },
  }
};
</script>