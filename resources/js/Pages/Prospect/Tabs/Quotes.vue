<template>
    <div class="mt-5">
        <Loading v-if="loading" class="mt-12" />
        <table v-else-if="quotes.length" class="w-full">
            <thead>
                <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Contacto</th>
                    <th>Creado por</th>
                    <th>Creado el</th>
                    <th>Costo</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="$inertia.visit(route('quotes.show', item))" v-for="item in quotes" :key="item.id"
                    class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
                    <td class="rounded-s-full">
                        <p class=" flex items-center space-x-1">
                            <el-tooltip v-if="item.sent_at && !item.authorized_at" placement="top"
                                :content="'Enviado al prospecto el ' + formatDateTime(item.sent_at)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-[14px] text-yellow-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </el-tooltip>
                            <el-tooltip v-else-if="item.authorized_at" placement="top"
                                :content="'Autorizado por prospecto el ' + formatDateTime(item.sent_at)">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-[14px] text-green-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                </svg>
                            </el-tooltip>
                            <el-tooltip v-else placement="top" content="Sin enviar a prospecto / prospecto">
                                <i class="fa-solid fa-question size-[14px] text-red-600"></i>
                            </el-tooltip>
                            <span>{{ 'C-' + String(item.id).padStart(3, '0') }}</span>
                        </p>
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.contact.name }}</td>
                    <td>{{ item.user.name }}</td>
                    <td>{{ formatDateTime(item.created_at) }}</td>
                    <td class="rounded-e-full">
                        ${{ item.total_cost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") }}
                    </td>
                </tr>
            </tbody>
        </table>
        <el-empty v-else description="No hay cotizaciones para mostrar" />
    </div>
</template>
<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import { format } from 'date-fns';
import { es } from 'date-fns/locale';
import axios from "axios";

export default {
    data() {
        return {
            loading: false,
            quotes: [],
        };
    },
    components: {
        Loading,
    },
    props: {
        prospectId: Number,
    },
    methods: {
        formatDateTime(dateTime) {
            let parsedDate = new Date(dateTime);

            return format(parsedDate, 'd MMM, y • hh:mm a', { locale: es }); // Formato personalizado
        },
        async fetchProspectQuotes() {
            try {
                this.loading = true;
                const response = await axios.get(route('prospects.get-quotes', this.prospectId));

                if (response.status === 200) {
                    this.quotes = response.data.items;
                }
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchProspectQuotes();
    }
}
</script>