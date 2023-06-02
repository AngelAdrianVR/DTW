
<template>
    <AppLayout title="Mensajería">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-envelope text-gray-500 text-lg mr-2"></i>Buzón de entrada
            </h2>
        </template>
        <div class="lg:w-5/6 mx-auto mt-6">
            <el-table :data="messages" max-height="450"
                style="width: 100%">
                <el-table-column type="selection" width="55" />
                <el-table-column prop="name" label="Nombre" width="180" />
                <el-table-column prop="email" label="Correo" width="180" />
                <el-table-column prop="company" label="Empresa" />
                <el-table-column prop="phone" label="Telefono" />
                <el-table-column prop="message" label="Mensaje" />
                <el-table-column prop="created_at" label="Enviado el" />
            </el-table>
        </div>
    </AppLayout>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
    data() {
        return {

        };
    },
    components: {
        ApplicationLogo,
        AppLayout,
    },
    props: {
        messages: Array,
    },
};

</script>
