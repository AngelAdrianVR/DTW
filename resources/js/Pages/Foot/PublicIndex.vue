<template>
<Head title="Inventario kits" />
        <main class="mx-2 md:mx-12 mt-4">
            <header class="flex justify-between items-center">
                <h1 class="font-bold text-lg">
                    Gestión de inventario
                </h1>
            </header>

            <body class="mt-7 md:mx-10">
                <section v-for="kit in Object.values(kits.kits)" :key="kit.name" class="border border-gray-200 rounded-2xl shadow-lg p-5 mb-7">
                    <article class="md:flex items-center justify-between">
                        <div class="ml-5">
                            <p class="font-bold">Meta: <span class="font-thin">{{ kit.goal?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} Kits</span></p>
                            <p class="font-bold">Producción actual: <span class="font-thin">{{ kit.current_production?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} kits</span></p>
                            <p class="font-bold">Tipo de kit: <span class="font-thin">{{ kit.name }}</span></p>
                        </div>

                        <figure class="flex justify-center mt-2">
                            <img v-if="kit.name === 'Pedicure Experto'" class="w-1/5 md:w-1/2" src="assets/images/pedicure_experto.png" alt="">
                            <img v-if="kit.name === 'Manicure Experto'" class="w-1/5 md:w-1/2" src="assets/images/manicure_experto.png" alt="">
                            <img v-if="kit.name === 'Masaje Antiestrés'" class="w-1/5 md:w-1/2" src="assets/images/masaje_antiestres.png" alt="">
                            <img v-if="kit.name === 'Pedicure Correctivo'" class="w-1/5 md:w-1/2" src="assets/images/pedicure_correctivo.png" alt="">
                            <img v-if="kit.name === 'Pedicure Infantil'" class="w-1/5 md:w-1/2" src="assets/images/pedicure_infantil.png" alt="">
                        </figure>
                    </article>

                    <!-- sección de stock -->
                    <article class="mt-7 flex overflow-x-auto md:grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                        <div v-for="product in kit.products" :key="product.name" class="border border-[#D9D9D9] rounded-2xl p-2 text-center shrink-0 w-52 md:w-auto">
                            <h2 class="mt-2">{{ product.name }}</h2>
                            <p class="text-sm text-[#373737] mt-3">Actual</p>
                            <p class="text-lg font-bold mb-3">
                                {{ product.quantity?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} pzas
                            </p>

                            <div :class="handleRemainingProduct(product, kit) ? 'bg-[#D1FDC8]' : 'bg-[#FDC8C8]'" 
                                class="rounded-2xl h-[137px] text-center py-3 px-2">
                                
                                <div v-if="handleRemainingProduct(product, kit)" class="flex flex-col justify-center items-center">
                                    <p class="text-[#373737] my-2">Hay suficiente stock</p>
                                    <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.78015 26.087C5.42528 19.3455 0.305954 13.9834 0.0163438 13.665C-0.273266 13.3465 3.31596 12.7419 8.40125 18.0127C18.0408 7.09938 27.3856 -0.029221 32.6243 0.000669781C32.8261 -0.0198912 33.1358 0.438406 32.9349 0.621774C21.3361 6.14443 14.9155 15.957 9.33291 26.087C9.29922 26.394 7.76682 26.333 7.78015 26.087Z" fill="#189203"/>
                                    </svg>
                                </div>

                                <div v-else>
                                    <p class="text-[#373737] my-2">Piezas faltantes para meta</p>
                                    <p class="font-bold text-lg">
                                        {{ product.name === 'Bolsa grande empaque'
                                            ? ((getRemainingProduction(kit) - (product.quantity * 50)) / 50)?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            : (getRemainingProduction(kit) - product.quantity)?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") 
                                        }} pzas
                                    </p>

                                    <figure class="flex justify-end items-center">
                                        <span class="mr-1">
                                            {{ 
                                                product.name === 'Bolsa grande empaque' 
                                                ? Math.ceil((getRemainingProduction(kit) - (product.quantity * 50)) / 50) 
                                                : Math.ceil((getRemainingProduction(kit) - product.quantity) / product.package_units) 
                                            }}
                                        </span>

                                        <img v-if="['Bálsamo', 'Reblandecedor', 'Loción', 'Reblandecedor líquido'].includes(product.name)" src="assets/images/box.png" alt="">
                                        <img v-else-if="product.name === 'Protector'" src="assets/images/bag.png" alt="">
                                        <img v-else-if="product.name === 'Campo'" src="assets/images/campo_bag.png" alt="">
                                        <img v-else-if="product.name === 'Navaja 20mm' || product.name === 'Navaja 15mm'" src="assets/images/knife_box.png" alt="">
                                        <img v-else-if="product.name === 'Bolsa kit'" src="assets/images/kit_bag.png" alt="">
                                        <img v-else-if="product.name === 'Bolsa grande empaque azúl'" src="assets/images/bag_big.png" alt="">
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </article>
                </section>
            </body>
        </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';

export default {

components:{
    Head
},
props:{
    kits: Object,
},
methods:{
    getRemainingProduction(kit) {
        // if (!kit || !kit.goal || !kit.current_production) return 0;
        return (Number(kit.goal) || 0) - (Number(kit.current_production) || 0);
    },
    handleRemainingProduct(product, kit) {
        const remaining = this.getRemainingProduction(kit);

        if (product.name === 'Bolsa grande empaque azúl' || product.name === 'Bolsa grande empaque transparente') {
            return (product.quantity * 50) >= remaining;
        } else {
            return product.quantity >= remaining;
        }
    },
},
}
</script>

