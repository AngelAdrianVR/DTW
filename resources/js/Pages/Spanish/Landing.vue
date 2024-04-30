<template>
<!-- <MyAppLayout title="Bienvenido"> -->
    <div class="relative">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 right-3 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
        </a>

        <!-- mobile menu (hamburger) -->
        <div v-if="showMobileMenu"
            class="flex flex-col z-30 w-2/3 bg-[#262626] rounded-xl fixed top-20 right-1 border-white border py-1 text-white">
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Inicio')">Inicio</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Servicios')">Servicios</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Contacto')">Contacto</button>
            <button class="mx-2 py-2 hover:bg-[#7F659C] rounded-lg" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button>
            <ul v-if="showMore" class="text-center p-3">
                <li @click="$inertia.get(route('us'))" class="hover:bg-[#7F659C] rounded-lg p-1">Nosotros</li>
                <li @click="$inertia.get(route('quote-request.create'))" class="hover:bg-[#7F659C] rounded-lg p-1">Cotizar</li>
                <li @click="$inertia.get(route('packages'))" class="hover:bg-[#7F659C] rounded-lg p-1">Paquetes programación</li>
             </ul>
            <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
             </button>
        </div>

        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="flex items-center justify-between py-4 lg:px-10 px-6 w-full">
            <div class="flex space-x-2 items-center">
                <img src="@/../../public/assets/images/black_logo.png" class="h-12 cursor-pointer" alt="logo" />
            </div>
            <button @click="showMobileMenu = !showMobileMenu" class="lg:hidden">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>
            <div class="mr-12 hidden lg:inline relative">
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Inicio')">Inicio</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Servicios')">Servicios</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="scrollToSection('Contacto')">Contacto</button> |
                <button class="mx-2 hover:text-[#7F659C]" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button> |
                <button class="mx-2"> <Link :href="route('dtw-en')"><span :class="route().current('dtw-en') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">EN</span></Link>
             / 
             <Link :href="route('dtw')"><span :class="route().current('dtw') ? 'text-[#7F659C] font-bold' : '' " class="hover:text-[#7F659C]">ES</span></Link>
             </button>
             <ul v-if="showMore" class="absolute right-0 p-3 bg-white">
                <li @click="$inertia.get(route('us'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Nosotros</li>
                <li @click="$inertia.get(route('quote-request.create'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Cotizar</li>
                <li @click="$inertia.get(route('packages'))" class="hover:bg-[#7F659C] hover:text-white cursor-pointer p-1">Paquetes programación</li>
             </ul>
            </div>
        </nav>

        <main class="pt-20">
            <!-- first section desktop -->
            <section class="hidden lg:grid grid-cols-2 gap-x-10 h-96 mx-14" id="Inicio">
                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                </figure>
                <div class="flex-col justify-center py-14">
                    <h1 class="font-bold lg:text-7xl text-lg text-center">Diseño web a la medida</h1>
                    <p class="mt-9">
                        Creamos sitios web a la medida, único y personalizado según tus
                        necesidades, desde sitios corporativos, tiendas en línea,
                        informativos.
                    </p>

                    <button @click="$inertia.get(route('quote-request.create'))"
                        class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Cotizar mi sitio
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                    
                </div>
            </section>
            <!-- first section mobile -->
            <section class="h-96 mx-14 mb-24 lg:hidden" id="Inicio">
                <h1 class="font-bold lg:text-7xl text-lg text-center">Diseño web a la medida</h1>
                <figure>
                    <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing1.png" alt="computer" />
                </figure>
                <button @click="$inertia.get(route('quote-request.create'))"
                    class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                    Cotizar mi sitio
                    <i class="fa-solid fa-chevron-right ml-6"></i>
                </button>
                <p class="mt-9 text-justify">
                    Creamos sitios web a la medida, único y personalizado según tus
                    necesidades, desde sitios corporativos, tiendas en línea,
                    informativos.
                </p>
            </section>

            <section class="mt-10">
                <h1 class="text-center text-white text-3xl py-6 bg-[#1A1A1A]">Algunos de nuestros proyectos</h1>
                <div class="bg-[#262626] py-12 flex">
                    <!-- <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </div> -->
                    <div class="w-full lg:grid grid-cols-3">
                        <a href="https://www.emblemas3d.com" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-01.png">
                        </a>
                        <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-02.png">
                        <a href="https://youpartner.xphere.com.mx" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-03.png">
                        </a>
                        <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-04.png">
                        <a href="https://sigmasolutionsmx.com" target="_blank">
                            <img class="h-[334px] mx-auto cursor-pointer" src="@/../../public/assets/images/PC-05.png">
                        </a>
                        <img class="h-60 mx-auto cursor-pointer" src="@/../../public/assets/images/PC-06.png">
                    </div>
                    <!-- <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div> -->
                </div>
            </section>

            <!-- landing 3 desktop -->
            <section class="hidden lg:block lg:mx-24 mx-1 mt-9 relative">
                <!-- bg decorations -->
                <img class="absolute top-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute top-72 -right-0 -z-10 rotate-180" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute bottom-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <!-- end decorations -->

                <div class="text-center" id="Servicios">
                    <h2 class="font-bold mb-3 text-xl">SERVICIOS</h2>
                    <p>
                        Creamos diseños, programación y funcionalidad única para tu marca.
                    </p>
                </div>

                <div class="lg:grid grid-cols-2 gap-x-10">
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing2.png" alt="computer" />
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Diseño y desarrollo de página web a la medida
                        </h1>
                        <p class="mt-9 text-center">
                            Creamos diseños únicos y exclusivos para cada cliente, experiencia
                            de usuario (UI/UX), responsividad y compatibilidad en diferentes
                            dispositivos, desarrollo de código fuente (SEO) para un
                            posicionamiento adecuado en buscadores y mucho más...
                        </p>
                    </div>

                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Mantenimiento y actualización de páginas web
                        </h1>
                        <p class="mt-9 text-center">
                            Actualización de contenido y sofware, mejoras del diseño de la
                            página, soporte técnico, optimización de rendimiento,
                            mantenimiento de rutina sobre el front y back end y más...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing3.png" alt="computer" />
                    </figure>

                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing4.png" alt="computer" />
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">
                            Desarrollo Back end - Front end
                        </h1>
                        <p class="mt-9 text-center">
                            Implementamos tecnología para eficientizar procesos, como ERP, CRM
                            CMS y mucho más...
                        </p>
                    </div>

                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Marketing digital</h1>
                        <p class="mt-9 text-center">
                            Incrementa tus ventas, amplia tu mercado y potencializa tu
                            negocio. Creamos publicidad digital mediante redes sociales y
                            más...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing5.png" alt="computer" />
                    </figure>
                </div>

                <div class="text-center">
                    <h3>Una web a la medida, con garantía de funcionamiento</h3>
                    <button @click="$inertia.get(route('quote-request.create'))"
                        class="mx-auto mt-2 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Solicita tu cotizacion sin compromiso
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <!-- landing 3 mobile -->
            <section class="lg:hidden lg:mx-24 mx-1 mt-9 relative">
                <!-- bg decorations -->
                <img class="absolute top-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute top-72 -right-0 -z-10 rotate-180" src="@/../../public/assets/images/decoration.png" />
                <img class="absolute bottom-0 -left-14 -z-10" src="@/../../public/assets/images/decoration.png" />
                <!-- end decorations -->

                <div class="text-center" id="Servicios">
                    <h2 class="font-bold mb-3 text-xl">SERVICIOS</h2>
                    <p>
                        Creamos diseños, programación y funcionalidad única para tu marca.
                    </p>
                </div>

                <div class="lg:grid grid-cols-2 gap-x-10">
                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Diseño y desarrollo de página web a la medida
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing2.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Creamos diseños únicos y exclusivos para cada cliente, experiencia
                            de usuario (UI/UX), responsividad y compatibilidad en diferentes
                            dispositivos, desarrollo de código fuente (SEO) para un
                            posicionamiento adecuado en buscadores y mucho más...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Mantenimiento y actualización de páginas web
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing3.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Actualización de contenido y sofware, mejoras del diseño de la
                            página, soporte técnico, optimización de rendimiento,
                            mantenimiento de rutina sobre el front y back end y más...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Desarrollo Back end - Front end
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing4.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Implementamos tecnología para eficientizar procesos, como ERP, CRM
                            CMS y mucho más...
                        </p>
                    </article>

                    <article class="mt-6 mx-8">
                        <h1 class="font-bold text-lg text-center">
                            Marketing digital
                        </h1>
                        <figure>
                            <img class="h-5/6 mx-auto" src="@/../../public/assets/images/landing5.png" alt="computer" />
                        </figure>
                        <p class="mt-6 text-justify">
                            Incrementa tus ventas, amplia tu mercado y potencializa tu
                            negocio. Creamos publicidad digital mediante redes sociales y
                            más...
                        </p>
                    </article>
                </div>

                <div class="text-center">
                    <h3>Una web a la medida, con garantía de funcionamiento</h3>
                    <button @click="$inertia.get(route('quote-request.create'))"
                        class="mx-auto mt-2 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                        Solicita tu cotizacion sin compromiso
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <section class="mt-10">
                <div class="bg-[#262626] lg:grid grid-cols-2 items-center justify-center px-14 py-2">
                    <figure class="h-72">
                        <img class="h-full" src="@/../../public/assets/images/landing6.png" />
                    </figure>
                    <div class="text-center text-white">
                        <h2 class="font-bold">
                            Sitios web responsivos que se ven perfecto en cualquier
                            dispositivo
                        </h2>
                        <p>
                            Desde smartphones y tables, hasta computadoras de escritorio,
                            nuestros diseños se ajustan perfectamente para brindar una
                            experiencia de usuario óptima en cualquier pantalla.
                        </p>
                    </div>
                </div>
                <h1 class="w-full text-center text-white lg:text-3xl text-sm py-6 bg-[#1A1A1A]">
                    Dejanos saber que necesitas y lo haremos posible
                </h1>
            </section>

            <!-- testimonies desktop -->
            <section class="hidden lg:block lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">
                    Nuestros clientes hablan por nosotros
                </h2>

                <div class="lg:grid grid-cols-2 gap-9">
                    <div v-for="(testimony, index) in testimonies" :key="index"
                        class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2">
                        <div class="grid grid-cols-4 gap-x-2 text-white">
                            <div class="flex-col space-y-2 items-center justify-center">
                                <figure class="rounded-full w-16 h-16">
                                    <img :src="testimony.imgPath" />
                                </figure>
                                <span>{{ testimony.name }}</span>
                            </div>
                            <div class="col-span-3">
                                <p>{{ testimony.text }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- testimonies mobil -->
            <section class="lg:hidden lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">
                    Nuestros clientes hablan por nosotros
                </h2>

                <div class="lg:grid grid-cols-2 gap-9">
                    <div class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2 flex text-white">
                        <div @click="currentTestimony = currentTestimony == 0 ? (testimonies.length - 1) : currentTestimony - 1"
                            class="w-8 mr-2 flex justify-center items-center">
                            <button>
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                        </div>
                        <div class="w-full">
                            <div class="flex-col space-y-2 items-center justify-center mb-3">
                                <figure class="rounded-full w-16 h-16 mx-auto">
                                    <img :src="testimonies[currentTestimony].imgPath" />
                                </figure>
                                <p class="text-center">{{ testimonies[currentTestimony].name }}</p>
                            </div>
                            <div class="col-span-3 text-justify">
                                <p>{{ testimonies[currentTestimony].text }}</p>
                            </div>
                        </div>
                        <div @click="currentTestimony = currentTestimony == (testimonies.length - 1) ? 0 : currentTestimony + 1"
                            class="w-8 ml-2 flex justify-center items-center">
                            <button>
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <section class="lg:mx-24 mx-1 mt-9 relative" id="Contacto">
                <h2 class="font-bold mb-3 text-xl text-center">Cuentanos tu idea</h2>

                <div class="lg:grid grid-cols-2 gap-9 mb-6">
                    <form @submit.prevent="store">
                        <div class="mb-5">
                            <label for="name">Nombre <span class="text-red-500">*</span></label>
                            <input v-model="form.name" type="text" id="name" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu nombre" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.name">{{ form.errors?.name }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="email">Correo <span class="text-red-500">*</span></label>
                            <input v-model="form.email" type="email" id="email" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu correo" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.mail">{{ form.errors?.mail }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="phone">Teléfono</label>
                            <input v-model="form.phone" type="text" id="phone"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu telefono" />
                            <p class="text-red-600 text-xs" v-if="form.errors?.phone">{{ form.errors?.phone }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="service">Servicio</label>
                            <select v-model="form.service" id="service"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Selecciona el servicio">
                                <option value="Tienda en linea">Tienda en linea</option>
                                <option value="Marketing digital">Marketing digital</option>
                                <option value="Landing page">Landing page</option>
                                <option value="ERP">ERP</option>
                                <option value="CRM">CRM</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <textarea v-model="form.message" rows="5" required
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px]"
                                placeholder="Mensaje"></textarea>
                            <p class="text-red-600 text-xs" v-if="form.errors?.message">{{ form.errors?.message }}</p>
                        </div>
                        <div class="mb-5">
                            <label for="terms" class="flex items-center">
                                <input v-model="form.info" type="checkbox" id="terms"
                                    class="mr-2 active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] text-[#7F659C] rounded-[10px]" />
                                Acepto recibir información sobre el servicio
                            </label>
                        </div>
                        <button type="submit"
                            class="mx-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5 hover:text-white hover:bg-[#7F659C] transition-all">
                            Enviar
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                    <div class="hidden lg:flex items-center justify-center bg-[#262626] rounded-[20px] h-2/3">
                        <video class="rounded-md" autoplay loop>
                            <source src="@/../../public/assets/vidios/dtw.mp4" type="video/mp4">
                            Tu navegador no soporta el elemento de video.
                        </video>
                    </div>
                    <!-- <figure class="rounded-[20px] hidden lg:block">
                        <img class="rounded-[20px]" src="@/../../public/assets/images/contact.png" />
                    </figure> -->
                </div>
            </section>

            <footer class="p-4 text-white bg-[#1A1A1A] h-72 md:h-52 mt-24 md:relative overflow-auto">
                <figure class="w-full">
                    <img class="md:w-[6%] w-[29%]" src="@/../../public/assets/images/white_logo.png" alt="" />
                </figure>
                <div class="md:grid grid-cols-3 h-28">
                    <div class="border-r border-white flex justify-center items-cente">
                        <p class="text-lg">"Liberando tu potencial en linea"</p>
                    </div>

                    <div class="border-r border-white flex justify-center items-center">
                        <div class="flex flex-col">
                            <h2 class="text-center mb-5 text-xl">Contacto</h2>
                            <div>
                                <p><i class="fa-solid fa-phone mr-2 mb-3"></i>3322268824</p>
                                <p>
                                    <i class="fa-solid fa-envelope mr-2"></i>contacto@dtw.com.mx
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center items-center">
                        <div class="flex flex-col justify-center items-center">
                            <h2 class="text-center mb-5 text-xl">Síguenos</h2>
                            <div>
                                <a href="https://www.facebook.com/profile.php?id=100094614796876" target="_blank"><i
                                        class="fa-brands fa-facebook text-2xl border border-white rounded-full px-3 py-2 cursor-pointer mr-5"></i></a>
                                <a href="https://instagram.com/digital_tw?utm_source=qr&igshid=NGExMmI2YTkyZg%3D%3D"
                                    target="_blank"><i
                                        class="fa-brands fa-instagram text-2xl border border-white rounded-full px-3 py-2 cursor-pointer"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 md:absolute bottom-2 left-5 hover:underline">
                        Política de privacidad - Plítica de cookies
                    </p>
                </a>
                <a class="hidden md:block" href="">
                    <p class="text-xs mt-3 md:absolute bottom-2 left-96 hover:underline">
                        Copyright | 2023 | Todos los derechos reservados por Digital TW S.A
                        de C.V.
                    </p>
                </a>
            </footer>
        </main>
    </div>
    <!-- </MyAppLayout> -->
</template>

<script>
import { useForm, Link, Head } from "@inertiajs/vue3";
import { useToast } from "vue-toastification";
import MyAppLayout from "@/Layouts/MyAppLayout.vue"
import e3dtest from '@/../../public/assets/images/e3dtest.png';
import churrotest from '@/../../public/assets/images/churrotest.png';
import profibratest from '@/../../public/assets/images/profibratest.png';

export default {
    data() {
        const form = useForm({
            name: null,
            email: null,
            phone: null,
            service: null,
            message: null,
            info: false,
        });
        return {
            form,
            showMore: false,
            isNavbarFixed: false,
            currentTestimony: 0,
            lastScrollY: 0,
            showMobileMenu: false,
            testimonies: [
                {
                    imgPath: e3dtest,
                    name: 'J. Sherman',
                    text: 'El sistema ERP desarrollado por DTW ha transformado por completo la forma en que gestionamos nuestro negocio. La solución personalizada se adaptó perfectamente a nuestras operaciones y nos ha permitido optimizar nuestros procesos, mejorar la visibilidad y tomar decisiones informadas en tiempo real.'
                },
                {
                    imgPath: churrotest,
                    name: 'Rocio R.',
                    text: 'Quiero agradecer al equipo de DTW por su creatividad y profesionalismo al crear mi sitio web. Han logrado plasmar perfectamente la visión que tenía en mente y han superado mis expectativas.'
                },
                {
                    imgPath: profibratest,
                    name: 'Jose Ricardo',
                    text: 'Recomiendo ampliamente el trabajo de DTW, se adapta a lo que necesites e inclusive recomienda mejoras, siempre atententos a todas las dudas que se tenga, y también a cualquier cambio que necesites. Ampliamente recomendado.'
                },
            ],
        };
    },
    components: {
        Head,
        Link,
        MyAppLayout,
    },
    mounted() {
        window.addEventListener('scroll', this.handleScroll);
        this.toast = useToast();
    },
    beforeDestroy() {
        window.removeEventListener('scroll', this.handleScroll);
    },
    methods: {
        handleScroll() {
            const currentScrollY = window.scrollY;

            if (currentScrollY > this.lastScrollY && currentScrollY > window.innerHeight) {
                // Si se hace scroll hacia abajo y se ha pasado el alto de la pantalla
                this.isNavbarFixed = false;
            } else {
                // Si se hace scroll hacia arriba
                this.isNavbarFixed = true;
            }

            this.lastScrollY = currentScrollY;
        },
        scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            section.scrollIntoView({ behavior: 'smooth' });
            this.showMobileMenu = false;
        },
        store() {
            this.form.post(route("messages.store"), {
                onSuccess: () => {
                    this.toast.success("Mensaje enviado correctamente", {
                        timeout: 3000
                    });

                    form.reset();
                }
            });
        },
    },
    components:{
      Link,
    }
};
</script>

<style>
/* Estilos para la barra de navegación */
.navbar {
    position: absolute;
    top: 0;
    background-color: #ffffff;
    opacity: 0.9;
}

.fixed-navbar {
    position: fixed;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

html {
    scroll-behavior: smooth;
}
</style>
