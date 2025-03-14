<template>
    <Head :title="component.name ? component.name : 'Componente UI'" />
    <main class="relative selection:bg-primarylight selection:text-primary bg-black min-h-screen text-white p-6">
        <!-- navbar -->
        <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]"
            class="!bg-black flex items-center justify-between py-4 lg:px-10 px-6 w-full text-white">
            <SpanishNav @scrolling="scrollToSection($event)" />
        </nav>
        <body class="bg-[#363636] p-2 md:p-5 lg:p-10 rounded-2xl">
            <div class="md:w-[100%] lg:w-[90%] xl:w-[80%] mx-auto mt-10">
                <div class="flex items-center justify-between mx-7">
                    <button @click="goBack" class="size-8 text-white rounded-full flex items-center justify-center bg-gray-400 opacity-70 hover:scale-105">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>
                    <span class="text-gray-100 font-bold text-lg">{{ component.name }}</span>
                    <p class="text-gray-400 flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>{{ formatViews(component.views) }}</span>
                    </p>
                </div>

                <section class="md:flex m-2">
                    <!-- parte izquierda (componente) -->
                    <article :id="`component-${component.id}`" :class="['md:w-1/2 rounded-t-3xl md:rounded-tr-none md:rounded-l-3xl h-[450px] md:h-[600px] flex items-center justify-center relative', darkMode ? 'bg-black' : 'bg-['+ customColor + ']']">

                        <!-- Vista previa del componente -->
                        <!-- Si es un componente hecho con tailwind se ejecuta el div, si es css se ejectuta PreviewCOmponent para activar keyframes -->
                        <PreviewComponent v-if="component.css_code" :htmlCode="component.html_code" :cssCode="component.css_code" :jsCode="component.js_code" />
                        <div v-else v-html="component.html_code"></div>

                        <div class="flex items-center space-x-3 absolute top-2 right-2 z-20 bg-gray-500 opacity-75 rounded-lg py-1 px-3">
                            <!-- Toggle para cambiar a modo oscuro -->
                            <!-- <div class="">
                                <label for="darkModeToggle" class="text-white mr-2">Modo oscuro</label>
                                <input type="checkbox" id="darkModeToggle" v-model="darkMode" class="cursor-pointer">
                            </div> -->
                            <span class="text-white font-bold">{{ customColor }}</span>
                            <!-- Selector de color -->
                            <div class="flex items-center">
                                <label for="colorPicker" class="text-white mr-2">Color de fondo</label>
                                <input type="color" id="colorPicker" v-model="customColor" class="cursor-pointer">
                            </div>
                        </div>
                    </article>

                    <!-- Parte derecha (código) -->
                    <article class="bg-[#232323] md:w-1/2 rounded-b-3xl md:rounded-r-3xl md:rounded-bl-none h-[600px] flex flex-col">
                        <!-- Pestañas -->
                        <div class="flex space-x-4 border-b border-[#4e4d4d] mx-3">
                        <button
                            v-for="tab in tabs"
                            :key="tab"
                            @click="selectedTab = tab; editMode = false"
                            :class="{
                            'border-[#C08AFD] text-[#C08AFD]': selectedTab === tab,
                            'border-transparent text-gray-400 hover:text-gray-300': selectedTab !== tab
                            }"
                            class="py-2 px-4 border-b-2 font-medium text-sm focus:outline-none z-10"
                        >
                            {{ tab }}
                        </button>
                        </div>

                        <!-- Contenedor del código con scroll y números de línea -->
                        <div class="flex-1 overflow-auto relative">
                            <!-- Botón de copiar -->
                            <div v-if="(selectedTab === 'HTML' && component.html_code) || (selectedTab === 'CSS' && component.css_code) || (selectedTab === 'JS' && component.js_code)" class="flex justify-between w-[95%] absolute top-2 right-2">
                                <div class="flex items-center space-x-3">
                                    <label class="group flex items-center cursor-pointer">
                                        <input class="hidden peer" type="checkbox" v-model="editMode" />
                                        <span
                                        class="relative w-5 h-5 flex justify-center items-center bg-gray-100 border-2 border-gray-400 rounded-md shadow-md transition-all duration-500 peer-checked:border-blue-500 peer-checked:bg-blue-500 peer-hover:scale-105"
                                        >
                                        <span
                                            class="absolute inset-0 bg-gradient-to-br from-white/30 to-white/10 opacity-0 peer-checked:opacity-100 rounded-md transition-all duration-500 peer-checked:animate-pulse"
                                        ></span>

                                        <svg
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                            class="hidden w-5 h-5 text-white peer-checked:block transition-transform duration-500 transform scale-50 peer-checked:scale-100"
                                            xmlns="http://www.w3.org/2000/svg"
                                        >
                                            <path
                                            clip-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 00-1.414 0L8 12.586 4.707 9.293a1 1 0 10-1.414 1.414l4 4a1 1 0 001.414 0l8-8a1 1 0 000-1.414z"
                                            fill-rule="evenodd"
                                            ></path>
                                        </svg>
                                        </span>

                                        <span
                                            class="ml-3 text-gray-500 group-hover:text-blue-500 font-medium transition-colors duration-300"
                                            >
                                            Editar
                                        </span>
                                    </label>
                                </div>

                                <CopyButton @click="copyToClipboard" />
                            </div>

                            <!-- Contenido de las pestañas -->
                            <div v-if="selectedTab === 'HTML'" class="p-3 rounded-lg mt-9">
                                <div class="flex">
                                    <!-- Números de línea -->
                                    <div class="text-gray-500 pr-4 text-right select-none">
                                        <pre v-for="(line, index) in getLines(component.html_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                                    </div>
                                    <!-- Código -->
                                    <textarea v-if="editMode" v-model="component.html_code" class="w-full p-2 bg-gray-800 text-white rounded" placeholder="No hay código html"></textarea>
                                    <pre v-else class="text-white flex-1 overflow-x-auto"><code>{{ component.html_code ?? 'No hay código html' }}</code></pre>
                                </div>
                            </div>

                            <div v-if="selectedTab === 'CSS'" class="p-3 rounded-lg mt-9">
                                <div class="flex">
                                <!-- Números de línea -->
                                <div class="text-gray-500 pr-4 text-right select-none">
                                    <pre v-for="(line, index) in getLines(component.css_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                                </div>
                                    <!-- Código -->
                                    <textarea v-if="editMode" v-model="component.css_code" class="w-full p-2 bg-gray-800 text-white rounded" placeholder="No hay código html"></textarea>
                                    <pre v-else class="text-white flex-1 overflow-x-auto"><code>{{ component.css_code ?? 'No hay código CSS' }}</code></pre>
                                </div>
                            </div>

                            <div v-if="selectedTab === 'JS'" class="p-3 rounded-lg mt-9">
                                <div class="flex">
                                <!-- Números de línea -->
                                <div class="text-gray-500 pr-4 text-right select-none">
                                    <pre v-for="(line, index) in getLines(component.js_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                                </div>
                                    <!-- Código -->
                                    <textarea v-if="editMode" v-model="component.js_code" class="w-full p-2 bg-gray-800 text-white rounded" placeholder="No hay código html"></textarea>
                                    <pre v-else class="text-white flex-1 overflow-x-auto"><code>{{ component.js_code ?? 'No hay código JS' }}</code></pre>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </div>
        </body>
        
    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Back2 from "@/Components/MyComponents/Back2.vue";
