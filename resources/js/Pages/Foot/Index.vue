<template>
    <AppLayout title="TPSP">
        <main class="mx-2 md:mx-12 mt-4">
            <header class="flex justify-between items-center">
                <h1 class="font-bold text-lg">
                    Gestión de inventario
                </h1>
                <PrimaryButton @click="showMovementModal = true">Movimientos</PrimaryButton>
            </header>

            <body class="mt-7 mx-10">
                <section class="border border-gray-200 rounded-xl p-5">
                    <div class="ml-5">
                        <p class="font-bold">Meta: <span class="font-thin">{{ kits.kits.pedicureExpert.goal?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</span> kits</p>
                        <p class="font-bold">Producción actual: <span class="font-thin">{{ kits.kits.pedicureExpert.current_production?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</span> kits</p>
                        <p class="font-bold">Tipo de kit: <span class="font-thin">{{ kits.kits.pedicureExpert.name }}</span></p>
                    </div>

                    <article class="mt-7 grid md:grid-cols-4 lg:grid-cols-6 gap-4">
                        <!-- tarjeta de producto -->
                        <div v-for="product in kits.kits.pedicureExpert.products" :key="product" class="border border-[#D9D9D9] rounded-2xl p-2 text-center">
                            <h2 class="mt-2">{{ product.name }}</h2>
                            <p class="text-sm text-[#373737] mt-3">Actual</p>
                            <p class="text-lg font-bold mb-3">{{ product.quantity?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} pzas</p>

                            <div :class="(product.quantity >= remainingProduction) ? 'bg-[#D1FDC8]' : 'bg-[#FDC8C8]'" class="rounded-2xl h-[137px] text-center py-3 px-2">

                                <div v-if="product.quantity >= remainingProduction" class="flex flex-col justify-center items-center">
                                    <p class="text-[#373737] my-2">Hay suficiente stock</p>
                                    <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.78015 26.087C5.42528 19.3455 0.305954 13.9834 0.0163438 13.665C-0.273266 13.3465 3.31596 12.7419 8.40125 18.0127C18.0408 7.09938 27.3856 -0.029221 32.6243 0.000669781C32.8261 -0.0198912 33.1358 0.438406 32.9349 0.621774C21.3361 6.14443 14.9155 15.957 9.33291 26.087C9.29922 26.394 7.76682 26.333 7.78015 26.087Z" fill="#189203"/>
                                    </svg>
                                </div>

                                <div v-else>
                                    <p class="text-[#373737] my-2">Piezas faltantes para meta</p>
                                    <p class="font-bold text-lg">
                                        {{ remainingProduction?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} pzas
                                    </p>

                                    <figure class="flex justify-end items-center">
                                        <span class="mr-1">
                                            <!-- Calcular empaques necesarios -->
                                            {{ 
                                                product.name === 'Bolsa grande empaque' 
                                                ? Math.ceil(remainingProduction / 50) 
                                                : Math.ceil(remainingProduction / product.package_units) 
                                            }}
                                        </span>

                                        <!-- Mostrar imágenes según el tipo de producto -->
                                        <img 
                                            v-if="product.name === 'Bálsamo' || product.name === 'Reblandecedor' || product.name === 'Loción'" 
                                            src="assets/images/box.png" 
                                            alt=""
                                        >
                                        <img 
                                            v-if="product.name === 'Protector'" 
                                            src="assets/images/bag.png" 
                                            alt=""
                                        >
                                        <img 
                                            v-if="product.name === 'Campo'" 
                                            src="assets/images/campo_bag.png" 
                                            alt=""
                                        >
                                        <img 
                                            v-if="product.name === 'Navaja 2mm'" 
                                            src="assets/images/knife_box.png" 
                                            alt=""
                                        >
                                        <img 
                                            v-if="product.name === 'Bolsa kit'" 
                                            src="assets/images/kit_bag.png" 
                                            alt=""
                                        >
                                        <img 
                                            v-if="product.name === 'Bolsa grande empaque'" 
                                            src="assets/images/bag_big.png" 
                                            alt=""
                                        >
                                    </figure>
                                </div>

                            </div>
                        </div>
                    </article>
                </section>
                
            </body>

        </main>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
data() {
    return {
        showMovementModal: false,

    };
},
components:{
    PrimaryButton,
    AppLayout
},
props:{
    kits: Array,
},
methods:{

},
computed:{
    remainingProduction(){
        return this.kits.kits.pedicureExpert.goal - this.kits.kits.pedicureExpert.current_production;
    }
}
}
</script>
