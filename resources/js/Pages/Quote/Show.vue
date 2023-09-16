<template>
  <!-- ------------- quote preview --------------- -->
      <div class="py-5 px-7 mt-3 bg-white rounded-lg relative">
    <div class="flex justify-between">
      <figure>
        <img src="@/../../public/assets/images/quote-logo.png" alt="">
      </figure>
      <p class="text-sm mt-4">{{ 'C-' + quote.company.substr(0, 3).toUpperCase() + '-' + quote.project + '-' + quote.id.toString().padStart(4, "0") }}</p>
    </div>
    <p class="font-bold  text-center">Cotización. {{ quote.quote_name }}</p>
    <p class="text-sm text-right">Fecha de emisión: <span id="fecha-emision">{{ formatearFecha(fechaEmision) }}</span></p>
    <p class="text-sm text-right">Vigencia de la cotización: <span id="fecha-vigencia">{{ formatearFecha(fechaVigencia) }}</span></p>
    <div class="px-4 mt-2">
      <p v-if="quote.company" class="text-sm text-left">{{ quote.company }}</p>
      <p v-if="quote.company_address" class="text-sm text-left">{{ quote.company_address }}</p>
      <p v-if="quote.quote_description" class="text-sm text-left"><strong>Descripción: </strong>{{ quote.quote_description }}</p>
      <p v-if="quote.included_features?.length" class=" font-bold text-left mt-2">Servicios</p>
      <ul class="ml-4 mt-2" v-if="quote.included_features?.length">
        <li v-if="quote.subtitles?.length" class=" font-bold text-[#7F659C] text-left mt-2">{{quote.subtitles}}</li>
        <li class="text-sm" v-for="(feature, index) in quote.included_features" :key="feature"><span class="mr-3">{{ (index + 1) + '. ' }}</span>{{feature }}</li>
      </ul> 
      <p v-if="quote.total_work_days" class=" font-bold text-left mt-2">Duración</p>
      <p class="text-sm" v-if="quote.total_work_days">La entrega estimada para la implementación final del proyecto es {{ quote.total_work_days }} días hábiles, iniciando a partir del primer pago al
        inicio del proyecto.
      </p>
      <p v-if="quote.total_cost" class=" font-bold text-left mt-2">Costo</p>
      <p class="text-sm" v-if="quote.total_cost">${{ quote.total_cost.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido</p>
      <p v-if="quote.percentage_discount" class="text-sm">Descuento: ${{ ((quote.percentage_discount * 0.01) * quote.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} (%{{ quote.percentage_discount }})</p>
      <p v-if="quote.percentage_discount" class=" font-bold text-left mt-2">Total</p>
      <p class="text-sm" v-if="quote.percentage_discount">${{ (quote.total_cost - (quote.percentage_discount * 0.01) * quote.total_cost).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} IVA incluido</p>
      <p class=" font-bold text-left mt-2">Condiciones de pago</p>
      <p class="text-sm">30% al inicio del proyecto. </p>
      <p class="text-sm">40% al finalizar el desarrollo. </p>
      <p class="text-sm">30% al finalizar la implementación. </p>
      <p class="text-sm mt-3">Esta cotización no incluye costos adicionales que puedan surgir debido a cambios significativos en el alcance del proyecto. </p>
      <p class="text-sm mt-1">Si se requiere adicional Dominio y Hosting, se puede solicitar con un costo extra por la adquisición de los mismo.  </p>
      <p class="text-sm font-bold mt-3">Proceso</p>
      <p class="text-sm">El proyecto parte desde cero, comenzando con la fase de diseño. En esta etapa, se envía al cliente un archivo que contiene
        todas las vistas planificadas para la aplicación. Una vez que el diseño es aprobado, avanzamos hacia el desarrollo de la
        programación.
        Después de completar la programación, llevamos a cabo la fase de despliegue de la aplicación, lo que implica su
        alojamiento en la nube y su entrega al cliente. Durante esta fase, se verifica la funcionalidad y se corrigen de inmediato
        cualquier error de desarrollo o programación que pueda surgir.
        Adicionalmente, ofrecemos una capacitación en línea para un máximo de 5 usuarios seleccionados por la empresa. Esto
        garantiza que el cliente pueda aprovechar al máximo la nueva aplicación.
        Para respaldar nuestro compromiso con la calidad, proporcionamos un año de soporte técnico integral para solucionar
        cualquier problema relacionado con el desarrollo del sistema. Nuestra prioridad es asegurar un funcionamiento fluido y
        eficiente durante toda la vida útil de la aplicación
      </p>
      <p class="text-sm font-bold mt-3">Beneficios de adquirir el software</p>
      <p class="text-sm">- Compatibilidad en todos los dispositivos: nuestra plataforma es compatible con una amplia gama de dispositivos
        (computadora de escritorio, laptop, Tablet y/o teléfono móvil)
      </p>
      <p class="text-sm">- Seguridad de datos: la información se almacena de manera segura en la nube para proteger los datos de la
        empresa contra pérdidas. Realizamos respaldos automáticos para garantizar que sus datos estén siempre
        protegidos. 
      </p>
      <p class="text-sm">- Acceso remoto: Los usuarios pueden acceder a la información de la empresa desde cualquier lugar con conexión
       a Internet, lo que facilita el trabajo remoto y la colaboración fuera de la oficina principal.
      </p>
      <p class="text-sm">- Escalabilidad sin interrupciones: con nuestra tecnología, su sistema puede crecer y adaptarse a medida que su
        empresa evoluciona.
      </p>
      <p class="text-sm">- Soporte: Ofrecemos soporte técnico para garantizar que los usuarios aprovechen al máximo la plataforma y
        resuelvan cualquier problema de manera eficiente. 
      </p>
      <p class="text-sm">- Personalización de marca: "Entendemos la importancia de la identidad de su empresa. Personalizamos nuestro
        programa con los colores y la marca de su empresa, lo que le brinda una experiencia cohesiva y profesional para
        sus usuarios y clientes." 
      </p>
      <p class="text-sm">- Sin límite de usuarios. </p>
      <p class="text-sm">- No pagan cuota mensual, es de una sola adquisición. </p>

    </div>
  </div>
</template>

<script>
export default {
data(){
    return {
        fechaEmision: null, 
      fechaVigencia: null,
    }
},
props:{
    quote: Object
},
methods:{
    formatearFecha(fecha) {
      if (!fecha) return ''; // Manejar el caso en que la fecha sea null o undefined

      const options = { day: 'numeric', month: 'long', year: 'numeric' };
      return fecha.toLocaleDateString('es-ES', options);
    },
},
components:{

},
mounted() {
    const fechaEmisionSpan = document.getElementById('fecha-emision');
    const fechaVigenciaSpan = document.getElementById('fecha-vigencia');

    // Crea un objeto de fecha para obtener la fecha actual
    const fechaActual = new Date();

    // Calcula la fecha de vigencia
    const fechaVigencia = new Date();
    fechaVigencia.setDate(fechaVigencia.getDate() + 30);

    // Actualiza las propiedades de fecha
    this.fechaEmision = fechaActual;
    this.fechaVigencia = fechaVigencia
  },
}
</script>

<style>

</style>