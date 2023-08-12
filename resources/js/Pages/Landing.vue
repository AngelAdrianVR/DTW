<template>
    <div class="mt-1 relative">
        <!-- whatsapp button -->
        <a class="z-50 w-14 h-14 lg:w-20 lg:h-20 rounded-full bg-green-600 shadow-md shadow-green-800/100 flex items-center justify-center fixed bottom-3 lg:right-3 right-16 hover:scale-105"
            href="https://api.whatsapp.com/send?phone=523312155731&text=Hola!%20vi%20tu%20página%20DTW,%20me%20interesa%20su%20servicio!"
            target="_blank" rel="noopener noreferrer">
            <i class="fa-brands fa-beat fa-whatsapp text-2xl lg:text-4xl text-gray-100"></i>
        </a>
        <!-- navbar -->
        <nav class="flex items-center justify-between py-4 lg:mx-10">
            <div class="flex space-x-2 items-center">
                <img src="../../../public/assets/images/dtw_logo.png" class="h-10" alt="logo">
                <span>Digital TW</span>
            </div>
            <div>
                <a class="mx-2 hover:text-[#7F659C]" href="/">Inicio</a> |
                <a class="mx-2 hover:text-[#7F659C]" href="/">Servicios</a> |
                <a class="mx-2 hover:text-[#7F659C]" href="/">Contacto</a>
            </div>
        </nav>

        <main>
            <section class="lg:grid grid-cols-2 gap-x-10 h-96 mx-14">
                <figure>
                    <img class="h-5/6 mx-auto" src="../../../public/assets/images/landing1.png" alt="computer">
                </figure>
                <div class="flex-col justify-center py-14">
                    <h1 class="font-bold text-7xl text-center">Diseño web a la medida</h1>
                    <p class="mt-9">
                        Creamos sitios web a la medida, único y personalizado según tus necesidades, desde sitios
                        corporativos, tiendas en línea, informativos.
                    </p>
                    <button
                        class="ml-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5">
                        Cotizar mi sitio
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <section class="mt-32">
                <h1 class="text-center text-white text-3xl py-6 bg-[#1A1A1A]">Proyectos</h1>
                <div class="bg-[#262626] py-12 flex">
                    <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="w-full lg:grid grid-cols-3 gap-x-2">
                        <img class="h-60 mx-auto" src="../../../public/assets/images/PC-01.png">
                        <img class="h-60 mx-auto" src="../../../public/assets/images/PC-02.png">
                        <img class="h-60 mx-auto" src="../../../public/assets/images/PC-03.png">
                    </div>
                    <div class="w-8 flex justify-center items-center">
                        <button class="text-white">
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </section>

            <section class="lg:mx-24 mx-1 mt-9 relative">
                <!-- bg decorations -->
                <img class="absolute top-0 -left-14 -z-10" src="../../../public/assets/images/decoration.png">
                <img class="absolute top-72 -right-14 -z-10 rotate-180" src="../../../public/assets/images/decoration.png">
                <img class="absolute bottom-0 -left-14 -z-10" src="../../../public/assets/images/decoration.png">
                <!-- end decorations -->

                <div class="text-center">
                    <h2 class="font-bold mb-3 text-xl">SERVICIOS</h2>
                    <p>Creamos diseños, programación y funcionalidad única para tu marca.</p>
                </div>

                <div class="lg:grid grid-cols-2 gap-x-10">
                    <figure>
                        <img class="h-5/6 mx-auto" src="../../../public/assets/images/landing2.png" alt="computer">
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Diseño y desarrollo de página web a la medida</h1>
                        <p class="mt-9 text-center">
                            Creamos diseños únicos y exclusivos para cada cliente, experiencia de usuario (UI/UX),
                            responsividad y compatibilidad en diferentes dispositivos, desarrollo de código fuente (SEO)
                            para un posicionamiento adecuado en buscadores y mucho más...
                        </p>
                    </div>

                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Mantenimiento y actualización de páginas web </h1>
                        <p class="mt-9 text-center">
                            Actualización de contenido y sofware, mejoras del diseño de la página, soporte técnico,
                            optimización de rendimiento, mantenimiento de rutina sobre el front y back end y más...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="../../../public/assets/images/landing3.png" alt="computer">
                    </figure>

                    <figure>
                        <img class="h-5/6 mx-auto" src="../../../public/assets/images/landing4.png" alt="computer">
                    </figure>
                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Desarrollo Back end - Front end</h1>
                        <p class="mt-9 text-center">
                            Implementamos tecnología para eficientizar procesos, como ERP, CRM CMS y mucho más...
                        </p>
                    </div>


                    <div class="flex-col justify-center py-14">
                        <h1 class="font-bold text-lg text-center">Marketing digital</h1>
                        <p class="mt-9 text-center">
                            Incrementa tus ventas, amplia tu mercado y potencializa tu negocio.
                            Creamos publicidad digital mediante redes sociales y más...
                        </p>
                    </div>
                    <figure>
                        <img class="h-5/6 mx-auto" src="../../../public/assets/images/landing5.png" alt="computer">
                    </figure>
                </div>

                <div class="text-center">
                    <h3>Una web a la medida, con garantía de funcionamiento</h3>
                    <button
                        class="mx-auto mt-2 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5">
                        Solicita tu cotizacion sin compromiso
                        <i class="fa-solid fa-chevron-right ml-6"></i>
                    </button>
                </div>
            </section>

            <section class="mt-10">
                <div class="bg-[#262626] lg:grid grid-cols-2 items-center justify-center px-14 py-2">
                    <figure class="h-96">
                        <img class="h-full" src="../../../public/assets/images/landing6.png">
                    </figure>
                    <div class="text-center text-white">
                        <h2 class="font-bold">Sitios web responsivos que se ven perfecto en cualquier dispositivo</h2>
                        <p>
                            Desde smartphones y tables, hasta computadoras de escritorio, nuestros diseños se ajustan
                            perfectamente para brindar una experiencia de usuario óptima en cualquier pantalla.
                        </p>
                    </div>
                </div>
                <h1 class="w-full text-center text-white text-3xl py-6 bg-[#1A1A1A]">Dejanos saber que necesitas y lo
                    haremos posible</h1>
            </section>

            <section class="lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">Nuestros clientes hablan por nosotros</h2>

                <div class="lg:grid grid-cols-2 gap-9">
                    <div v-for="(testimony, index) in testimonies" :key="index"
                        class="bg-[#262626] rounded-[30px] px-8 py-16">
                        <div class="grid grid-cols-4 gap-x-2 text-white">
                            <div class="flex-col space-y-2 items-center justify-center">
                                <figure class="rounded-full w-16 h-16">
                                    <img :src="testimony.imgPath">
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

            <section class="lg:mx-24 mx-1 mt-9 relative">
                <h2 class="font-bold mb-3 text-xl text-center">Cuentanos tu idea</h2>

                <div class="lg:grid grid-cols-2 gap-9 mb-6">
                    <form>
                        <div class="mb-5">
                            <label for="name">Nombre <span class="text-red-500">*</span></label>
                            <input type="text" id="name"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu nombre">
                        </div>
                        <div class="mb-5">
                            <label for="email">Correo <span class="text-red-500">*</span></label>
                            <input type="email" id="email"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu correo">
                        </div>
                        <div class="mb-5">
                            <label for="phone">Teléfono<span class="text-red-500">*</span></label>
                            <input type="text" id="phone"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Escribe tu telefono">
                        </div>
                        <div class="mb-5">
                            <label for="service">Servicio</label>
                            <select id="service"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px] h-9"
                                placeholder="Selecciona el servicio">
                                <option value="1">Tienda en linea</option>
                                <option value="2">Marketing digital</option>
                                <option value="3">Landing page</option>
                                <option value="4">ERP</option>
                                <option value="5">CRM</option>
                                <option value="6">Otro</option>
                            </select>
                        </div>
                        <div class="mb-5">
                            <textarea rows="5"
                                class="active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] block w-full text-[#808080] rounded-[10px]"
                                placeholder="Mensaje"></textarea>
                        </div>
                        <div class="mb-5">
                            <label for="terms" class="flex items-center">
                                <input type="checkbox" id="terms"
                                class="mr-2 active:ring-0 focus:ring-0 border-none outline-none bg-[#D9D9D9] text-[#7F659C] rounded-[10px]">
                                Acepto recibir información sobre el servicio
                            </label>
                        </div>
                        <button type="submit"
                            class="mx-auto mt-5 rounded-full border-2 border-[#7F659C] text-[#7F659C] flex justify-between items-center py-1 px-5">
                            Enviar
                            <i class="fa-solid fa-chevron-right ml-6"></i>
                        </button>
                    </form>
                    <figure class="rounded-[20px] hidden lg:block">
                        <img class="rounded-[20px]" src="../../../public/assets/images/contact.png">
                    </figure>
                </div>
            </section>

        </main>
    </div>
</template>

<script>

export default {
    data() {
        return {
            testimonies: [
                {
                    imgPath: '../../../public/assets/images/e3dtest.png',
                    name: 'J. Sherman',
                    text: 'Recomiendo ampliamente el trabajo de DTW, se adapta a lo que necesites e inclusive recomienda mejoras, siempre atententos a todas las dudas que se tenga, y también a cualquier cambio que necesites. Ampliamente recomendado.'
                },
                {
                    imgPath: '../../../public/assets/images/churrotest.png',
                    name: 'Rocio R.',
                    text: 'Recomiendo ampliamente el trabajo de DTW, se adapta a lo que necesites e inclusive recomienda mejoras, siempre atententos a todas las dudas que se tenga, y también a cualquier cambio que necesites. Ampliamente recomendado.'
                },
                {
                    imgPath: '../../../public/assets/images/profibratest.png',
                    name: 'Jose Ricardo',
                    text: 'Recomiendo ampliamente el trabajo de DTW, se adapta a lo que necesites e inclusive recomienda mejoras, siempre atententos a todas las dudas que se tenga, y también a cualquier cambio que necesites. Ampliamente recomendado.'
                },
            ]
        };
    },
}

</script>
