<template>
    <AppLayout title="Detalles de proyecto">
        <div class="flex justify-between text-lg mx-2 lg:mx-14 mt-11">
            <span>Detalles de proyecto</span>
            <Link :href="route('projects.index')"
                class="cursor-pointer w-7 h-7 rounded-full hover:bg-[#D9D9D9] flex items-center justify-center">
            <i class="fa-solid fa-xmark"></i>
            </Link>
        </div>

        <div class="flex justify-between items-center space-x-5 mt-5 mx-2 lg:mx-14">
            <div class="w-1/3">
                <el-select @change="$inertia.get(route('projects.show', selectedProject))" v-model="selectedProject"
                    clearable filterable placeholder="Buscar proyecto" no-data-text="No hay proyectos registrados"
                    no-match-text="No se encontraron coincidencias">
                    <el-option v-for="project in projects" :key="project.id" :label="project.name"
                        :value="project.id" />
                </el-select>
            </div>
            <h1 class="w-1/3 text-center font-bold">
                {{ project.data.name }} <br>
                <span class="text-primary text-sm">{{ getTotalTime(project.data.tasks) }} invertido</span>
            </h1>
            <div class="w-1/3 flex">
                <div v-if="activeTab == 2" class="flex space-x-2 w-full justify-end">
                    <PrimaryButton @click="$inertia.get(route('projects.create'))">Crear proyecto</PrimaryButton>
                    <button @click="$inertia.get(route('projects.edit', project.data.id))"
                        class="w-9 h-9 rounded-full bg-[#D9D9D9]">
                        <i class="fa-solid fa-pen text-sm text-gray-600"></i>
                    </button>
                </div>
                <div v-if="(activeTab == 1 || activeTab == 3)" class="flex space-x-2 w-full justify-end">
                    <PrimaryButton @click="$inertia.get(route('project-tasks.create', { projectId: project.data.id }))">
                        Crear tarea</PrimaryButton>
                </div>
            </div>
        </div>

        <!-- ------------- tabs section starts ------------- -->
        <el-tabs class="mx-2 md:mx-9 mt-10" v-model="activeTab" @tab-click="handleClickInTab">
            <el-tab-pane label="Tareas" name="1">
                <Tasks :tasks="project.data.tasks" :users="users" />
            </el-tab-pane>
            <el-tab-pane label="Información del proyecto" name="2">
                <ProjectInfo :project="project.data" />
            </el-tab-pane>
            <el-tab-pane label="Cronograma" name="3">
                <Schedule :currentProject="project.data" />
            </el-tab-pane>
        </el-tabs>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import ProjectInfo from "@/Pages/Project/Tabs/ProjectInfo.vue";
import Tasks from "@/Pages/Project/Tabs/Tasks.vue";
import Schedule from "@/Pages/Project/Tabs/Schedule.vue";
import Back from "@/Components/MyComponents/Back.vue";
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

export default {
    data() {
        return {
            selectedProject: null,
            activeTab: '1',
        }
    },
    props: {
        project: Object,
        projects: Array,
        users: Array,
    },
    components: {
        AppLayout,
        PrimaryButton,
        ProjectInfo,
        Schedule,
        Tasks,
        Back,
        Link,
    },
    methods: {
        getTotalTime(tasks) {
            const totalMinutes = tasks.reduce((acc, task) => acc + task.minutes, 0);
            const hours = Math.floor(totalMinutes / 60);
            const minutes = totalMinutes % 60;

            return `${hours}h ${minutes}m`;
        },
        handleClickInTab(tab) {
            // Agrega la variable currentTab=tab.props.name a la URL para mejorar la navegacion al actalizar o cambiar de pagina
            const currentURL = new URL(window.location.href);
            currentURL.searchParams.set('currentTab', tab.props.name);
            // Actualiza la URL
            window.history.replaceState({}, document.title, currentURL.href);
        },
        setTabInUrl() {
            // Obtener la URL actual
            const currentURL = new URL(window.location.href);
            // Extraer el valor de 'currentTab' de los parámetros de búsqueda
            const currentTabFromURL = currentURL.searchParams.get('currentTab');

            if (currentTabFromURL) {
                this.activeTab = currentTabFromURL;
            }
        },
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
    },
    mounted() {
        this.selectedProject = this.project.data.id;

        this.setTabInUrl();
    },
}
</script>
