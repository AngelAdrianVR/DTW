<template>
    <AppLayout title="TPSP">
        <main class="mx-2 md:mx-12 mt-4">
            <header class="flex justify-between items-center">
                <h1 class="font-bold text-lg">
                    Gestión de inventario
                </h1>
                <PrimaryButton @click="showMovementModal = true">Movimientos</PrimaryButton>
            </header>

            <body class="mt-7 md:mx-10">
                <section class="border border-gray-200 rounded-xl p-5">
                    <article class="flex items-center justify-between">
                        <div class="ml-5">
                            <p class="font-bold">Meta: <span class="font-thin">{{ kits.kits.pedicureExpert.goal?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</span> kits</p>
                            <p class="font-bold">Producción actual: <span class="font-thin">{{ kits.kits.pedicureExpert.current_production?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</span> kits</p>
                            <p class="font-bold">Tipo de kit: <span class="font-thin">{{ kits.kits.pedicureExpert.name }}</span></p>
                        </div>

                        <button @click="showNewProductionModal = true" class="button">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="20"
                                viewBox="0 0 20 20"
                                height="20"
                                fill="none"
                                class="svg-icon"
                            >
                                <g stroke-width="1.5" stroke-linecap="round" stroke="#435AA4">
                                <path
                                    d="m3.33337 10.8333c0 3.6819 2.98477 6.6667 6.66663 6.6667 3.682 0 6.6667-2.9848 6.6667-6.6667 0-3.68188-2.9847-6.66664-6.6667-6.66664-1.29938 0-2.51191.37174-3.5371 1.01468"
                                ></path>
                                <path
                                    d="m7.69867 1.58163-1.44987 3.28435c-.18587.42104.00478.91303.42582 1.0989l3.28438 1.44986"
                                ></path>
                                </g>
                            </svg>
                            <span class="lable">Nueva producción</span>
                        </button>

                    </article>

                    <article class="mt-7 grid md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                        <!-- tarjeta de producto -->
                        <div v-for="product in kits.kits.pedicureExpert.products" :key="product" class="border border-[#D9D9D9] rounded-2xl p-2 text-center">
                            <h2 class="mt-2">{{ product.name }}</h2>
                            <p class="text-sm text-[#373737] mt-3">Actual</p>
                            <p class="text-lg font-bold mb-3">{{ product.quantity?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} pzas</p>

                            <div :class="handleRemainingProduct(product) ? 'bg-[#D1FDC8]' : 'bg-[#FDC8C8]'" class="rounded-2xl h-[137px] text-center py-3 px-2">

                                <div v-if="handleRemainingProduct(product)" class="flex flex-col justify-center items-center">
                                    <p class="text-[#373737] my-2">Hay suficiente stock</p>
                                    <svg width="33" height="27" viewBox="0 0 33 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.78015 26.087C5.42528 19.3455 0.305954 13.9834 0.0163438 13.665C-0.273266 13.3465 3.31596 12.7419 8.40125 18.0127C18.0408 7.09938 27.3856 -0.029221 32.6243 0.000669781C32.8261 -0.0198912 33.1358 0.438406 32.9349 0.621774C21.3361 6.14443 14.9155 15.957 9.33291 26.087C9.29922 26.394 7.76682 26.333 7.78015 26.087Z" fill="#189203"/>
                                    </svg>
                                </div>

                                <div v-else>
                                    <p class="text-[#373737] my-2">Piezas faltantes para meta</p>
                                    <p class="font-bold text-lg">
                                        {{ product.name === 'Bolsa grande empaque'
                                            ? ((remainingProduction - (product.quantity * 50)) / 50)?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                                            : (remainingProduction - product.quantity)?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") 
                                        }} pzas
                                    </p>

                                    <figure class="flex justify-end items-center">
                                        <span class="mr-1">
                                            <!-- Calcular empaques necesarios -->
                                            {{ 
                                                product.name === 'Bolsa grande empaque' 
                                                ? Math.ceil((remainingProduction - (product.quantity * 50)) / 50) 
                                                : Math.ceil((remainingProduction - product.quantity) / product.package_units) 
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

        <!-- Modal de movimientos -->
        <DialogModal :show="showMovementModal" @close="showMovementModal = false">
            <template #title>
                <div class="flex justify-between items-center my-3">
                    <h2 class="text-lg font-bold">Movimientos de producto</h2>
                    <button class="flex items-center justify-center cursor-default rounded-full size-7 hover:bg-gray-200 hover:text-red-600" @click="showMovementModal = false">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
                <el-segmented @change="resetValues()" v-model="form.movementType" :options="options" block />
            </template>

            <template #content>
                <section v-if="form.movementType !='Registrar producción'" class="pt-4 space-y-3">
                    <div>
                        <InputLabel value="Producto" />
                        <el-select v-model="form.product" placeholder="Selecciona el producto">
                            <el-option
                                v-for="item in kits.kits.pedicureExpert.products"
                                :key="item"
                                :label="item.name"
                                :value="item.name"
                            />
                        </el-select>
                        <InputError :message="form.errors.product" />
                    </div>
                    <div>
                        <InputLabel value="Cantidad" />
                        <el-input
                            v-model="form.quantity"
                            placeholder="Cantidad de producto"
                            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                        />
                        <InputError :message="form.errors.quantity" />
                    </div>
                </section>

                <section v-else class="pt-4 mx-2 flex items-center space-x-3">
                    <div class="w-1/2">
                        <InputLabel value="Cantidad de bolsas" />
                        <div class="flex items-center space-x-2">
                            <el-input
                                class="!w-40 md:!w-56"
                                v-model="form.bagsQuantity"
                                placeholder="Bolsas de empaque"
                                :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                                :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                            />
                            <span>x50</span>
                            <InputError :message="form.errors.bagsQuantity" />  
                        </div>
                    </div>
                    <div class="text-center w-1/2">
                        <p>Total de kits</p>
                        <span class="font-bold">{{ (form.bagsQuantity * 50)?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</span>
                    </div>
                </section>
            </template>

            <template #footer>
                <PrimaryButton @click="storeMovement()">Registrar</PrimaryButton>
            </template>
        </DialogModal>

        <!-- Modal de nueva producción -->
        <DialogModal :show="showNewProductionModal" @close="showNewProductionModal = false">
            <template #title>
                <div class="flex justify-between items-center my-3">
                    <h2 class="text-lg font-bold">comenzar nueva producción</h2>
                    <button class="flex items-center justify-center cursor-default rounded-full size-7 hover:bg-gray-200 hover:text-red-600" @click="showNewProductionModal = false">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </template>

            <template #content>
                <section class="space-y-3">
                    <div>
                        <InputLabel value="Cantidad meta de kits" />
                        <el-input
                            v-model="formNewProduction.goal"
                            placeholder="Meta de nueva producción"
                            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                        />
                    </div>
                    <div>
                        <InputLabel value="Cantidad de kits producidos" />
                        <el-input
                            v-model="formNewProduction.current_production"
                            placeholder="Meta de nueva producción"
                            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                        />
                    </div>
                </section>
            </template>

            <template #footer>
                <PrimaryButton :disabled="!formNewProduction.goal" @click="storeNewProduction()">Comenzar producción</PrimaryButton>
            </template>
        </DialogModal>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import DialogModal from '@/Components/DialogModal.vue';
import { useForm } from "@inertiajs/vue3";

export default {
data() {
    const form = useForm({
        product: null, //producto seleccionado para movimiento
        quantity: null, //cantidad de producto
        bagsQuantity: null, //cantidad de bolsas de empaque
        movementType: 'Entrada de producto',
    });

    const formNewProduction = useForm({
        goal: null, //cantidad total de kits a producir
        current_production: 0, //cantidad total de kits producidos
    });

    return {
        form,
        formNewProduction,
        showMovementModal: false, //modal de movimientos
        showNewProductionModal: false, //modal de producción nueva
        options: [
            'Entrada de producto',
            'Salida de producto',
            'Registrar producción'
        ],
    };
},
components:{
    PrimaryButton,
    DialogModal,
    InputLabel,
    InputError,
    AppLayout,
},
props:{
    kits: Object,
},
methods:{
    handleRemainingProduct(product) {
        if ( product.name === 'Bolsa grande empaque' ) {
            return (product.quantity * 50) >= this.remainingProduction;
        } else {
            return product.quantity >= this.remainingProduction;
        }
    },
    resetValues() {
        this.form.product = null;
        this.form.quantity = null;
        this.form.bagsQuantity = null;
    },
    storeMovement() {
        this.form.post(route("tpsp.store-movement"), {
            onSuccess: () => {
                this.$notify({
                    title: "Correcto",
                    message: "",
                    type: "success",
                });
                this.showMovementModal = false;
                this.resetValues();
            }
        });
    },
    storeNewProduction() {
        this.formNewProduction.post(route("tpsp.store-new-production"), {
            onSuccess: () => {
                this.$notify({
                    title: "Correcto",
                    message: "",
                    type: "success",
                });
                this.showNewProductionModal = false;
            }
        });
    }   
},
computed:{
    remainingProduction(){
        return this.kits.kits.pedicureExpert.goal - this.kits.kits.pedicureExpert.current_production;
    },
}
}
</script>

<style>
.custom-style .el-segmented {
  --el-segmented-item-selected-color: #000;
  --el-segmented-bg-color: #F2F2F2;
  --el-segmented-item-selected-bg-color: #fff;
  --el-border-radius-base: 10px;
  --el-segmented-item-selected-border-color: #D9D9D9;
}

/* From Uiverse.io by andrew-demchenk0 */ 
.button {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 6px 12px;
  gap: 8px;
  height: 28px;
  width: 200px;
  border: none;
  background: #9eb4fc;
  border-radius: 20px;
  cursor: pointer;
}

.lable {
  line-height: 20px;
  font-size: 14px;
  color: #435AA4;
  letter-spacing: 1px;
}

.button:hover {
  background: #c3d1ff;
}

.button:hover .svg-icon {
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(-360deg);
  }
}

</style>
