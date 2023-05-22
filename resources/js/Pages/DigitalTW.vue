<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { custom } from '@/vendor/js/custom';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

onMounted(() => {
  custom(window.jQuery);
});

</script>

<template>
    <Head title="DigitalTW" />
    <div class="lg:ml-24">
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
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="index.html" class="logo -mt-5">
              <img width="90%" src="assets/images/Logo_dtw.svg" alt="">
            </a>
            <!-- ***** Logo End ***** -->

            <!-- ***** Menu Start ***** -->
            <ul class="nav">
              <li><a href="index.html">Inicio</a></li>
              <li><a href="#servicios">Servicios</a></li>
              <li><a href="#nosotros">Nosotros</a></li>
              <li><a href="#contact">Contacto</a></li>
              <!-- <li><a href="packages.html">Paquetes de Desarrollo</a></li> -->
              <li><a href="#">Perfil <i class="fa-solid fa-user mx-2"></i></a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
            <!-- ***** Menu End ***** -->
          </nav>
        </div>
      </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->

  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="page-content">

          <!-- ***** Banner Start ***** -->
          <div class="main-banner mt-3">
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

          <h2 id="servicios" class="text-4xl mt-7 text-center">Algunos de nuestros Proyectos</h2>
          
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
                      <img src="assets/images/Freeze.png" alt="">
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>Freeze<br><span>Reparación e Instalación de Equipo de enfriamiento y refrigeración</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <a href="https://emblemas3d.com/">
                        <img src="assets/images/Emblems3dUSA.png" alt="">
                      </a>
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>Emblems3d USA<br><span>Negocio de articulos publicitarios de la rama automotriz</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <a href="https://sigmasolutionsmx.com/">
                        <img src="assets/images/SigmaSolutions.png" alt="">
                      </a>
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>SigmaSolutionsMx<br><span>Empresa sorteadora que ofrece servicios de calidad a manufactureras de
                        cualquier rama</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <img src="assets/images/Serviflex.png" alt="">
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>Serviflex<br><span>Empresa que ofrece servicios flexibles y venta de maquinaria
                        específica</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <a href="https://youpartner.xphere.com.mx/">
                        <img src="assets/images/Youpartner.png" alt="">
                      </a>
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>YouPartner<br><span>Plataforma estudiantil de apoyo académico y asesorías</span></h4>
                    <!-- <ul>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> Responsivo</li>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> dinámico</li>
                    </ul> -->
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <img src="assets/images/Suiter.png" alt="">
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>Suiter.com<br><span>Alquiler de suites de lujo</span></h4>

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
                      <img src="assets/images/e3d_vip.png" alt="">
                    </div>
                    <h4>Emblems3d USA Vip<br><span>Sitio vip de emblemas3d para clientes destacados.</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                        <img src="assets/images/intranet_e3d.png" alt="">
                    </div>
                    <h4>Emblems3d USA Intranet<br><span>Intranet de emblemas3d USA que lleva control interno administrativo, produccion, inventario, creativo, etc. </span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                        <img src="assets/images/Profibra.png" alt="">
                    </div>
                    <h4>Profibra<br><span>Inventario y gestion interna de producción de la empresa</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <img src="assets/images/xphere.png" alt="">
                    </div>
                    <h4>Xphere<br><span>Sistema de gestión y administración de fraccionamientos</span></h4>
                  </div>
                  <div class="item">
                    <div class="thumb">
                        <img src="assets/images/YouPartner_admin.png" alt="">
                    </div>
                    <h4>YouPartner<br><span>Administración de la plataforma académica YouPartner</span></h4>
                    <!-- <ul>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> Responsivo</li>
                      <li><i class="fa-solid fa-mobile-screen-button"></i> dinámico</li>
                    </ul> -->
                  </div>
                  <div class="item">
                    <div class="thumb">
                      <img src="assets/images/purochurro.png" alt="">
                      <div class="hover-effect">
                        <h6>Visitar</h6>
                      </div>
                    </div>
                    <h4>purochurro<br><span>gestión administrativa, inventario y empleados de una franquicia de churros rellenos</span></h4>

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
                <h5> Si estás buscando una manera efectiva de llevar tu negocio al siguiente nivel, el marketing digital
                  puede ser la clave para lograrlo.</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                    <i class="fa-solid fa-compass-drafting text-indigo-400 text-3xl"></i>
                    <h4>Diseño Web</h4>
                    <p>Diseño de páginas web profesionales para dar a conocer tu negocio, productos y/o servicios
                      y conectes con un mayor número de clientes.</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                    <i class="fa-solid fa-store text-indigo-400 text-3xl"></i>
                    <h4>Desarrollo de tiendas en linea</h4>
                    <p>Comienza a vender en línea con una tienda online auto administrable,
                      moderna y con todas las herramientas para que triunfes en el e-commerce.</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-indigo-500/100 my-4">
                    <i class="fa-solid fa-bullhorn text-indigo-400 text-3xl"></i>
                    <h4>Publicidad en redes sociales</h4>
                    <p>Incrementa tus ventas y consigue más clientes con una campaña publicitaria en Redes Sociales, lo más usado en la actualidad.</p>
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
                <h5>Tener presencia en redes sociales hoy en día es necesario para que tu negocio sea reconocido, somos
                  tus mejores aliados y ayudamos a que tu publicidad en redes sociales consiga los mejores resultados en
                  las plataformas digitales más utilizadas.</h5>
              </div>
              <div class="row">
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-blue-600/100 my-4">
                    <i class="fa-brands fa-facebook text-blue-900 text-5xl"></i>
                    <h4>Facebook</h4>
                    <p>DigitalTW se encarga del manejo de tus redes sociales. Creamos campañas y estrategias eficaces
                      para la red social más utilizada en la actualidad.</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-orange-500/100 my-4">
                    <i class="fa-brands fa-instagram text-orange-700 text-5xl"></i>
                    <h4>Instagram</h4>
                    <p>De la mano de Facebook dirigimos tus anuncios a usuarios específicos y creamos contenido de alto
                      valor para Instagram Feed, Stories & IGTV. Todo a la medida de tu negocio.</p>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="item hover:shadow-md hover:shadow-green-500/100 my-4">
                    <i class="fa-brands fa-whatsapp text-green-700 text-5xl"></i>
                    <h4>WhatsApp</h4>
                    <p>Conectamos tu sitio y redes sociales con WhatsApp que es el medio más usado este año. Creamos sistemas de entrega de mensajes a bandeja de entrada de WhatsApp.</p>
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
                        <i class="fas fa-users text-red-400 text-3xl mb-1"></i>
                        <div class="center">
                          <h4>Equipo multidisciplinario</h4>
                          <span>Contamos con personal experto en diferentes ramas, todos comprometidos con tu proyecto.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="left-info">
                        <i class="fas fa-laptop text-red-400 text-3xl mb-1"></i>
                        <div class="center">
                          <h4>Tecnología de vanguardia</h4>
                          <span>Contamos con herramientas digitales que nos ayudan a conseguir mejores resultados para tu negocio.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="left-info">
                        <i class="fas fa-chart-bar text-red-400 text-3xl mb-1"></i>
                        <div class="center">
                          <h4>Estrategia de resultados</h4>
                          <span>Nos caracterizamos por comprometernos con los proyectos y trabajos en equipo contigo.</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <p class="text-gray-300 text-lg">En DigitalTW, nos apasiona ayudar a nuestros clientes a alcanzar sus metas de
                        negocio a través de soluciones digitales efectivas.</p>
                        
                       <p class="text-gray-300 text-lg">Somos un equipo de expertos en diseño y desarrollo web, marketing digital con años de experiencia en la industria.
                        Creemos que el éxito en línea se logra mediante una combinación de estrategias creativas y
                        técnicas sólidas. Es por eso que trabajamos estrechamente con nuestros clientes para entender
                        sus objetivos y necesidades, y así ofrecer soluciones personalizadas que se adapten a su
                        negocio.</p>

                        
                        <p class="text-gray-300 text-lg mt-3">Confíe en DigitalTW para llevar su negocio al siguiente nivel en línea. ¡Estamos
                          emocionados de trabajar con usted!.</p>
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
          <!-- <div class="gaming-library">
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
          </div> -->
          <!-- ***** packages End ***** -->


          <!-- ***** Contact Start ***** -->
          <div id="contact" class="live-stream">
            <div class="grid-cols-3">
              <div class="heading-section">
                <h4><em>Ponte en</em> Contacto</h4>
              </div>
            </div>
            <form>
              <div>
                <div class="item">
                  <input placeholder="Nombre*" class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400" type="text">
                </div>
              </div>
              <div class="col-start-2">
                <div class="item">
                  <input placeholder="E-mail*" class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400">
                </div>
              </div>
              <div class="col-start-1">
                <div class="item">
                  <input placeholder="Empresa*" class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400">
                </div>
              </div>
              <div class="col-start-2">
                <div class="item">
                  <input placeholder="Teléfono*" class="px-4 py-2 rounded-full bg-zinc-800 text-zinc-400">
                </div>
              </div>
              <div class="col-start-1 col-span-2">
                <div class="item">
                  <textarea placeholder="Mensaje*" class="px-4 py-2 rounded-xl bg-zinc-800 text-zinc-400"></textarea>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="item">
                  <p><i class="fa-solid fa-envelope text-xl text-gray-400"></i> angelvazquez470@gmail.com</p>
                  <p><i class="fa-solid fa-phone text-xl text-gray-400"></i> 33-12-15-57-31</p>
                  <p><i class="fa-brands fa-whatsapp text-xl text-gray-400"></i> 33-12-15-57-31</p>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="main-button">
                  <a href="streams.html">Enviar</a>
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
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <p>Copyright © 2023 <a href="#">DigitalTW</a> Company. Todos los derechos reservados.
            </p>
        </div>
      </div>
    </div>
  </footer>

    </div>
</template>
