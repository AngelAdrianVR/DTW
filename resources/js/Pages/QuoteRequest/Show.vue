<template>
    <div class="mx-24 my-14">
        <Link :href="route('quote-request.index')" class="mb-8 underline block">Atras</Link>
        <p>Nombre: {{ quoteRequest.data.name }}</p>
        <p>Correo: {{ quoteRequest.data.email }}</p>
        <p>Telefono: {{ quoteRequest.data.phone }}</p>
        <p>Sitio relacionado: {{ quoteRequest.data.related_sites }}</p>
        <p>Nombre de negocio: {{ quoteRequest.data.business_name }}</p>
        <p>Tipo de negocio: {{ quoteRequest.data.business_type }}</p>
        <p>Tipo de proyecto solicitado: {{ quoteRequest.data.project_type }}</p>
        <p>Presupuesto: {{ quoteRequest.data.estimate }}</p>
        <p>Descripcion de la idea: {{ quoteRequest.data.project_description }}</p>
        <p>Como supo de nosotros: {{ quoteRequest.data.way_of_knowing }}</p>

        <el-button @click="changeDispatchedStatus()" class="mt-6">
            {{ quoteRequest.data.is_dispatched ? 'Marcar como pendiente por enviar' : 'Marcar como cotizacion enviada' }}
        </el-button>
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
        quoteRequest: Object,
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
