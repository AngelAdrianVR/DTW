<template>
    <section>
        <Loading v-if="loading" />
        <table v-else-if="clients.length">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>RFC</th>
                    <th>Domicilio</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="item in clients" :key="item.id">
                    <td>{{ item.id }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.rfc }}</td>
                    <td>{{ item.address }}</td>
                    <td>{{ item.contacts[0].name }}</td>
                    <td>{{ item.contacts[0].phone }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <el-empty v-else description="No hay clientes para mostrar" />
    </section>
</template>
<script>
import axios from "axios";
import Loading from "@/Components/MyComponents/Loading.vue";

export default {
    data() {
        return {
            loading: false,
            clients: [],
        }
    },
    components: {
        Loading,
    },
    methods: {
        async fetchClients() {
            try {
                const response = await axios.get(route('clients.get-all'));

                if (response.status === 200) {
                    console.log(response.data.items)
                    this.clients = response.data.items;
                }
            } catch (error) {
                console.log(error);
                this.$notify({
                    title: "Problema con servidor",
                    message: "No se pudo obtener la tabla de clientes",
                    type: "error",
                })
            } finally {
                this.loading = false;
            }
        },
    },
    async mounted() {
        await this.fetchClients();
    }
}
</script>