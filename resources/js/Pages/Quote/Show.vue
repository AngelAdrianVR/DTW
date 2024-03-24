<template>
  <Head :title="'C-'+String(quote.id).padStart(3, '0')" />
  <div class="text-sm rounded-[10px] px-5 py-4 relative">
    <div class="flex justify-between">
      <figure>
        <img src="@/../../public/assets/images/quote-logo.png">
      </figure>
      <p class="text-xs mt-4">{{ 'C-'+String(quote.id).padStart(3, '0') }}</p>
    </div>
    <p class="font-bold text-sm text-center">Cotización. {{ quote.name }}</p>
    <p class="text-xs text-right">Emisión: <span>{{ formatDate(date) }}</span>
    </p>
    <p class="text-xs text-right">Vigente hasta {{ quote.offer_validity_days }} días después de la emisión</p>
    <div class="px-4 mt-2">
      <p v-if="quote.client_id" class="text-xs text-left">
        {{ quote.client.name }}</p>
      <p v-if="quote.description" class="text-xs text-left">{{ quote.description }}</p>
      <p v-if="quote.features" class="text-sm font-bold text-left mt-2">Servicios</p>
      <div v-html="quote.features"></div>
      <section v-if="quote.total_work_days">
        <h2 class="text-sm font-bold text-left mt-2">Duración</h2>
        <p class="text-xs">La entrega estimada para la implementación final del proyecto es
          {{ quote.total_work_days }} días hábiles, iniciando a partir del primer pago al
          inicio del proyecto.
        </p>
      </section>
      <section v-if="quote.total_cost">
        <h2 class="text-sm font-bold text-left mt-2">Costo</h2>
        <p class="text-xs">
          ${{ quote.total_cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido
        </p>
      </section>
      <section v-if="quote.percentage_discount">
        <p class="text-xs">
          Descuento: ${{ ((quote.percentage_discount * 0.01) *
        quote.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g,
          ",") }} (%{{ quote.percentage_discount }})
        </p>
        <p class="text-sm font-bold text-left mt-2">Total</p>
        <p class="text-xs">
          ${{ (quote.total_cost - (quote.percentage_discount * 0.01) *
        quote.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
          IVA incluido
        </p>
      </section>
      <section v-if="quote.payment_type">
        <h2 class="text-sm font-bold text-left mt-2">Condiciones de pago</h2>
        <p class="text-xs">{{ quote.payment_type }}</p>
      </section>
      <p class="text-xs mt-3">
        Esta cotización no incluye costos adicionales que puedan surgir debido a cambios
        significativos en el alcance del proyecto.
      </p>
      <p class="text-xs mt-1">
        Si se requiere adicional Dominio y Hosting, se puede solicitar con un costo extra
        por la adquisición de los mismo.
      </p>
      <section v-if="quote.show_process" class="text-xs mt-3">
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
      <section v-if="quote.show_benefits" class="text-xs mt-3">
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
    </div>
  </div>
</template>

<script>
import { format } from 'date-fns';
import { es } from 'date-fns/locale';
import { Head } from '@inertiajs/vue3';

export default {
  data() {
    return {

    }
  },
  components: {
    Head,
  },
  props: {
    quote: Object
  },
  methods: {
    formatDate(date = null) {
      let parsedDate = new Date();
      if (date) {
        parsedDate = new Date(date);
      }
      return format(parsedDate, 'EEEE d \'de\' MMMM', { locale: es }); // Formato personalizado
    },
  },
}
</script>

<style></style>