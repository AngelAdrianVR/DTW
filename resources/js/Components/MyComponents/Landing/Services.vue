<template>
  <p class="text-center" data-aos="flip-up" data-aos-duration="1200" data-aos-offset="400">
    {{ language == 'english' ? 'We develop exclusive design, programming and functionality solutions, adapted to the identity and unique needs of your brand.' 
    : 'Desarrollamos soluciones de diseño, programación y funcionalidad exclusivas, adaptadas a la identidad y necesidades únicas de tu marca.' }}
  </p>

  <div class="pt-10" data-aos="fade-left" data-aos-duration="1200" data-aos-offset="400" data-aos-anchor-placement="center-bottom">
    <el-divider content-position="left">{{ language == 'english' ? 'Management' : 'Gestión' }}</el-divider>
  </div>

  <section class="lg:flex justify-between items-center lg:space-x-16 mt-24">
    <figure class="lg:w-2/3 w-full mb-10 p-3 flex" data-aos="flip-right" data-aos-duration="1200" data-aos-offset="400">
      <img src="@/../../public/assets/images/sistemas.webp" alt="" />
    </figure>

    <div class="lg:w-1/2 text-center lg:text-left" data-aos="flip-left" data-aos-duration="1200" data-aos-offset="400">
      <h1 class="text-xl font-bold mb-7">
        {{ language == 'english' ? 'We transform your data into intelligent solutions' 
        : 'Transformamos tus datos en soluciones inteligentes' }}
      </h1>
      <p>
        {{ language == 'english' ? 'We specialize in developing comprehensive solutions for all types of businesses, from entrepreneurs and small businesses to large corporations.' 
        : 'Nos especializamos en desarrollar soluciones integrales para todo tipo de negocio, desde emprendedores, pequeñas empresas hasta grandes corporaciones.' }}
      </p>

      <h1 class="text-xl text-center font-bold my-7">
        {{ language == 'english' ? 'SISTEMS' 
        : 'SISTEMAS' }}
      </h1>
      <p class="mb-3">
        {{ language == 'english' ? 'ERP (Enterprise Resource Planning).' 
        : 'ERP (Planificación de Recursos Empresariales).' }}
      </p>
      <p class="mb-3">
        {{ language == 'english' ? 'CRM (Customer Relationship Management).' 
        : 'CRM (Gestión de Relaciones con Clientes).' }}
      </p>
      <p class="mb-3">
        {{ language == 'english' ? 'PMS (Project Management Systems).' 
        : 'PMS (Sistemas de Gestión de Proyectos).' }}
      </p>
    </div>
  </section>

  <div class="pt-16" data-aos="fade-down" data-aos-duration="1200" data-aos-offset="400">
    <el-divider>{{ language == 'english' ? 'Enterprise IoT' : 'IoT Empresarial' }}</el-divider>
  </div>

  <!-- ioT -->
  <section class="lg:flex justify-between items-center lg:space-x-16 mt-20">
    <div class="lg:w-1/2 text-center lg:text-left" data-aos="flip-rigt" data-aos-duration="1200" data-aos-offset="400">
      <h1 class="text-xl font-bold mb-7">
        {{ language == 'english' ? 'IoT solutions for efficient management.' 
        : 'Soluciones de IoT para una gestión eficiente.' }}
      </h1>
      <p class="text-center">
        {{ language == 'english' ? 'We offer industrial IoT solutions that connect your equipment and processes to the network to optimize the productivity and efficiency of your operation.' 
        : 'Ofrecemos soluciones de IoT industrial que conectan tus equipos y procesos a la red para optimizar la productividad y eficiencia de tu operación.' }}
      </p>
      <p class="text-center mt-5">
        {{ language == 'english' ? 'Through advanced sensors and real-time data analysis, we improve decision-making, enable predictive maintenance and automate key tasks so that your industry is always at the technological forefront.' 
        : 'A través de sensores avanzados y análisis de datos en tiempo real, mejoramos la toma de decisiones, habilitamos el mantenimiento predictivo y automatizamos tareas clave para que tu industria esté siempre a la vanguardia tecnológica.' }}
      </p>
    </div>

    <figure class="lg:w-1/2 md:w-2/3 w-full mb-10 p-3 flex" data-aos="flip-left" data-aos-duration="1200" data-aos-offset="400">
      <img src="@/../../public/assets/images/IoT.webp" alt="" />
    </figure>
  </section>

  <div class="pt-5" data-aos="fade-left" data-aos-duration="1200" data-aos-offset="400">
    <el-divider content-position="right">{{ language == 'english' ? 'Branding' : 'Marca' }}</el-divider>
  </div>

  <!-- Branding -->
  <section class="lg:flex justify-between items-center lg:space-x-16 mt-20">
    <figure class="lg:w-2/3 mx-auto mb-10" data-aos="flip-right" data-aos-duration="1200" data-aos-offset="400">
      <img src="@/../../public/assets/images/branding.webp" alt="" />
    </figure>

    <div class="lg:w-1/3 text-center lg:text-left" data-aos="flip-left" data-aos-duration="1200" data-aos-offset="400">
      <h1 class="text-xl font-bold mb-7">Branding</h1>
      <p>{{ language == 'english' ? 'We build brands that connect with our customers.' 
        : 'Construimos marcas que conectan con nuestros clientes.' }}</p>
      <p class="mt-3">
        {{ language == 'english' ? 'Through a solid branding strategy, we define the essence of your business, transmitting your values, personality and differentiation in the market.' 
        : 'A través de una estrategia sólida de branding, definimos la esencia de tu negocio, transmitiendo tus valores, personalidad y diferenciación en el mercado' }}
      </p>
    </div>
  </section>

  <div class="pt-5" data-aos="fade-down" data-aos-duration="1200" data-aos-offset="400">
    <el-divider content-position="center">{{ language == 'english' ? 'Home IoT' : 'IoT Doméstico' }}</el-divider>
  </div>

  <!-- Home IoT -->
  <section class="lg:flex justify-between items-center lg:space-x-16 mt-20">
    <div class="lg:w-1/3 text-center lg:text-left">
      <h1 class="text-xl font-bold mb-7">
        {{ language == 'english' ? 'Internet of Things (IoT) - Smart Connection' 
        : 'Internet de las cosas (IoT) - Conexión inteligente' }}
      </h1>
      <p>
        {{ language == 'english' ? 'We integrate the Internet of Things (IoT) into our services, allowing your devices and machines to connect to each other and transmit key information in real time.' 
        : 'Integramos Internet de las cosas (IoT) en nuestros servicios, permitiendo que tus dispositivos y máquinas se conecten entre sí y transmitan información clave en tiempo real.' }}
      </p>
      <p class="mt-8 mb-3">
        {{ language == 'english' ? 'Real-time monitoring' 
        : 'Monitoreo em tiempo real' }}
      </p>
      <p class="mb-3">
        {{ language == 'english' ? 'Process automation' 
        : 'Automatización de procesos' }}
      </p>
      <p class="mb-3">
        {{ language == 'english' ? 'Predictive maintenance' 
        : 'Mantenimiento predictivo' }}
      </p>
    </div>

    <figure class="md:w-2/3 w-full mb-10 p-3 flex">
      <img src="@/../../public/assets/images/home_iot.webp" alt="" />
    </figure>
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
