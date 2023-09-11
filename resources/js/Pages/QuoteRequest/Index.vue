<template>
    <AppLayout title="Cotizaciones">
        <template #header>
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    <i class="fa-solid fa-file-invoice-dollar text-gray-500 text-lg mr-2"></i>Cotizaciones solicitadas
                </h2>
            </div>
        </template>
        <div class="lg:w-5/6 mx-auto mt-6 cursor-pointer">
            <el-table :data="quote_requests.data" @row-click="handleRowClick" max-height="450" style="width: 100%">
                <el-table-column type="selection" width="55" />
                <el-table-column prop="id" label="ID" width="55" />
                <el-table-column prop="name" label="Cliente" />
                <el-table-column prop="phone" label="Telefono" />
                <el-table-column prop="project_type" label="Tipo de proyecto" />
                <el-table-column prop="estimate" label="Presupuesto" />
                <el-table-column prop="is_dispatched" label="Status" />
                <el-table-column prop="created_at" label="Creado el" />
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
        quote_requests: Object,
    },
    methods: {
        handleRowClick(row) {
            this.$inertia.get(route('quote-request.show', row));
        },
    }
};

</script>
