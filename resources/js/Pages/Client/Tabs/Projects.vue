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
                    <td class="text-left py-2 rounded-r-full flex space-x-1 items-center">
                        <p class="text-[10px] mt-1">{{ item.tasks.filter(task => task.status === 'Terminada').length }}
                        </p>
                        <el-tooltip :content="getStatusTooltip(item.tasks)" placement="top">
                            <div class="relative bg-gray4 rounded-full h-5 w-28 mt-1 border group-hover:border-white"
                                :style="{ borderColor: getStatusColor(item.tasks) }">
                                <div :class="(item.tasks.filter(task => task.status === 'Terminada').length / item.tasks.length) * 100 == 100 ? 'rounded-full' : 'rounded-l-full'"
                                    class="absolute top-0 left-0 bg-primary h-[18px]" :style="{
            width: (item.tasks.filter(task => task.status === 'Terminada').length / item.tasks.length) * 100 + '%' ,
            backgroundColor: getStatusColor(item.tasks)
        }">
                                </div>
                                <p class="text-[11px] mt-px absolute top-0 right-12 text-black">{{ item.tasks.length !=
            0 ?
            Math.round((item.tasks.filter(task => task.status === 'Terminada').length /
                item.tasks.length) *
                100) : '0' }}%</p>
                            </div>
                        </el-tooltip>
                        <p class="text-[10px] mt-1">{{ item.tasks.length }}</p>
                    </td>
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
        getStatusColor(tasks) {
            const totalTasks = tasks.length;
            const completedTasks = tasks.filter(task => task.status === 'Terminada').length;
            const inProgressTasks = tasks.filter(task => task.status === 'En curso').length;

            if (totalTasks === 0) {
                return '#E61B0F';
            }
            if (completedTasks === totalTasks) {
                return '#26E108';
            } else if (inProgressTasks > 0 || completedTasks > 0) {
                return '#FD7708';
            } else {
                return '#9a9a9a';
            }
        },
        getStatusTooltip(tasks) {
            const totalTasks = tasks.length;
            const completedTasks = tasks.filter(task => task.status === 'Terminada').length;
            const inProgressTasks = tasks.filter(task => task.status === 'En curso').length;

            if (totalTasks === 0) {
                return 'Sin tareas';
            }
            if (completedTasks === totalTasks) {
                return 'Terminado';
            } else if (inProgressTasks > 0 || completedTasks > 0) {
                return 'En proceso';
            } else {
                return 'Sin iniciar';
            }
        },
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