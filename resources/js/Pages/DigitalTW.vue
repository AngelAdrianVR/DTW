<script setup>
import { Head, Link } from "@inertiajs/vue3";
import { onMounted } from "vue";
import { custom } from "@/vendor/js/custom";
import { useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import { useToast } from "vue-toastification";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
});

onMounted(() => {
  custom(window.jQuery);
});

const toast = useToast();

const form = useForm({
  name: null,
  email: null,
  company: null,
  phone: null,
  message: null,
});

function store() {
  form.post(route("messages.store"), {
    onSuccess: () => {
      toast.success("Mensaje enviado correctamente", {
        timeout: 3000
      });

      form.reset();
    }
  });
}

function scrollToTop() {
  const scrollStep = -window.scrollY / (700 / 15); // Velocidad y suavidad del desplazamiento (500ms)
  const scrollInterval = setInterval(() => {
    if (window.scrollY !== 0) {
      window.scrollBy(0, scrollStep);
    } else {
      clearInterval(scrollInterval);
    }
  }, 15); // Intervalo de tiempo del desplazamiento (15ms)
}
</script>

<template>
  <Head title="DigitalTW" />
  <div class="px-2">
    <!-- whatsapp button -->
    <a class="z-20 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
      href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!" target="_blank"
      rel="noopener noreferrer">
      <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
    </a>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader loaded">
      <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header id="inicio" class="header-area header-sticky">
      <div class="container mx-auto">
        <div class="row">
          <div class="col-12">
            <nav class="main-nav">
              <!-- ***** Logo Start ***** -->
              <a :href="route('dtw')" class="logo -mt-5">
                <img width="70%" src="assets/images/Logo_dtw.svg" alt="" />
              </a>
              <!-- ***** Logo End ***** -->

              <!-- ***** Menu Start ***** -->
              <ul class="nav">
                <li><a @click="scrollToTop">Inicio</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#contact">Contacto</a></li>
                <!-- <li><a href="packages.html">Paquetes de Desarrollo</a></li> -->
                <!-- <li><a href="#">Perfil <i class="fa-solid fa-user mx-2"></i></a></li> -->
              </ul>
              <a class="menu-trigger">
                <span>Menu</span>
              </a>
              <!-- ***** Menu End ***** -->
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <div id="banner" class="container mx-auto">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-content">
            <!-- ***** Banner Start ***** -->
            <div class="main-banner shadow-lg shadow-gray-500/100 mt-3">
              <div class="row">
                <div class="col-lg-7">
                  <div class="header-text">
                    <h6>Bienvenido a Digital Tw</h6>
                    <h4><em>Servicios</em> de desarrollo web y</h4>
                    <h4><em>marketing</em> Digital</h4>
                    <!-- <div class="main-button">
                    <a href="browse.html">Cotiza Ahora</a>
                  </div> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Banner End ***** -->

            <h2 id="servicios" class="text-4xl mt-7 text-center">
              Algunos de nuestros Proyectos
            </h2>

            <!-- ***** Sitios Web Start ***** -->
            <div class="row mt-9">
              <div class="col-lg-12">
                <div class="featured-games header-text">
                  <div class="heading-section">
                    <h4><em>Sitios</em> Web</h4>
                  </div>
                  <div class="owl-features owl-carousel">
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/Freeze.png" alt="" />
                        <div class="hover-effect">
                          <h6>Visitar</h6>
                        </div>
                      </div>
                      <h4>
                        Freeze<br /><span>Reparación e Instalación de Equipo de enfriamiento y
                          refrigeración</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                          <img src="assets/images/Emblems3dUSA.png" alt="" />
                        <div class="hover-effect">
                          <a href="https://emblemas3d.com/" target="_blank">
                          <h6>Visitar</h6>
                          </a>
                        </div>
                      </div>
                      <h4>
                        Emblems3d USA<br /><span>Negocio de articulos publicitarios de la rama
                          automotriz</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                          <img src="assets/images/SigmaSolutions.png" alt="" />
                        <div class="hover-effect">
                          <a href="https://sigmasolutionsmx.com/" target="_blank">
                          <h6>Visitar</h6>
                          </a>
                        </div>
                      </div>
                      <h4>
                        SigmaSolutionsMx<br /><span>Empresa sorteadora que ofrece servicios de calidad a
                          manufactureras de cualquier rama</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/Serviflex.png" alt="" />
                        <div class="hover-effect">
                          <h6>Visitar</h6>
                        </div>
                      </div>
                      <h4>
                        Serviflex<br /><span>Empresa que ofrece servicios flexibles y venta de
                          maquinaria específica</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                          <img src="assets/images/Youpartner.png" alt="" />
                        <div class="hover-effect">
                        <a href="https://youpartner.xphere.com.mx/" target="_blank">
                          <h6>Visitar</h6>
                        </a>
                        </div>
                      </div>
                      <h4>
                        YouPartner<br /><span>Plataforma estudiantil de apoyo académico y
                          asesorías</span>
                      </h4>
                      <!-- <ul>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> Responsivo</li>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> dinámico</li>
                    </ul> -->
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/Suiter.png" alt="" />
                        <div class="hover-effect">
                          <h6>Visitar</h6>
                        </div>
                      </div>
                      <h4>
                        Suiter.com<br /><span>Alquiler de suites de lujo</span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Sitios Web End ***** -->

            <!-- ***** Crms e inventarios start ***** -->
            <div class="row mt-9">
              <div class="col-lg-12">
                <div class="featured-games header-text">
                  <div class="heading-section">
                    <h4><em>CRM e</em> Inventarios</h4>
                  </div>
                  <div class="owl-features owl-carousel">
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/e3d_vip.png" alt="" />
                      </div>
                      <h4>
                        Emblems3d USA Vip<br /><span>Sitio vip de emblemas3d para clientes
                          destacados.</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/intranet_e3d.png" alt="" />
                      </div>
                      <h4>
                        Emblems3d USA Intranet<br /><span>Intranet de emblemas3d USA que lleva control interno
                          administrativo, produccion, inventario, creativo, etc.
                        </span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/Profibra.png" alt="" />
                      </div>
                      <h4>
                        Profibra<br /><span>Inventario y gestion interna de producción de la
                          empresa</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/xphere.png" alt="" />
                      </div>
                      <h4>
                        Xphere<br /><span>Sistema de gestión y administración de
                          fraccionamientos</span>
                      </h4>
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/YouPartner_admin.png" alt="" />
                      </div>
                      <h4>
                        YouPartner<br /><span>Administración de la plataforma académica
                          YouPartner</span>
                      </h4>
                      <!-- <ul>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> Responsivo</li>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> dinámico</li>
                    </ul> -->
                    </div>
                    <div class="item">
                      <div class="thumb">
                        <img src="assets/images/purochurro.png" alt="" />
                      </div>
                      <h4>
                        purochurro<br /><span>gestión administrativa, inventario y empleados de una
                          franquicia de churros rellenos</span>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Crms e inventarios Start ***** -->

            <!-- ***** Marketing Start ***** -->
            <div class="start-stream">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Marketing</em> Digital</h4>
                  <h5>
                    Si estás buscando una manera efectiva de llevar tu negocio
                    al siguiente nivel, el marketing digital puede ser la clave
                    para lograrlo.
                  </h5>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                      <i class="fa-solid fa-compass-drafting text-indigo-400 text-3xl"></i>
                      <h4>Diseño Web</h4>
                      <p>
                        Diseño de páginas web profesionales para dar a conocer
                        tu negocio, productos y/o servicios y conectes con un
                        mayor número de clientes.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                      <i class="fa-solid fa-store text-indigo-400 text-3xl"></i>
                      <h4>Desarrollo de tiendas en linea</h4>
                      <p>
                        Comienza a vender en línea con una tienda online auto
                        administrable, moderna y con todas las herramientas para
                        que triunfes en el e-commerce.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                      <i class="fa-solid fa-bullhorn text-indigo-400 text-3xl"></i>
                      <h4>Publicidad en redes sociales</h4>
                      <p>
                        Incrementa tus ventas y consigue más clientes con una
                        campaña publicitaria en Redes Sociales, lo más usado en
                        la actualidad.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Marketing End ***** -->

            <!-- ***** Redes Sociales Start ***** -->
            <div class="start-stream">
              <div class="col-lg-12">
                <div class="heading-section">
                  <h4><em>Gestión de</em> Redes Sociales</h4>
                  <h5>
                    Tener presencia en redes sociales hoy en día es necesario
                    para que tu negocio sea reconocido. Somos tus mejores
                    aliados y ayudamos a que tu publicidad en redes sociales
                    consiga los mejores resultados en las plataformas digitales
                    más utilizadas.
                  </h5>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-blue-600/100 my-4">
                      <i class="fa-brands fa-facebook text-blue-900 text-5xl"></i>
                      <h4>Facebook</h4>
                      <p>
                        DigitalTW se encarga del manejo de tus redes sociales.
                        Creamos campañas y estrategias eficaces para la red
                        social más utilizada en la actualidad.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-orange-500/100 my-4">
                      <i class="fa-brands fa-instagram text-orange-700 text-5xl"></i>
                      <h4>Instagram</h4>
                      <p>
                        De la mano de Facebook dirigimos tus anuncios a usuarios
                        específicos y creamos contenido de alto valor para
                        Instagram Feed, Stories & IGTV. Todo a la medida de tu
                        negocio.
                      </p>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="item hover:shadow-md hover:shadow-green-500/100 my-4">
                      <i class="fa-brands fa-whatsapp text-green-700 text-5xl"></i>
                      <h4>WhatsApp</h4>
                      <p>
                        Conectamos tu sitio y redes sociales con WhatsApp que es
                        el medio más usado en la actualidad. Creamos sistemas de
                        entrega de mensajes a bandeja de entrada de WhatsApp.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Redes Sociales End ***** -->

            <!-- ***** nosotros Start ***** -->
            <div id="nosotros" class="game-details -mt-9">
              <div class="row">
                <div class="col-lg-12">
                  <h2>Acerca de Nosotros</h2>
                </div>
                <div class="col-lg-12">
                  <div class="content">
                    <div class="row">
                      <div class="col-lg-4">
                        <div class="left-info">
                          <i class="fas fa-users text-gray-400 text-3xl mb-1"></i>
                          <div class="center">
                            <h4>Equipo multidisciplinario</h4>
                            <span>Contamos con personal experto en diferentes
                              ramas, todos comprometidos con tu proyecto.</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="left-info">
                          <i class="fas fa-laptop text-gray-400 text-3xl mb-1"></i>
                          <div class="center">
                            <h4>Tecnología de vanguardia</h4>
                            <span>Contamos con herramientas digitales que nos
                              ayudan a conseguir mejores resultados para tu
                              negocio.</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="left-info">
                          <i class="fas fa-chart-bar text-gray-400 text-3xl mb-1"></i>
                          <div class="center">
                            <h4>Estrategia de resultados</h4>
                            <span>Nos caracterizamos por comprometernos con los
                              proyectos y trabajos en equipo contigo.</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <p class="text-gray-300 text-xl">
                          En DigitalTW nos apasiona ayudar a nuestros clientes a
                          alcanzar sus metas de negocio a través de soluciones
                          digitales efectivas.
                        </p>

                        <p class="text-gray-300 text-xl mt-4">
                          Somos un equipo de expertos en diseño y desarrollo
                          web, marketing digital con años de experiencia en la
                          industria. Creemos que el éxito en línea se logra
                          mediante una combinación de estrategias creativas y
                          técnicas sólidas. Es por eso que trabajamos
                          estrechamente con nuestros clientes para entender sus
                          objetivos y necesidades, y así ofrecer soluciones
                          personalizadas que se adapten a su negocio.
                        </p>

                        <p class="text-gray-300 text-xl mt-3">
                          Confíe en DigitalTW para llevar su negocio al
                          siguiente nivel en línea. ¡Estamos emocionados de
                          trabajar con usted!.
                        </p>
                      </div>
                      <div class="col-lg-12">
                        <div class="main-border-button">
                          <a href="#contact">¡Cotizar Ahora!</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ***** Details End ***** -->

            <!-- ***** packages Start ***** -->
            <div class="gaming-library">
            <div class="col-lg-12">
              <div class="heading-section">
                <h4><em>Paquetes</em> de desarrollo</h4>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/box.png" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>drop and drag zone</h4><span>dtw.</span>
                  </li>
                  <li>
                    <h4>Fecha de subida</h4><span>24/08/2023</span>
                  </li>
                  <li>
                    <h4>Peso</h4><span>15 Mb</span>
                  </li>
                  <li>
                    <h4>N° descargas</h4><span>547</span>
                  </li>
                  <li>
                    <div class="main-border-button"><a href="#">Descargar</a></div>
                  </li>
                </ul>
              </div>
              <div class="item">
                <ul>
                  <li><img src="assets/images/box.png" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>carrousel</h4><span>dtw.</span>
                  </li>
                  <li>
                    <h4>Fecha de subida</h4><span>24/08/2023</span>
                  </li>
                  <li>
                    <h4>Peso</h4><span>10 Mb</span>
                  </li>
                  <li>
                    <h4>N° descargas</h4><span>817</span>
                  </li>
                  <li>
                    <div class="main-border-button "><a href="#">Descargar</a></div>
                  </li>
                </ul>
              </div>
              <div class="item last-item">
                <ul>
                  <li><img src="assets/images/box.png" alt="" class="templatemo-item"></li>
                  <li>
                    <h4>Login</h4><span>dtw.</span>
                  </li>
                  <li>
                    <h4>Fecha de subida</h4><span>24/08/2024</span>
                  </li>
                  <li>
                    <h4>Peso</h4><span>30 Mb</span>
                  </li>
                  <li>
                    <h4>N° descargas</h4><span>1,254</span>
                  </li>
                  <li>
                    <div class="main-border-button"><a href="#">Descargar</a></div>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="main-button">
                <a href="packages.html">Ver todos los paquetes</a>
              </div>
            </div>
          </div>
            <!-- ***** packages End ***** -->

            <!-- ***** Contact Start ***** -->
            <div id="contact" class="live-stream text-center">
              <div class="grid-cols-3">
                <div class="heading-section">
                  <h4><em>Ponte en</em> Contacto</h4>
                </div>
              </div>
              <form @submit.prevent="store">
                <div>
                  <div class="item">
                    <input v-model="form.name" placeholder="Nombre*"
                      class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400 md:w-1/2 w-full" type="text" required />
                    <InputError :message="$page.props?.errors.name" />
                  </div>
                </div>
                <div class="col-start-2">
                  <div class="item">
                    <input v-model="form.email" placeholder="E-mail*"
                      class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400 md:w-1/2 w-full" type="email" required />
                    <InputError :message="$page.props?.errors.email" />
                  </div>
                </div>
                <div class="col-start-1">
                  <div class="item">
                    <input v-model="form.company" placeholder="Empresa"
                      class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400 md:w-1/2 w-full" type="text" />
                    <InputError :message="$page.props?.errors.ncompanyame" />
                  </div>
                </div>
                <div class="col-start-2">
                  <div class="item">
                    <input v-model="form.phone" placeholder="Teléfono"
                      class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400 md:w-1/2 w-full" type="text" />
                    <InputError :message="$page.props?.errors.phone" />
                  </div>
                </div>
                <div class="col-start-1 col-span-2">
                  <div class="item">
                    <textarea v-model="form.message" placeholder="Mensaje*"
                      class="px-4 py-2 rounded-xl bg-zinc-800 text-zinc-400 md:w-1/2 w-full" required></textarea>
                    <InputError :message="$page.props?.errors.message" />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="main-button">
                    <button class="bg-[#028c9e] text-white active:bg-white active:text-[#028c9e] p-3">Enviar</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- ***** Contact End ***** -->
          </div>
        </div>
      </div>
    </div>

    <footer>
      <div class="container mx-auto">
        <div class="row">
          <div class="col-lg-12">
            <p>
              Copyright © 2023 <a href="#">DigitalTW</a> Company. Todos los
              derechos reservados.
            </p>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>
