<template>
    <AppLayout title="Proyectos">
        <template #header>
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-laptop text-gray-500 text-lg mr-2"></i>Proyectos
            </h2>
            <Link :href="route('projects.create')">
            <SecondaryButton> Agregar + </SecondaryButton>
            </Link>
        </div>
        </template>
        <div class="lg:w-5/6 mx-auto mt-6">
            <el-table :data="projects.data" max-height="450"
                style="width: 100%">
                <el-table-column type="selection" width="55" />
                <el-table-column prop="name" label="Nombre" width="180" />
                <el-table-column prop="client_info[name]" label="Cliente" width="180" />
                <el-table-column prop="client_info[email]" label="Correo" width="180" />
                <el-table-column prop="client_info[phone]" label="Teléfono" width="180" />
                <el-table-column prop="hours_work" label="Horas de trabajo" width="180" />
                <el-table-column prop="cuote" label="Cotización" width="180" />
                <el-table-column prop="promisse_finish_date" label="Fecha de entrega" width="180" />
                <el-table-column prop="created_at" label="Enviado el" />
            </el-table>
        </div>
    </AppLayout>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';

export default {
    data() {
        return {

        };
    },
    components: {
        ApplicationLogo,
        AppLayout,
        SecondaryButton,
        Link
    },
    props: {
        projects: Array,
    },
};

</script>
