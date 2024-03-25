<template>
    <div class="mt-5">
        <Loading v-if="loading" class="mt-12" />
        <table v-else-if="projects.length" class="w-full">
            <thead>
                <tr class="*:text-left *:pb-2 *:px-4 *:text-sm">
                    <th>Folio</th>
                    <th>Nombre</th>
                    <th>Tareas</th>
                    <th>Fecha de inicio</th>
                    <th>Fecha limite</th>
                    <th>Completado el</th>
                </tr>
            </thead>
            <tbody>
                <tr @click="$inertia.visit(route('projects.show', item))" v-for="item in projects" :key="item.id"
                    class="*:text-xs *:py-2 *:px-4 hover:bg-primarylight cursor-pointer">
                    <td class="rounded-s-full">
                        {{ 'P-' + String(item.id).padStart(3, '0') }}
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ formatDateTime(item.start_date) }}</td>
                    <td>{{ formatDateTime(item.estimated_date) }}</td>
                    <td class="rounded-e-full">{{ formatDateTime(item.finish_date) }}</td>
                </tr>
            </tbody>
        </table>
        <el-empty v-else description="No hay proyectos para mostrar" />
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
            projects: [],
        };
    },
    components: {
        Loading,
    },
    props: {
        clientId: Number,
    },
    methods: {
        formatDateTime(dateTime) {
            let parsedDate = new Date(dateTime);

            return format(parsedDate, 'd MMM, y • hh:mm a', { locale: es }); // Formato personalizado
        },
        async fetchClientProjects() {
            try {
                this.loading = true;
                const response = await axios.get(route('clients.get-projects', this.clientId));

                if (response.status === 200) {
                    this.projects = response.data.items;
                }
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchClientProjects();
    }
}
</script>