import CopyButton from "@/Components/MyComponents/CopyButton.vue";
import SpanishNav from "@/Components/MyComponents/Landing/SpanishNav.vue";
import PreviewComponent from "@/Components/MyComponents/PreviewComponent.vue";

export default {
data() {
    return {
        tabs: ['HTML', 'CSS', 'JS'],
        selectedTab: 'HTML',
        darkMode: false, // Estado del modo oscuro
        customColor: this.component.bg_color, // Color personalizado por el usuario
        editMode: false, //modo de edicion de código
        isNavbarFixed: false
    }
},
components:{
    PreviewComponent,
    CopyButton,
    SpanishNav,
    Back2,
    Head
},
props:{
    component: Object
},
methods:{
     // Método para copiar el contenido al portapapeles
    copyToClipboard() {
      const code = this.selectedTab === 'HTML' ? this.component.html_code :
                  this.selectedTab === 'CSS' ? this.component.css_code :
                  this.component.js_code;

      navigator.clipboard.writeText(code).then(() => {
      }).catch(() => {
        alert('Error al copiar el código');
      });
    },
    // Método para obtener las líneas del código
    getLines(code) {
      return code ? code.split('\n') : [];
    },
    formatViews(views) {
        if (views >= 1_000_000) {
            return (views / 1_000_000).toFixed(1) + 'M';
        } else if (views >= 1_000) {
            return (views / 1_000).toFixed(1) + 'K';
        } else {
            return views.toString();
        }
    },
    goBack() {
        if ( this.$page.props.auth?.user ) {
            this.$inertia.get(route('components.index'));
        } else {
            this.$inertia.get(route('UI-components'));
        }
    //   window.history.back();
    },
    // Función para inyectar los estilos
    // injectStyles() {
    //     if (this.component.css_code) {
    //         const styleId = `component-style-${this.component.id}`;
    //         let styleTag = document.getElementById(styleId);

    //         if (!styleTag) {
    //             styleTag = document.createElement("style");
    //             styleTag.id = styleId;
    //             document.head.appendChild(styleTag);
    //         }

    //         // Expresión regular para extraer los keyframes
    //         const keyframesRegex = /@keyframes\s+[\w-]+\s*{[^}]+}/g;
    //         let keyframes = "";
    //         let otherStyles = this.component.css_code.replace(keyframesRegex, (match) => {
    //             keyframes += match + "\n"; // Guardamos los keyframes globales
    //             return ""; // Removemos los keyframes del resto de estilos
    //         });

    //         // Insertar directamente los keyframes con textContent
    //         styleTag.textContent = keyframes;

    //         // Encapsulamos los estilos para que solo apliquen dentro del div con id `component-{id}`
    //         styleTag.innerHTML = `#component-${this.component.id} { ${this.component.css_code} }`;
    //         document.head.appendChild(styleTag);
            
    //     }
    // },
},
// mounted() {
//     this.injectStyles();
// },
}
</script>
