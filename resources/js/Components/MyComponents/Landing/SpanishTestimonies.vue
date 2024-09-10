<template>
    <main>
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
    </main>
</template>

<script>
import e3dtest from '@/../../public/assets/images/e3dtest.png';
import churrotest from '@/../../public/assets/images/churrotest.png';
import profibratest from '@/../../public/assets/images/profibratest.png';

export default {
data() {
    return {
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
    }
}
}
</script>
