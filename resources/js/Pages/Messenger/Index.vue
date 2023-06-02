
<template>
    <AppLayout title="Mensajería">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <i class="fa-solid fa-envelope text-gray-500 text-lg mr-2"></i>Buzón de entrada
            </h2>
        </template>
        <div class="lg:w-5/6 mx-auto mt-6">
            <div class="flex space-x-2 justify-end">
                <el-button @click="markAsDispatched" type="success" plain class="mb-3"
                    :disabled="disableMassiveActions">Marcar como atendidos</el-button>
                <el-button @click="deleteSelections" type="danger" plain class="mb-3"
                    :disabled="disableMassiveActions">Eliminar</el-button>
            </div>
            <el-table :data="messages" max-height="450" style="width: 100%" @selection-change="handleSelectionChange"
                ref="multipleTableRef" :row-class-name="tableRowClassName">
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
import axios from 'axios';
import { useToast } from "vue-toastification";

export default {
    data() {
        return {
            disableMassiveActions: true,
            toast: null,
        };
    },
    components: {
        ApplicationLogo,
        AppLayout,
    },
    props: {
        messages: Array,
    },
    methods: {
        async markAsDispatched() {
            try {
                const response = await axios.post(route('messages.mark-as-dispatched', {
                    messages: this.$refs.multipleTableRef.value
                }));

                console.log(response.data.message);
                if (response.status == 200) {
                    this.toast.success(response.data.message);

                    // change status to selected items
                    this.$refs.multipleTableRef.value.forEach(element => {
                        element.status = 1
                    });
                    // const selectedMessages = this.messages.filter(item => this.$refs.multipleTableRef.value.id == item.id);
                    // selectedMessages.forEach(item => item.status = 1);

                } else {
                    this.toast.error(response.data.message);
                }

            } catch (err) {
                // this.toast.error(err);
                console.log(err);
            }

        },
        handleSelectionChange(val) {
            this.$refs.multipleTableRef.value = val;

            if (!this.$refs.multipleTableRef.value.length) {
                this.disableMassiveActions = true;
            } else {
                this.disableMassiveActions = false;
            }
        },
        deleteSelections() {
            console.log('Eliminando elementos')
        },
        tableRowClassName({ row, rowIndex }) {
            if (row.status === 1) {
                return 'text-green-600';
            }

            return '';
        },
    },

    mounted() {
        this.toast = useToast();
    }
};

</script>
