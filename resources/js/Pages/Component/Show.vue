<template>
    <Head :title="component.name" />
    <main class="bg-gray-800 p-2 md:p-5 lg:p-10 min-h-screen">
        <div class="w-[80%] mx-auto mt-12">
            <div class="flex items-center justify-between mx-7">
                <span></span>
                <!-- <Back2 /> -->
                <div class="flex items-center space-x-5">
                    <span class="text-gray-100 font-bold text-lg">{{ component.name }}</span>
                    <p class="text-gray-400 flex items-center space-x-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>{{ formatViews(component.views) }}</span>
                    </p>
                </div>
            </div>

            <section class="flex m-2">
                <!-- parte izquierda (componente) -->
                <article :class="['w-1/2 rounded-l-3xl h-[600px] flex items-center justify-center relative', darkMode ? 'bg-black' : 'bg-['+ customColor + ']']">
                    <button @click="goBack" class="absolute top-2 left-2 size-12 text-white rounded-full flex items-center justify-center bg-gray-400 opacity-70 hover:scale-105">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <!-- Vista previa del componente -->
                    <div v-html="component.html_code"></div>

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
                <article class="bg-slate-900 w-1/2 rounded-r-3xl h-[600px] flex flex-col">
                    <!-- Pestañas -->
                    <div class="flex space-x-4 border-b border-gray-200 bg-gradient-to-t from-gray-600 to-gray-900">
                    <button
                        v-for="tab in tabs"
                        :key="tab"
                        @click="selectedTab = tab"
                        :class="{
                        'border-blue-500 text-blue-500': selectedTab === tab,
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
                        <div v-if="(selectedTab === 'HTML' && component.html_code) || (selectedTab === 'CSS' && component.css_code) || (selectedTab === 'JS' && component.js_code)" class="flex justify-end absolute top-2 right-2">
                            <CopyButton @click="copyToClipboard" />
                        </div>

                    <!-- Contenido de las pestañas -->
                    <div v-if="selectedTab === 'HTML'" class="bg-gray-900 p-3 rounded-lg mt-7">
                        <div class="flex">
                        <!-- Números de línea -->
                        <div class="text-gray-500 pr-4 text-right select-none">
                            <pre v-for="(line, index) in getLines(component.html_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                        </div>
                        <!-- Código -->
                        <pre class="text-white flex-1 overflow-x-auto"><code>{{ component.html_code ?? 'No hay código html' }}</code></pre>
                        </div>
                    </div>

                    <div v-if="selectedTab === 'CSS'" class="bg-gray-900 p-3 rounded-lg">
                        <div class="flex">
                        <!-- Números de línea -->
                        <div class="text-gray-500 pr-4 text-right select-none">
                            <pre v-for="(line, index) in getLines(component.css_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                        </div>
                        <!-- Código -->
                        <pre class="text-white flex-1 overflow-x-auto"><code>{{ component.css_code ?? 'No hay código CSS' }}</code></pre>
                        </div>
                    </div>

                    <div v-if="selectedTab === 'JS'" class="bg-gray-900 p-3 rounded-lg">
                        <div class="flex">
                        <!-- Números de línea -->
                        <div class="text-gray-500 pr-4 text-right select-none">
                            <pre v-for="(line, index) in getLines(component.js_code)" :key="index" class="m-0">{{ index + 1 }}</pre>
                        </div>
                        <!-- Código -->
                        <pre class="text-white flex-1 overflow-x-auto"><code>{{ component.js_code ?? 'No hay código js' }}</code></pre>
                        </div>
                    </div>
                    </div>
                </article>
            </section>
        </div>
    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Back2 from "@/Components/MyComponents/Back2.vue";
import CopyButton from "@/Components/MyComponents/CopyButton.vue";

export default {
data() {
    return {
        tabs: ['HTML', 'CSS', 'JS'],
        selectedTab: 'HTML',
        darkMode: false, // Estado del modo oscuro
        customColor: '#cfcfcf', // Color personalizado por el usuario
    }
},
components:{
    CopyButton,
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
      // Puedes personalizar esta lógica según tus necesidades
      // En este ejemplo, se utiliza la función history.back() para retroceder una página
      window.history.back();
    },
}
}
</script>