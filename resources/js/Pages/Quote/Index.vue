<template>
    <AppLayout title="Cotizaciones">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <i class="fa-solid fa-file-invoice-dollar text-gray-500 text-lg mr-2"></i>Cotizaciones
                </h2>
                <Link :href="route('quotes.create')">
                <SecondaryButton> Agregar + </SecondaryButton>
                </Link>
            </div>
        </template>
        <div class="lg:w-5/6 mx-auto mt-6 cursor-pointer">
            <el-table :data="quotes.data" max-height="650" @row-click="handleRowClick" style="width: 100%">
                <el-table-column type="selection" width="55" />
                <el-table-column prop="id" label="ID" width="60" />
                <el-table-column prop="customer_name" label="Cliente" width="180" />
                <el-table-column prop="promised_end_date" label="Fecha promesa de entrega" />
                <el-table-column prop="created_at" label="Creado el" />
                <el-table-column label="Acciones" fixed="right">
                    <template #default="scope">
                        <el-button size="small" type="primary">Crear
                            proyecto</el-button>
                        <el-button size="small" type="primary"
                            @click.stop="$inertia.get(route('quotes.edit', scope.row))">Editar</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </div>
    </AppLayout>
</template>

<script>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {

        };
    },
    components: {
        AppLayout,
        SecondaryButton,
        Link
    },
    props: {
        quotes: Array,
    },
    methods: {
        handleRowClick(row) {
            this.$inertia.get(route('quotes.show', row));
        },
    }
};

</script>
