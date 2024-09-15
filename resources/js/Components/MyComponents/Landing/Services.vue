<template>
  <p class="text-center">
    {{ language == 'english' ? 'We develop exclusive design, programming and functionality solutions, adapted to the identity and unique needs of your brand.' 
    : 'Desarrollamos soluciones de diseño, programación y funcionalidad exclusivas, adaptadas a la identidad y necesidades únicas de tu marca.' }}
  </p>

  <div class="pt-10">
    <el-divider content-position="left">Managent</el-divider>
  </div>

  <section class="lg:flex justify-between items-center lg:space-x-16 mt-24">
    <figure class="border-2 border-white rounded-lg h-40 lg:w-1/2 md:w-2/3 mx-auto mb-10 p-3"></figure>

    <div class="lg:w-1/2 text-center lg:text-left">
      <h1 class="text-xl font-bold mb-7">
        {{ language == 'english' ? 'We transform your data into intelligent solutions' 
        : 'Transformamos tus datos en soluciones inteligentes' }}
      </h1>
      <p>
        {{ language == 'english' ? 'We develop solutions such as ERP, CRM, PMS, among others. We also specialize in advanced reporting.' 
        : 'Desarrollamos soluciones como ERP, CRM, PMS, entre otros. Además nos especializamos en reportes avanzados.' }}
      </p>
    </div>
  </section>

  <div class="pt-16">
    <el-divider>IoT</el-divider>
  </div>

  <!-- ioT -->
  <section class="lg:flex justify-between items-center lg:space-x-16 mt-20">
    <div class="lg:w-1/2 text-center lg:text-left">
      <h1 class="text-xl font-bold mb-7">
        {{ language == 'english' ? 'IoT solutions for efficient management.' 
        : 'Soluciones de IoT para una gestión eficiente.' }}
      </h1>
      <p>
        {{ language == 'english' ? 'We integrate the Internet of Things (IoT) into our services, allowing your devices and machines to connect to each other and transmit key information in real time.' 
        : 'Integramos Internet de las cosas (IoT) en nuestros servicio, permitiendo que tus dispositivos y máquinas se conecten entre sí y transmitan información clave en tiempo real.' }}
      </p>
    </div>

    <figure class="lg:w-1/2 md:w-2/3 w-full mb-10 p-3 flex">
      <img src="@/../../public/assets/images/IoT.png" alt="" />
    </figure>
  </section>

  <div class="pt-5">
    <el-divider content-position="right">Branding</el-divider>
  </div>

  <!-- Branding -->
  <section class="lg:flex justify-between items-center lg:space-x-16 mt-20">
    <figure class="lg:w-2/3 mx-auto mb-10">
      <img src="@/../../public/assets/images/branding.png" alt="" />
    </figure>

    <div class="lg:w-1/3 text-center lg:text-left">
      <h1 class="text-xl font-bold mb-7">Branding</h1>
      <p>{{ language == 'english' ? 'We build brands that connect with our customers.' 
        : 'Construimos marcas que conectan con nuestros clientes.' }}</p>
      <p class="mt-3">
        {{ language == 'english' ? 'Through a solid branding strategy, we define the essence of your business, transmitting your values, personality and differentiation in the market.' 
        : 'A través de una estrategia sólida de branding, definimos la esencia de tu negocio, transmitiendo tus valores, personalidad y diferenciación en el mercado' }}
      </p>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {};
  },
  props:{
    language:{
      type: String,
      default: 'spanish'
    }
  }
};
</script>
