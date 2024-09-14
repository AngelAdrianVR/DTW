<template>
    <main>
        <!-- desktop testimoinies -->
        <div class="hidden lg:grid grid-cols-2 gap-9">
            <div v-for="(testimony, index) in testimoniesInfo" :key="index"
                class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2">
                <div class="grid grid-cols-4 gap-x-2 text-white">
                    <div class="flex-col space-y-2 items-center justify-center">
                        <figure class="rounded-full w-16 h-16">
                            <img :src="testimony.imgPath" />
                        </figure>
                        <span>{{ testimony.name }}</span>
                    </div>
                    <div class="col-span-3">
                        <p>{{ language === 'english' ? testimony.EnglishText : testimony.text }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- testimonies mobil -->
        <section class="lg:hidden lg:mx-24 mx-1 mt-9 relative">
            <div class="lg:grid grid-cols-2 gap-9">
                <div class="bg-[#262626] rounded-[30px] px-8 py-16 mt-2 flex text-white">
                    <div @click="currentTestimony = currentTestimony == 0 ? (testimoniesInfo.length - 1) : currentTestimony - 1"
                        class="w-8 mr-2 flex justify-center items-center">
                        <button>
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </div>
                    <div class="w-full">
                        <div class="flex-col space-y-2 items-center justify-center mb-3">
                            <figure class="rounded-full w-16 h-16 mx-auto">
                                <img :src="testimoniesInfo[currentTestimony].imgPath" />
                            </figure>
                            <p class="text-center">{{ testimoniesInfo[currentTestimony].name }}</p>
                        </div>
                        <div class="col-span-3 text-justify">
                            <p>{{ testimoniesInfo[currentTestimony].text }}</p>
                        </div>
                    </div>
                    <div @click="currentTestimony = currentTestimony == (testimoniesInfo.length - 1) ? 0 : currentTestimony + 1"
                        class="w-8 ml-2 flex justify-center items-center">
                        <button>
                            <i class="fa-solid fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script>
import e3dtest from '@/../../public/assets/images/e3dtest.png';
import churrotest from '@/../../public/assets/images/churrotest.png';
import profibratest from '@/../../public/assets/images/profibratest.png';

export default {
data() {
    return {
        currentTestimony: 0,
        testimoniesInfo: [
            {
                imgPath: e3dtest,
                name: 'J. Sherman',
                text: 'El sistema ERP desarrollado por DTW ha transformado por completo la forma en que gestionamos nuestro negocio. La solución personalizada se adaptó perfectamente a nuestras operaciones y nos ha permitido optimizar nuestros procesos, mejorar la visibilidad y tomar decisiones informadas en tiempo real.',
                EnglishText: 'The ERP system developed by DTW has completely transformed the way we run our business. The custom solution was a perfect fit for our operations and has allowed us to streamline our processes, improve visibility and make informed decisions in real time.'
            },
            {
                imgPath: churrotest,
                name: 'Rocio R.',
                text: 'Quiero agradecer al equipo de DTW por su creatividad y profesionalismo al crear mi sitio web. Han logrado plasmar perfectamente la visión que tenía en mente y han superado mis expectativas.',
                EnglishText: 'I would like to thank the DTW team for their creativity and professionalism in creating my website. They have perfectly captured the vision I had in mind and have exceeded my expectations.'
            },
            {
                imgPath: profibratest,
                name: 'Jose Ricardo',
                text: 'Recomiendo ampliamente el trabajo de DTW, se adapta a lo que necesites e inclusive recomienda mejoras, siempre atententos a todas las dudas que se tenga, y también a cualquier cambio que necesites. Ampliamente recomendado.',
                EnglishText: "I highly recommend DTW's work, they adapt to what you need and even recommend improvements, always attentive to any questions you may have, and also to any changes you may need. Highly recommended."
            },
        ],
    }
},
props:{
    language:{
      type: String,
      default: 'spanish'
    }
}
}
</script>
