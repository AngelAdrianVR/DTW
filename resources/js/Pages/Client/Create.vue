<template>
  <AppLayout title="Crear cliente">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <Back />
      </header>
      <main class="border border-grayD9 rounded-[10px] px-5 py-4 mx-2 md:mx-24 mt-10">
        <h1 class="font-bold">Crear cliente</h1>
        <form @submit.prevent="store" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-x-3 gap-y-2">
          <div>
            <InputLabel value="Nombre de la empresa *" />
            <el-input v-model="form.name" placeholder="Escribe el nombre de la empresa" clearable />
            <InputError :message="form.errors.name" />
          </div>
          <div>
            <InputLabel value="RFC" />
            <el-input v-model="form.rfc" placeholder="Escribe el RFC en caso de tenerlo" clearable />
          </div>
          <div>
            <InputLabel value="Domicilio" />
            <el-input v-model="form.address" placeholder="Agregar el domicilio en caso de tenerlo" clearable />
          </div>
          <div>
            <InputLabel value="Estado" />
            <el-select v-model="form.state" placeholder="Selecciona el estado de la republica">
              <el-option v-for="item in states" :key="item" :label="item" :value="item" />
            </el-select>
            <InputError :message="form.errors.state" />
          </div>
          <div>
            <InputLabel value="Responsable *" />
            <el-select v-model="form.responsible_id" placeholder="Selecciona el responsable de dar seguimiento">
              <el-option v-for="item in users" :key="item.id" :label="item.name" :value="item.id">
                <figure style="float: left">
                  <img class="object-cover size-7 rounded-full mt-1" :src="item.profile_photo_url" />
                </figure>
                <span class="ml-2">{{ item.name }}</span>
              </el-option>
            </el-select>
            <InputError :message="form.errors.responsible_id" />
          </div>
          <div>
            <InputLabel value="Nombre del contacto *" />
            <el-input v-model="form.contacts[0].name" placeholder="Escribe el nombre del contacto" clearable />
            <InputError :message="form.errors.contact_name" />
            <InputError :message="form.errors['contacts.0.name']" />
          </div>
          <div>
            <InputLabel value="Correo electrónico" />
            <el-input v-model="form.contacts[0].email" placeholder="Escribe el correo electronico" clearable />
          </div>
          <div>
            <InputLabel value="Teléfono *" />
            <el-input v-model="form.contacts[0].phone"
            :formatter="(value) => `${value}`.replace(/(\d{2})(\d{4})(\d{4})/, '$1 $2 $3')"
            :parser="(value) => value.replace(/\D/g, '')" maxlength="10" clearable
            placeholder="Escribe el número de teléfono" />
            <InputError :message="form.errors['contacts.0.phone']" />
          </div>
          <div class="md:col-span-full">
            <InputLabel value="Notas" />
            <el-input v-model="form.notes" maxlength="500" :autosize="{ minRows: 3, maxRows: 5 }" show-word-limit
              type="textarea" placeholder="Escribe las notas" />
          </div>
          <div class="md:col-span-full flex justify-end mt-3">
            <PrimaryButton :isLoading="form.processing" :disabled="form.processing">Crear cliente</PrimaryButton>
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
      rfc: null,
      address: null,
      state: 'Jalisco',
      responsible_id: null,
      notes: null,
      contacts: [
        { //eliminar este objeto cuando se agreguen mas contactos
          name: null,
          email: null,
          phone: null,
        }
      ],
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
      // descomentar cuando se agreguen más contactos
      // contact: {
      //   name: null,
      //   email: null,
      //   phone: null,
      // }
    };
  },
  components: {
    AppLayout,
    PrimaryButton,
    InputLabel,
    Back,
  },
  props: {
    users: Array,
  },
  methods: {
    store() {
      this.form.post(route('clients.store'), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "Se ha creado un cliente nuevo",
            type: "success",
          })
        }
      });
    },
  }
};
</script>