<template>
    <Head :title="component.name" />
    <main class="bg-gray-800 p-2 md:p-5 lg:p-10 min-h-screen">
        <div class="w-[80%] mx-auto mt-12">
            <div class="flex items-center justify-between mx-7">
                <span></span>
                <!-- <Back2 /> -->
                <div class="flex items-center space-x-5">
                    <span class="text-gray-100 font-bold">{{ component.name }}</span>
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
                <article class="bg-gray-300 w-1/2 rounded-l-3xl h-[500px] flex items-center justify-center relative">
                    <button @click="goBack" class="absolute top-2 left-2 size-12 text-white rounded-full flex items-center justify-center bg-gray-400 opacity-70 hover:scale-105">
                        <i class="fa-solid fa-arrow-left"></i>
                    </button>

                    <!-- Vista previa del componente -->
                    <div v-html="component.html_code"></div>

                    <!-- acciones -->
                    <div class="absolute left-2 top-16 rounded-full h-72 w-12 p-4 bg-gray-400 opacity-50 flex flex-col">
                        
                    </div>
                </article>

                <!-- parte derecha (código) -->
                <article class="bg-slate-900 w-1/2 rounded-r-3xl h-[500px]">

                </article>
            </section>
        </div>
    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';
import Back2 from "@/Components/MyComponents/Back2.vue";

export default {
data() {
    return {

    }
},
components:{
    Back2,
    Head
},
props:{
    component: Object
},
methods:{
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