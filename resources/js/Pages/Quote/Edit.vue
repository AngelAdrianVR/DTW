<template>
  <AppLayout title="Crear cotización">
    <div class="mx-2 md:mx-12 mt-4">
      <header>
        <Back />
      </header>
      <main class="lg:grid grid-cols-2 gap-x-5 mt-6">
        <form @submit.prevent="update" class="border border-grayD9 rounded-[10px] px-5 py-4">
          <h1 class="font-bold text-sm">Información del cliente</h1>
          <div class="text-end">
            <el-radio-group v-model="isClient">
              <el-radio :value="true" size="small">Cliente</el-radio>
              <el-radio :value="false" size="small">Prospecto</el-radio>
            </el-radio-group>
          </div>
          <div v-if="isClient" class="mt-3">
            <InputLabel value="Cliente *" />
            <el-select @change="fetchClientContacts" v-model="form.client_id" placeholder="Selecciona al cliente">
              <el-option v-for="item in clients" :key="item.id" :label="item.name" :value="item.id" />
            </el-select>
            <InputError :message="form.errors.client_id" />
          </div>
          <div v-else class="mt-3">
            <InputLabel value="Prospecto *" />
            <el-select @change="fetchProspectContact" v-model="form.prospect_id" placeholder="Selecciona al prospecto">
              <el-option v-for="item in prospects" :key="item.id" :label="item.name" :value="item.id" />
            </el-select>
            <InputError :message="form.errors.prospect_id" />
          </div>
          <div class="mt-3">
            <InputLabel value="Contacto *" />
            <el-select v-model="form.contact_id" placeholder="Selecciona al contacto">
              <el-option v-for="item in contacts" :key="item.id" :label="item.name" :value="item.id" />
            </el-select>
            <InputError :message="form.errors.contact_id" />
          </div>
          <h1 class="font-bold text-sm mt-3">Información de la cotización</h1>
          <div class="mt-2">
            <InputLabel value="Nombre de la cotización *" />
            <el-input v-model="form.name" type="text" placeholder="Agrega el nombre de la cotización" />
            <InputError :message="form.errors.name" />
          </div>
          <div class="mt-3">
            <InputLabel value="Descripción de la cotización" />
            <el-input v-model="form.description" maxlength="500" :autosize="{ minRows: 3, maxRows: 5 }" show-word-limit
              type="textarea" placeholder="Agrega la descripción de la cotización si es necesario" />
            <InputError :message="form.errors.description" />
          </div>
          <div class="mt-3">
            <InputLabel value="Servicios *" />
            <ckeditor :editor="editor" v-model="form.features" :config="editorConfig"></ckeditor>
            <InputError :message="form.errors.features" />
          </div>
          <div class="mt-3">
            <InputLabel value="Condiciones de pago *" />
            <el-select v-model="form.payment_type" placeholder="Selecciona las condiciones de pago">
              <el-option v-for="item in paymentTypes" :key="item" :label="item" :value="item" />
            </el-select>
            <InputError :message="form.errors.payment_type" />
          </div>
          <div class="grid grid-cols-2 gap-x-4 gap-y-2 mt-3">
            <div>
              <InputLabel value="Costo total del proyecto *" />
              <el-input v-model="form.total_cost" type="text" placeholder="Ingresa el costo total"
                :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')">
                <template #prefix>
                  <i class="fa-solid fa-dollar"></i>
                </template>
              </el-input>
              <InputError :message="form.errors.total_cost" />
            </div>
            <div>
              <InputLabel value="Descuento" />
              <el-input v-model="form.percentage_discount" type="text" maxlength="2"
                placeholder="Porcentaje de descuento">
                <template #prefix>
                  <i class="fa-solid fa-percentage"></i>
                </template>
              </el-input>
              <InputError :message="form.errors.percentage_discount" />
            </div>
            <div>
              <InputLabel value="Días hábiles de trabajo *" />
              <el-input v-model="form.total_work_days" type="text" placeholder="Cantidad de días de trabajo"
                :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')" />
              <InputError :message="form.errors.total_work_days" />
            </div>
            <div>
              <InputLabel value="Días de validez de cotización *" />
              <el-select v-model="form.offer_validity_days" placeholder="Selecciona los días  de validez">
                <el-option v-for="item in offerValidities" :key="item" :label="item" :value="item" />
              </el-select>
              <InputError :message="form.errors.offer_validity_days" />
            </div>
          </div>
          <div class="mt-3">
            <el-checkbox v-model="form.show_process" label="Mostrar procesos" size="small" />
            <el-checkbox v-model="form.show_benefits" label="Mostrar beneficios" size="small" />
            <el-checkbox v-model="form.show_bank_info" label="Mostrar datos bancarios" size="small" />
          </div>
          <div class="mt-2 flex justify-end">
            <PrimaryButton :isLoading="form.processing" :disabled="form.processing">Actualizar cotización
            </PrimaryButton>
          </div>
        </form>
        <!-- ------------- quote preview --------------- -->
        <div class="text-sm border border-grayD9 rounded-[10px] px-5 py-4 relative">
          <!-- <p class="absolute top-0 right-2 text-gray-400 text-sm">Vista previa</p> -->
          <div class="absolute w-full top-0 left-0">
            <figure
              class="w-full rounded-t-[10px] bg-cover h-32 py-11 pl-12 bg-no-repeat bg-[url('@/../../public/assets/images/quoteTemplate/header.png')]">
              <img src="@/../../public/assets/images/quoteTemplate/logo.png" class="h-10">
            </figure>
          </div>
          <div class="flex flex-col items-end mt-6">
            <p class="text-xs">Emisión: <span>{{ formatDate(date) }}</span></p>
            <p class="text-xs">Vigente hasta {{ form.offer_validity_days }} días después de la emisión</p>
          </div>
          <main class="mt-16 mb-24">
            <h1 class="font-bold text-base text-center">Cotización. {{ form.name }}</h1>
            <div v-if="form.client_id">
              <p class="text-xs text-left">{{ clients.find(item => item.id === form.client_id).name }}</p>
              <p class="text-xs text-left">{{ clients.find(item => item.id === form.client_id).address }}</p>
            </div>
            <div v-if="form.prospect_id">
              <p class="text-xs text-left">{{ prospects.find(item => item.id === form.prospect_id).name }}</p>
              <p class="text-xs text-left">{{ prospects.find(item => item.id === form.prospect_id).address }}</p>
            </div>
            <p v-if="form.description" class="text-xs text-left"><b>Descripción: </b>{{ form.description }}</p>
            <h2 v-if="form.features" class="text-sm font-bold text-left mt-3">Servicios</h2>
            <div v-html="form.features" class="text-xs"></div>
            <section v-if="form.total_work_days">
              <h2 class="text-sm font-bold text-left mt-2">Duración</h2>
              <p class="text-xs">La entrega estimada para la implementación final del proyecto es
                {{ form.total_work_days }} días hábiles, iniciando a partir del primer pago al
                inicio del proyecto.
              </p>
            </section>
            <section v-if="form.total_cost">
              <h2 class="text-sm font-bold text-left mt-2">Costo</h2>
              <p class="text-xs">
                ${{ form.total_cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido
              </p>
            </section>
            <section v-if="form.percentage_discount">
              <p class="text-xs">
                Descuento: ${{ ((form.percentage_discount * 0.01) *
          form.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
            ",") }} (%{{ form.percentage_discount }})
              </p>
              <p class="text-sm font-bold text-left mt-2">Total</p>
              <p class="text-xs">
                ${{ (form.total_cost - (form.percentage_discount * 0.01) *
          form.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
                IVA incluido
              </p>
            </section>
            <section v-if="form.payment_type">
              <h2 class="text-sm font-bold text-left mt-2">Condiciones de pago</h2>
              <p class="text-xs">{{ form.payment_type }}</p>
            </section>
            <p class="text-xs mt-3">
              Esta cotización no incluye costos adicionales que puedan surgir debido a cambios
              significativos en el alcance del proyecto.
            </p>
            <p class="text-xs mt-1">
              Si se requiere adicional Dominio y Hosting, se puede solicitar con un costo extra
              por la adquisición de los mismo.
            </p>
            <section v-if="form.show_process" class="text-xs mt-3">
              <h2 class="font-bold">Proceso</h2>
              <p>
                El proyecto parte desde cero, comenzando con la fase de diseño. En esta etapa, se envía
                al cliente un archivo que contiene
                todas las vistas planificadas para la aplicación. Una vez que el diseño es aprobado, avanzamos hacia el
                desarrollo de la
                programación.
                Después de completar la programación, llevamos a cabo la fase de despliegue de la aplicación, lo que
                implica
                su
                alojamiento en la nube y su entrega al cliente. Durante esta fase, se verifica la funcionalidad y se
                corrigen
                de inmediato
                cualquier error de desarrollo o programación que pueda surgir.
                Adicionalmente, ofrecemos una capacitación en línea para un máximo de 5 usuarios seleccionados por la
                empresa.
                Esto
                garantiza que el cliente pueda aprovechar al máximo la nueva aplicación.
                Para respaldar nuestro compromiso con la calidad, proporcionamos un año de soporte técnico integral para
                solucionar
                cualquier problema relacionado con el desarrollo del sistema. Nuestra prioridad es asegurar un
                funcionamiento
                fluido y
                eficiente durante toda la vida útil de la aplicación
              </p>
            </section>
            <section v-if="form.show_benefits" class="text-xs mt-3">
              <h2 class="font-bold">Beneficios de adquirir el software</h2>
              <p>- Compatibilidad en todos los dispositivos: nuestra plataforma es compatible con una
                amplia
                gama de dispositivos
                (computadora de escritorio, laptop, Tablet y/o teléfono móvil)
              </p>
              <p>- Seguridad de datos: la información se almacena de manera segura en la nube para
                proteger
                los datos de la
                empresa contra pérdidas. Realizamos respaldos automáticos para garantizar que sus datos estén siempre
                protegidos.
              </p>
              <p>- Acceso remoto: Los usuarios pueden acceder a la información de la empresa desde
                cualquier
                lugar con conexión
                a Internet, lo que facilita el trabajo remoto y la colaboración fuera de la oficina principal.
              </p>
              <p>- Escalabilidad sin interrupciones: con nuestra tecnología, su sistema puede crecer y
                adaptarse a medida que su
                empresa evoluciona.
              </p>
              <p>- Soporte: Ofrecemos soporte técnico para garantizar que los usuarios aprovechen al
                máximo la
                plataforma y
                resuelvan cualquier problema de manera eficiente.
              </p>
              <p>- Personalización de marca: "Entendemos la importancia de la identidad de su empresa.
                Personalizamos nuestro
                programa con los colores y la marca de su empresa, lo que le brinda una experiencia cohesiva y
                profesional
                para
                sus usuarios y clientes."
              </p>
              <p>- Sin límite de usuarios. </p>
              <p>- No pagan cuota mensual, es de una sola adquisición. </p>
            </section>
          </main>
          <footer v-if="form.show_bank_info" class="w-full absolute bottom-0 right-0">
            <section
              class="w-[70%] bg-cover ml-auto h-24 pl-[17%] py-2 bg-no-repeat bg-[url('@/../../public/assets/images/quoteTemplate/footer.png')]">
              <article class="text-[#6d6d6d] text-xs">
                <h2 class="font-bold text-center mb-1">Datos para la realización de pagos</h2>
                <p>Nombre del beneficiario: <span class="text-black">Miguel Osvaldo Vázquez Rodríguez</span></p>
                <p>Banco: <span class="text-black">NU México</span></p>
                <p>Número de cuenta: <span class="text-black">00017049244</span></p>
                <p>CLABE: <span class="text-black">638180000170492445</span></p>
              </article>
            </section>
          </footer>
        </div>
      </main>
    </div>
  </AppLayout>
</template>

<script>
import Back from "@/Components/MyComponents/Back.vue";
import InputLabel from "@/Components/InputLabel.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import axios from "axios";
import { format } from 'date-fns';
import { es } from 'date-fns/locale';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  data() {
    const form = useForm({
      name: this.quote.name,
      client_id: this.quote.client_id,
      prospect_id: this.quote.prospect_id,
      contact_id: this.quote.contact_id,
      description: this.quote.description,
      features: this.quote.features,
      payment_type: this.quote.payment_type,
      total_cost: this.quote.total_cost,
      percentage_discount: this.quote.percentage_discount,
      total_work_days: this.quote.total_work_days,
      offer_validity_days: this.quote.offer_validity_days,
      show_process: Boolean(this.quote.show_process),
      show_benefits: Boolean(this.quote.show_benefits),
      show_bank_info: Boolean(this.quote.show_bank_info),
    });
    return {
      // ckEditor 5
      editor: ClassicEditor,
      editorConfig: {
        // The configuration of the editor.
      },
      form,
      contacts: [],
      isClient: Boolean(this.quote.client_id),
      paymentTypes: [
        'Pago en una sola exhibición',
        '2 pagos (50% al inicio y 50% a la entrega del proyecto)',
        '3 pagos ( 30% al inicio, 40 al desarrollo y 30% a la entrega)',
      ],
      offerValidities: [
        7,
        15,
        30,
        60,
        90,
      ],
    };
  },
  components: {
    AppLayout,
    SecondaryButton,
    Link,
    PrimaryButton,
    InputError,
    InputLabel,
    Back,
  },
  props: {
    quote: Array,
    clients: Array,
    prospects: Array,
  },

  methods: {
    formatDate(date = null) {
      let parsedDate = new Date();
      if (date) {
        parsedDate = new Date(date);
      }
      return format(parsedDate, 'EEEE d \'de\' MMMM', { locale: es }); // Formato personalizado
    },
    update() {
      this.form.put(route("quotes.update", this.quote), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "",
            type: "success",
          });
        }
      });
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
    async fetchClientContacts() {
      try {
        const response = await axios.get(route('clients.get-contacts', this.form.client_id));

        if (response.status === 200) {
          this.contacts = response.data.items;
        }
      } catch (error) {
        console.log(error);
      }
    },
    async fetchProspectContact() {
      try {
        const response = await axios.get(route('prospects.get-contact', this.form.prospect_id));

        if (response.status === 200) {
          this.contacts.push(response.data.item);
          this.form.contact_id = response.data.item.id;
        }
      } catch (error) {
        console.log(error);
      }
    }
  },
};
</script>