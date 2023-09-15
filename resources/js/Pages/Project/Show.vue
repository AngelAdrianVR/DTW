<template>
    <div class="mx-24 my-14">
        <Link :href="route('projects.index')" class="mb-8 underline block">Atras</Link>
        <p><strong>id:</strong> {{ project.data.id }}</p>
        <p><strong>Nombre:</strong> {{ project.data.name }}</p>
        <p><strong>Clave:</strong> {{ project.data.key }}</p>
        <p><strong>Nombre del cliente:</strong> {{ project.data.customer_info.name }}</p>
        <p><strong>Correo del cliente:</strong> {{ project.data.customer_info.email ?? '--' }}</p>
        <p><strong>Empresa del cliente:</strong> {{ project.data.customer_info.company }}</p>
        <p><strong>Teléfono del cliente:</strong> {{ project.data.customer_info.phone ?? '--' }}</p>
        <p><strong>Descripción del proyecto:</strong> {{ project.data.description }}</p>
        <p><strong>Horas totales del proyecto:</strong> {{ project.data.hours_work }}</p>
        <p><strong>Precio del proyecto:</strong> {{ project.data.price.formated }}</p>
        <p><strong>Fecha de comienza del proyecto:</strong> {{ project.data.start_date }}</p>
        <p><strong>Fecha de finalización del proyecto:</strong> {{ project.data.finish_date }}</p>
        <p><strong>Estatus:</strong> {{ project.data.state }}</p>
        <p><strong>Creado el:</strong> {{ project.data.created_at }}</p>

        <!-- <el-button @click="changeDispatchedStatus()" class="mt-6">
            {{ quoteRequest.data.is_dispatched ? 'Marcar como pendiente por enviar' : 'Marcar como cotizacion enviada' }}
        </el-button> -->
    </div>
</template>
<script>
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    data() {
        return {

        }
    },
    props: {
        project: Object,
    },
    components: {
        Link,
    },
    methods: {
        async changeDispatchedStatus() {
            try {
                const response = await axios.put(route('quote-request.change-dispatched-status', this.quoteRequest.data.id));

                if (response.status === 200) {
                    this.$notify({
                        title: 'Éxito',
                        message: 'status cambiado',
                        type: 'success'
                    });

                    this.quoteRequest.data.is_dispatched = response.data.is_dispatched;
                }
            } catch (error) {
                console.log(error);
            }
        }
    }
}
</script>
