<template>
    <AppLayout title="Cotizaciones">
        <div class="mx-2 md:mx-12 mt-4">
            <header>
                <h1 class="font-bold text-lg flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>
                    <span>Cotizaciones</span>
                </h1>
                <!-- Buscador -->
                <div class="flex flex-col lg:flex-row justify-between space-y-3 space-x-3 lg:items-center mt-4">
                    <SearchInput @search="handleSearch" />
                    <el-tag v-if="search" size="large" closable @close="handleTagClose">
                        Estas buscando: <b>{{ search }}</b>
                    </el-tag>
                    <PrimaryButton @click="$inertia.visit(route('quotes.create'))">Crear cotización</PrimaryButton>
                </div>
            </header>
            <main>
                <Loading v-if="loading" class="mt-20" />
                <article v-else-if="localItems.length" class="w-full mt-7">
                    <div class="mb-4">
                        <p class="text-gray66 text-[11px]">
                            {{ localItems.length }} de {{ localTotalItems }} elementos
                        </p>
                    </div>
                    <div class="overflow-auto h-full">
                        <table class="w-full">
                            <thead>
                                <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
                                    <th>Folio</th>
                                    <th>Nombre</th>
                                    <th>Cliente / prospecto</th>
                                    <th>Contacto</th>
                                    <th>Creado por</th>
                                    <th>Creado el</th>
                                    <th>Costo</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr @click="$inertia.visit(route('quotes.show', item))" v-for="item in localItems"
                                    :key="item.id" class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
                                    <td class="rounded-s-full">
                                        <p class=" flex items-center space-x-1">
                                            <el-tooltip v-if="item.rejected_at" placement="top"
                                                :content="'Rechazado por cliente el ' + formatDateTime(item.sent_at)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-[14px] text-red-700">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </el-tooltip>
                                            <el-tooltip v-else-if="item.authorized_at" placement="top"
                                                :content="'Autorizado por cliente el ' + formatDateTime(item.sent_at)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-[14px] text-green-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>
                                            </el-tooltip>
                                            <el-tooltip v-else-if="item.sent_at" placement="top"
                                                :content="'Enviado al cliente el ' + formatDateTime(item.sent_at)">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor"
                                                    class="size-[14px] text-yellow-600">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </el-tooltip>
                                            <el-tooltip v-else placement="top"
                                                content="Sin enviar a cliente / prospecto">
                                                <i class="fa-solid fa-question size-[14px] text-red-600"></i>
                                            </el-tooltip>
                                            <span>{{ 'C-' + String(item.id).padStart(3, '0') }}</span>
                                        </p>
                                    </td>
                                    <td>{{ item.name }}</td>
                                    <td v-if="item.client_id !== null" class="flex items-center space-x-1">
                                        <el-tooltip content="Cliente" placement="left">
                                            <div class="flex items-center space-x-1">
                                                <i class="fa-solid fa-circle text-green-600 text-[7px]"></i>
                                                <span>{{ item.client.name }}</span>
                                            </div>
                                        </el-tooltip>
                                    </td>
                                    <td v-else class="flex items-center space-x-1">
                                        <el-tooltip content="Prospecto" placement="left">
                                            <div class="flex items-center space-x-1">
                                                <i class="fa-solid fa-circle text-blue-600 text-[7px]"></i>
                                                <span>{{ item.prospect.name }}</span>
                                            </div>
                                        </el-tooltip>
                                    </td>
                                    <td v-if="item.client_id !== null">{{ item.contact.name }}</td>
                                    <td v-else>{{ item.contact.name }}</td>
                                    <td>{{ item.user.name }}</td>
                                    <td>{{ formatDateTime(item.created_at) }}</td>
                                    <td>${{ item.total_cost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}</td>
                                    <td class="rounded-e-full text-end">
                                        <el-dropdown trigger="click" @command="handleCommand">
                                            <button @click.stop
                                                class="el-dropdown-link justify-center items-center size-6 hover:bg-primary hover:text-primarylight rounded-full text-primary transition-all duration-200 ease-in-out">
                                                <i class="fa-solid fa-ellipsis-vertical"></i>
                                            </button>
                                            <template #dropdown>
                                                <el-dropdown-menu>
                                                    <el-dropdown-item :command="'edit-' + item.id">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-[14px] mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                        </svg>
                                                        <span class="text-xs">Editar</span>
                                                    </el-dropdown-item>
                                                    <el-dropdown-item v-if="!item.sent_at && !item.authorized_at"
                                                        :command="'sent-' + item.id">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-[14px] mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                        </svg>
                                                        <span class="text-xs">Esperando respuesta</span>
                                                    </el-dropdown-item>
                                                    <el-dropdown-item v-if="!item.authorized_at"
                                                        :command="'auth-' + item.id">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-[14px] mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m4.5 12.75 6 6 9-13.5" />
                                                        </svg>
                                                        <span class="text-xs">Autorizado</span>
                                                    </el-dropdown-item>
                                                    <el-dropdown-item v-if="!item.rejected_at"
                                                        :command="'reje-' + item.id">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-[14px] mr-2">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18 18 6M6 6l12 12" />
                                                        </svg>
                                                        <span class="text-xs">Rechazado</span>
                                                    </el-dropdown-item>
                                                    <el-dropdown-item :command="'delete-' + item.id">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            class="size-[14px] mr-2 text-red-600">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                        <span class="text-xs text-red-600">Eliminar</span>
                                                    </el-dropdown-item>
                                                </el-dropdown-menu>
                                            </template>
                                        </el-dropdown>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-gray66 text-left mt-4 text-[11px]">
                        {{ localItems.length }} de {{ localTotalItems }} elementos
                    </p>
                    <p v-if="loadingItems" class="text-xs my-4 text-center">
                        Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-secondary"></i>
                    </p>
                    <button
                        v-else-if="localItems.length && !search && (localTotalItems > 30 && localItems.length < localTotalItems)"
                        @click="fetchItemsByPage" class="w-full text-secondary my-4 text-xs mx-auto underline ml-6">
                        Cargar más elementos
                    </button>
                </article>
                <el-empty v-else description="No hay cotizaciones para mostrar" />
            </main>

            <ConfirmationModal :show="showDeleteConfirm" @close="showDeleteConfirm = false">
                <template #title>
                    <h1>Eliminar cliente</h1>
                </template>
                <template #content>
                    <p>Se eliminará la cotización y no se podrá recuperar. ¿Continuar de todas formas?</p>
                </template>
                <template #footer>
                    <div class="flex items-center space-x-1">
                        <CancelButton @click="showDeleteConfirm = false">Cancelar</CancelButton>
                        <DangerButton @click="deleteItem">Eliminar</DangerButton>
                    </div>
                </template>
            </ConfirmationModal>
        </div>
    </AppLayout>
</template>

<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SearchInput from "@/Components/MyComponents/SearchInput.vue";
import ConfirmationModal from "@/Components/ConfirmationModal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import CancelButton from "@/Components/CancelButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { format } from 'date-fns';
import { es } from 'date-fns/locale';

export default {
    data() {
        return {
            loading: false,
            showDeleteConfirm: false,
            localItems: this.quotes,
            localTotalItems: this.total_items,
            itemIdToDelete: null,
            // paginacion dinamica
            currentPage: 1,
            loadingItems: false,
            // busqueda
            searchTemp: null,
            search: null,
            itemsBuffer: [],
        };
    },
    components: {
        AppLayout,
        Loading,
        SearchInput,
        PrimaryButton,
        ConfirmationModal,
        DangerButton,
        CancelButton,
    },
    props: {
        quotes: Array,
        total_items: Number,
    },
    methods: {
        formatDateTime(dateTime) {
            let parsedDate = new Date(dateTime);

            return format(parsedDate, 'd MMM, y • hh:mm a', { locale: es }); // Formato personalizado
        },
        handleCommand(command) {
            const commandName = command.split('-')[0];
            const itemId = command.split('-')[1];

            if (commandName == 'edit') {
                this.$inertia.get(route('quotes.edit', itemId));
            } else if (commandName == 'sent') {
                this.markAsSent(itemId);
            } else if (commandName == 'auth') {
                this.markAsAuthorized(itemId);
            } else if (commandName == 'reje') {
                this.markAsRejected(itemId);
            } else {
                this.showDeleteConfirm = true;
                this.itemIdToDelete = itemId;
            }
        },
        handleSearch(query) {
            this.search = query;
            if (this.search) {
                this.fetchMatches();
            } else {
                this.showAllItems();
            }
        },
        handleTagClose() {
            this.search = null;
            this.showAllItems();
        },
        showAllItems() {
            // solo si hay items en el buffer, para no dejar vacio el arreglo principal
            if (this.itemsBuffer.length) {
                this.localItems = this.itemsBuffer;
                this.itemsBuffer = [];
            }
        },
        async markAsSent(itemId) {
            try {
                const response = await axios.put(route('quotes.mark-as-sent', itemId));

                if (response.status === 200) {
                    this.localItems.find(item => item.id == itemId).sent_at = response.data.prop;
                    this.$notify({
                        title: "Correcto",
                        message: "",
                        type: "success",
                    });
                }
            } catch (error) {
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición, inténtalo más tarde",
                    type: "error",
                });
                console.log(error)
            }
        },
        async markAsAuthorized(itemId) {
            try {
                const response = await axios.put(route('quotes.mark-as-authorized', itemId));

                if (response.status === 200) {
                    let localItem = this.localItems.find(item => item.id == itemId);
                    localItem.authorized_at = response.data.prop;
                    localItem.rejected_at = null;
                    this.$notify({
                        title: "Correcto",
                        message: "",
                        type: "success",
                    });
                }
            } catch (error) {
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición, inténtalo más tarde",
                    type: "error",
                });
                console.log(error)
            }
        },
        async markAsRejected(itemId) {
            try {
                const response = await axios.put(route('quotes.mark-as-rejected', itemId));

                if (response.status === 200) {
                    let localItem = this.localItems.find(item => item.id == itemId);
                    localItem.rejected_at = response.data.prop;
                    localItem.authorized_at = null;
                    this.$notify({
                        title: "Correcto",
                        message: "",
                        type: "success",
                    });
                }
            } catch (error) {
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición, inténtalo más tarde",
                    type: "error",
                });
                console.log(error)
            }
        },
        async fetchItemsByPage() {
            try {
                this.loadingItems = true;
                const response = await axios.get(route('quotes.get-by-page', this.currentPage));

                if (response.status === 200) {
                    this.localItems = [...this.localItems, ...response.data.items];
                    this.currentPage++;
                }
            } catch (error) {
                console.log(error)
            } finally {
                this.loadingItems = false;
            }
        },
        async fetchMatches() {
            try {
                this.loading = true;
                const response = await axios.get(route('quotes.get-matches', { query: this.search }));

                if (response.status === 200) {
                    if (!this.itemsBuffer.length) {
                        this.itemsBuffer = this.localItems;
                    }
                    this.localItems = response.data.items;
                }
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },
        async deleteItem() {
            try {
                this.showDeleteConfirm = false;
                this.loading = true;
                const response = await axios.delete(route('quotes.destroy', this.itemIdToDelete));

                if (response.status === 200) {
                    const index = this.localItems.findIndex(item => item.id == this.itemIdToDelete);
                    this.localItems.splice(index, 1);
                    this.localTotalItems--;
                    this.$notify({
                        title: "Correcto",
                        message: "",
                        type: "success",
                    });
                }
            } catch (error) {
                this.$notify({
                    title: "No se pudo completar la solicitud",
                    message: "El servidor no pudo procesar la petición, inténtalo más tarde",
                    type: "error",
                });
                console.log(error);
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.localItems = this.quotes;
        this.localTotalItems = this.total_items;
    }
};

</script>
