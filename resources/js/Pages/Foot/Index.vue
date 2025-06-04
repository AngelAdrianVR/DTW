<template>
    <AppLayout title="TPSP">
        <main class="mx-2 md:mx-12 mt-4">
            <!-- Estado de carga -->
            <div v-if="loadingDeliveryHistory" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
                <div class="w-16 h-16 border-4 border-gray-300 border-t-4 border-t-white rounded-full animate-spin"></div>
            </div>
            <header class="flex justify-between items-center">
                <h1 class="font-bold text-lg">
                    Gestión de inventario
                </h1>
                 <el-dropdown trigger="click" split-button type="primary" @click="showMovementModal = true">
                    Movimientos
                    <template #dropdown>
                        <el-dropdown-menu>
                            <el-dropdown-item @click="showNewProductionModal = true">Nueva producción</el-dropdown-item>
                            <el-dropdown-item @click="showDeliveryProductionModal = true">Registrar entrega</el-dropdown-item>
                            <el-dropdown-item @click="handleDeliveryHistory()">Historial de entregas</el-dropdown-item>
                        </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </header>
            <body class="mt-7 md:mx-10">
                <section v-for="kit in Object.values(kits.kits)" :key="kit.name" class="border rounded-2xl shadow-lg p-5 mb-7">
                    <article class="md:flex items-center justify-between bg-white shadow-md rounded-lg p-4">
                        <p :class="kit.goal > 0 ? 'text-blue-500' : 'text-gray-500'" class="text-center md:text-left font-bold md:hidden">
                            {{ kit.goal > 0 ? 'En curso' : 'Sin pedido' }}
                        </p>
                        <div class="mt-2 w-full">
                            <div v-if="kit.goal > 0" class="flex items-center justify-between space-x-3">
                                <div class="w-full">
                                    <div class="relative w-full h-5 bg-gray-200 rounded-full overflow-hidden border border-gray-300">
                                        <div 
                                            class="absolute top-0 left-0 h-full transition-all duration-500 rounded-full"
                                            :class="{
                                                'bg-red-400': getProgress(kit) < 50,
                                                'bg-amber-400': getProgress(kit) >= 50 && getProgress(kit) < 80,
                                                'bg-green-400': getProgress(kit) >= 80
                                            }"
                                            :style="{ width: getProgress(kit) + '%' }"
                                        ></div>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-700 text-right mt-1 font-bold">{{ getProgress(kit) }}%</p>
                            </div>
                            <p :class="kit.goal > 0 ? 'text-blue-500' : 'text-gray-500'" class="text-center md:text-left font-bold hidden md:block">
                                {{ kit.goal > 0 ? 'En curso' : 'Sin pedido' }}
                            </p>
                            <p class="font-bold mt-3">Meta: <span class="font-thin">{{ formattedNumber(kit.goal) }} Kits</span></p>
                            <p class="font-bold">Producción actual: <span class="font-thin">{{ formattedNumber(kit.current_production) }} kits</span></p>
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
                                        <img v-else-if="product.name === 'Campo' || product.name === 'Algodón'" src="assets/images/campo_bag.png" alt="">
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
                        <InputLabel value="Tipo de kit" />
                        <el-select v-model="form.kitType" placeholder="Selecciona el tipo de kit">
                            <el-option
                                v-for="item in Object.keys(kits.kits)"
                                :key="item"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                        <InputError :message="form.errors.kitType" />
                    </div>
                    <div>
                        <InputLabel value="Producto" />
                        <el-select v-model="form.product" placeholder="Selecciona el producto">
                            <el-option
                                v-for="item in kits.kits[form.kitType]?.products"
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

                <section v-else class="mx-2">
                    <div>
                        <InputLabel value="Tipo de kit" />
                        <el-select v-model="form.kitType" placeholder="Selecciona el tipo de kit">
                            <el-option
                                v-for="item in Object.keys(kits.kits)"
                                :key="item"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                        <InputError :message="form.errors.kitType" />
                    </div>
                    <article class="flex items-center space-x-3 pt-4">
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
                    </article>
                </section>
            </template>

            <template #footer>
                <PrimaryButton :disabled="form.processing" @click="storeMovement()">Registrar</PrimaryButton>
            </template>
        </DialogModal>

        <!-- Modal de nueva producción -->
        <DialogModal :show="showNewProductionModal" @close="showNewProductionModal = false">
            <template #title>
                <div class="flex justify-between items-center my-3">
                    <h2 class="text-lg font-bold">Comenzar nueva producción</h2>
                    <button class="flex items-center justify-center cursor-default rounded-full size-7 hover:bg-gray-200 hover:text-red-600" @click="showNewProductionModal = false">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </template>

            <template #content>
                <section class="space-y-3">
                    <div>
                        <InputLabel value="Tipo de kit" />
                        <el-select v-model="formNewProduction.kitType" placeholder="Selecciona el tipo de kit">
                            <el-option
                                v-for="item in Object.keys(kits.kits)"
                                :key="item"
                                :label="item"
                                :value="item"
                            />
                        </el-select>
                        <InputError :message="formNewProduction.errors.kitType" />
                    </div>
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
                <PrimaryButton :disabled="!formNewProduction.goal || formNewProduction.processing" @click="storeNewProduction()">Comenzar producción</PrimaryButton>
            </template>
        </DialogModal>

        <!-- Modal de entrega de producción -->
        <DialogModal :show="showDeliveryProductionModal" @close="showDeliveryProductionModal = false">
            <template #title>
                <div class="flex justify-between items-center my-3">
                    <h2 class="text-lg font-bold">Registrar entrega de producción semanal</h2>
                    <button class="flex items-center justify-center cursor-default rounded-full size-7 hover:bg-gray-200 hover:text-red-600" @click="showDeliveryProductionModal = false">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </template>

            <template #content>
                <section class="grid grid-cols-2 gap-3">
                    <div class="col-span-full">
                        <InputLabel value="Tipo de kit" />
                        <el-select v-model="deliveryKit.kitType" placeholder="Selecciona el tipo de kit">
                            <el-option v-for="item in kitTypes" :key="item.label" :value="item.label">
                                <div class="flex items-center space-x-2">
                                    <i class="fa-solid fa-circle text-[9px]" :class="item.color"></i>
                                    <span>{{ item.label }}</span>
                                </div>
                            </el-option>
                        </el-select>
                        <!-- <InputError :message="formDeliveryProduction.errors.kitType" /> -->
                    </div>
                    <div>
                        <InputLabel value="Cantidad de kits entregados" />
                        <el-input
                            v-model="deliveryKit.amount"
                            placeholder="Ej.10,000"
                            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                        />
                        <!-- <InputError :message="formDeliveryProduction.errors.amount" /> -->
                    </div>
                    <div>
                        <InputLabel value="Precio por kit" />
                        <el-input
                            v-model="deliveryKit.price"
                            placeholder="Ej.0.40"
                            :formatter="(value) => `${value}`.replace(/\B(?=(\d{3})+(?!\d))/g, ',')"
                            :parser="(value) => value.replace(/\$\s?|(,*)/g, '')"
                        />
                        <!-- <InputError :message="formDeliveryProduction.errors.price" /> -->
                    </div>
                    <section class="col-span-full my-2">
                        <div class="flex justify-end">
                            <button @click="addKitDelivery" :disabled="!deliveryKit.kitType || !deliveryKit.amount || !deliveryKit.price" 
                                    class="rounded-md border px-4 py-2 text-sm disabled:cursor-not-allowed disabled:bg-gray-200 active:scale-95">
                                {{ editIndex !== null ? 'Actualizar' : 'Agregar a lista' }}
                            </button>
                        </div>

                        <ol v-if="formDeliveryProduction.deliveryKits?.length"
                            class="rounded-lg bg-gray-200 px-5 py-3 col-span-full space-y-1 mt-3 divide-y-[1px]">
                            <template v-for="(item, index) in formDeliveryProduction.deliveryKits" :key="index">
                                <li class="flex justify-between border-[#999999] items-center py-1">
                                    <p class="text-xs text-black">
                                        <span class="text-primary">{{ index + 1 }}. </span>
                                        <span>{{ item.kitType }} => </span>
                                        <span>{{ item.amount?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }} pzas. => </span>
                                        <span>${{ item.price }} c/p</span>                                        
                                    </p>
                                    <div class="flex space-x-2 items-center">
                                        <el-tag v-if="editIndex == index" @close="editIndex = null; resetKitDeliveryForm()" closable>
                                            En edición
                                        </el-tag>
                                        <button @click="editKitDelivery(index)" type="button"
                                            class="size-7 bg-indigo-100 border border-primary rounded-full flex items-center justify-center text-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg>
                                        </button>
                                        <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#0355B5"
                                            title="¿Continuar?" @confirm="deleteKitDelivery(index)">
                                            <template #reference>
                                                <button type="button"
                                                    class="size-7 bg-indigo-100 border border-primary rounded-full flex items-center justify-center text-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </template>
                                        </el-popconfirm>
                                    </div>
                                </li>
                            </template>
                        </ol>
                    </section>
                    <div>
                        <InputLabel value="Fecha de entrega" />
                        <el-date-picker
                            v-model="formDeliveryProduction.delivered_at"
                            type="date"
                            placeholder="Selecciona la fecha en que se entregó"
                        />
                        <InputError :message="formDeliveryProduction.errors.delivered_at" />
                    </div>
                    <div class="col-span-full">
                        <InputLabel value="Notas" />
                        <el-input
                            v-model="formDeliveryProduction.notes"
                            :rows="2"
                            maxlength="255"
                            show-word-limit
                            type="textarea"
                            placeholder="Notas de la entrega"
                        />
                    </div>
                </section>
            </template>

            <template #footer>
                <PrimaryButton :disabled="!formDeliveryProduction.deliveryKits.length || formDeliveryProduction.processing" @click="storeDeliveryProduction()">Registrar entrega</PrimaryButton>
            </template>
        </DialogModal>

        <!-- Modal de historial de entregas -->
        <DialogModal :show="showDeliveryHistoryModal" @close="showDeliveryHistoryModal = false">
            <template #title>
                <div class="flex justify-between items-center my-3">
                    <h2 class="text-lg font-bold">Historial de entregas</h2>
                    <button class="flex items-center justify-center cursor-default rounded-full size-7 hover:bg-gray-200 hover:text-red-600"
                        @click="showDeliveryHistoryModal = false">
                        <i class="fa-solid fa-xmark text-sm"></i>
                    </button>
                </div>
            </template>

            <template #content>
                <div class="max-h-[500px] overflow-auto" v-if="Object.keys(deliveryHistory).length > 0">
                    <!-- Sección de totales de kits -->
                    <div class="mt-5 p-4 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">Totales por tipo de kit</h3>
                        <table class="w-full text-sm text-gray-600 mt-2">
                            <thead>
                                <tr class="text-left border-b">
                                    <th class="py-2">Kit</th>
                                    <th class="py-2">Cantidad Total</th>
                                    <th class="py-2">Total en $</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(data, kit) in totalByKit" :key="kit" class="border-t">
                                    <td class="py-2">{{ kit }}</td>
                                    <td class="py-2">{{ data.total_amount.toLocaleString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>
                                    <td class="py-2">${{ data.total_price.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div v-for="(deliveries, date) in deliveryHistory" :key="date" class="mb-5">
                        <h3 class="text-lg font-semibold text-gray-700 border-b pb-2">{{ formatDate(date) }}</h3>
                        <div class="bg-gray-100 rounded-lg p-3 mt-2">
                            <table class="w-full text-sm text-gray-600">
                                <thead>
                                    <tr class="text-left">
                                        <th class="py-2">Kit</th>
                                        <th class="py-2">Cantidad</th>
                                        <th class="py-2">Precio</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(delivery, index) in deliveries" :key="index" class="border-t">
                                        <td class="py-2">{{ delivery.kit_type }}</td>
                                        <td class="py-2">{{ delivery.amount.toLocaleString() }}</td>
                                        <td class="py-2">${{ delivery.price.toFixed(2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <p v-else class="text-gray-500 text-center">No hay entregas registradas.</p>
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
import axios from 'axios';

export default {
data() {
    const form = useForm({
        kitType: null, //Tipo de kit seleccionado
        product: null, //producto seleccionado para movimiento
        quantity: null, //cantidad de producto
        bagsQuantity: null, //cantidad de bolsas de empaque
        movementType: 'Entrada de producto',
    });

    const formNewProduction = useForm({
        kitType: null, //Tipo de kit seleccionado
        goal: null, //cantidad total de kits a producir
        current_production: 0, //cantidad total de kits producidos
    });
    
    const formDeliveryProduction = useForm({
        deliveryKits: [], // informacion de cada tipo de kit
        delivered_at: null, // fecha de entrega
        notes: null, // Notas de la entrega
    });

    return {
        // Formularios
        form,
        formNewProduction,
        formDeliveryProduction,

        // formulario de registro de entrega
        editIndex: null, //index de lista de entrega de kit
        deliveryKit: {
            kitType: null,
            amount: null,
            price: null,
        },

        //general
        loadingDeliveryHistory: false, // estado de carga 
        showMovementModal: false, //modal de movimientos
        showNewProductionModal: false, //modal de producción nueva
        showDeliveryProductionModal: false, //modal de entrega de producción
        showDeliveryHistoryModal: false, //modal de historial de entregas
        deliveryHistory: null, //historial de entregas
        totalByKit: null, // totales de kits    
        options: [
            'Entrada de producto',
            'Salida de producto',
            'Registrar producción'
        ],
        kitTypes: [
            {
                label: 'Pedicure Experto',
                color: 'text-[#00214c]',
            },
            {
                label: 'Manicure Experto',
                color: 'text-[#4f5052]',
            },
            {
                label: 'Pedicure Correctivo',
                color: 'text-[#0095ca]',
            },
            {
                label: 'Pedicure Infantil',
                color: 'text-[#cb3c02]',
            },
            {
                label: 'Masaje Antiestrés',
                color: 'text-[#009947]',
            },
            {
                label: 'Campo/Protector',
                color: 'text-gray-300',
            },
            {
                label: 'Campo',
                color: 'text-gray-100',
            },
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
    getProgress(kit) {
        return kit.goal > 0 ? Math.min(100, Math.round((kit.current_production / kit.goal) * 100)) : 0;
    },
    formattedNumber(num) {
        return num?.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") || "0";
    },
    async handleDeliveryHistory() {
        if ( !this.deliveryHistory ) {
           await this.fetchDeliveryHistory();
        }
        this.showDeliveryHistoryModal = true;
    },
    formatDate(dateString) {
        const date = new Date(dateString);
        return new Intl.DateTimeFormat('es-MX', { day: '2-digit', month: 'short', year: 'numeric' }).format(date);
    },
    addKitDelivery() {
        const kitType = { ...this.deliveryKit };

        if (this.editIndex !== null) {
            this.formDeliveryProduction.deliveryKits[this.editIndex] = kitType;
            this.editIndex = null;
        } else {
            this.formDeliveryProduction.deliveryKits.push(kitType);
        }

        this.resetKitDeliveryForm();
    },
    deleteKitDelivery(index) {
        this.formDeliveryProduction.deliveryKits.splice(index, 1);
    },
    editKitDelivery(index) {
        const kitType = { ...this.formDeliveryProduction.deliveryKits[index] };
        this.deliveryKit = kitType;
        this.editIndex = index;
    },
    resetKitDeliveryForm() {
        this.deliveryKit.kitType = null;
        this.deliveryKit.amount = null;
        this.deliveryKit.price = null;
    },
    getRemainingProduction(kit) {
        return (Number(kit.goal) || 0) - (Number(kit.current_production) || 0);
    },
    handleRemainingProduct(product, kit) {
        const remaining = this.getRemainingProduction(kit);

        if (product.name === 'Bolsa grande empaque azúl' || product.name === 'Bolsa grande empaque transparente') {
            return ((product.quantity * 50) >= remaining) && product.quantity > 0;
        } else {
            // retorna true si hay mas cantidad de stock que la meta
            return product.quantity >= remaining && product.quantity > 0;
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
    },   
    storeDeliveryProduction() {
        this.formDeliveryProduction.post(route("tpsp-deliveries.store"), {
            onSuccess: () => {
                this.$notify({
                    title: "Correcto",
                    message: "",
                    type: "success",
                });
                this.fetchDeliveryHistory();
                this.showDeliveryProductionModal = false;
            }
        });
    },
    async fetchDeliveryHistory() {
        try {
            this.loadingDeliveryHistory = true;

            const response = await axios.get(route('tpsp-deliveries.fetch-data'));

            // Guardamos los datos en las variables correspondientes
            this.deliveryHistory = response.data.deliveries_by_date; // Historial de entregas agrupado por fecha
            this.totalByKit = response.data.total_by_kit; // Totales de cada tipo de kit
        } catch (error) {
            console.error('Error al obtener el historial de entregas', error);
        } finally {
            this.loadingDeliveryHistory = false;
        }
    }
}
}
</script>