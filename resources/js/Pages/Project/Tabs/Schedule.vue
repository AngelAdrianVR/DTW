<template>
    <div class="text-left text-sm items-center mt-4">

      <!-- <GanttDiagramMonth v-if="period === 'Mes'" :currentProject="currentProject" :currentDate="currentDate" /> -->
      <!-- <GanttDiagramBimester v-if="period === 'Bimestre'" :currentProject="currentProject" :currentDate="currentDate" /> -->

        <p class="text-center text-gray-500 mt-5" v-if="currentProject?.tasks?.length == 0">No hay tareas para mostrar. 
          <span @click="$inertia.get(route('project-tasks.create', { projectId: currentProject?.id ?? 1 }))" class="text-primary cursor-pointer">Crea una</span></p>

      <div class="text-right mr-9">
        <div class="border border-[#9A9A9A] rounded-md inline-flex justify-end mt-4">
          <p :class="period == 'Mes' ? 'bg-primary text-white rounded-sm' : 'border-[#9A9A9A]'
            " @click="period = 'Mes'" class="px-4 py-2 text-[#9A9A9A] cursor-pointer">
            Mes
          </p>
          <p :class="period == 'Bimestre'
            ? 'bg-primary text-white rounded-sm'
            : 'border-[#9A9A9A]'
            " @click="period = 'Bimestre'" class="px-4 py-2 text-[#9A9A9A] cursor-pointer border-x border-transparent">
            Bimestre
          </p>
        </div>
      </div>
    </div>
</template>

<script>
import GanttDiagramMonth from "@/Components/MyComponents/Project/GanttDiagramMonth.vue";
import GanttDiagramBimester from "@/Components/MyComponents/Project/GanttDiagramBimester.vue";

export default {
data() {
    return {
        period: "Mes", //period of time in cronograma
        currentDate: null
    }
},
components:{
GanttDiagramBimester,
GanttDiagramMonth
},
props:{
currentProject: Object,
},
methods:{
    
},
  mounted() {
    // Verificar si hay tareas en el proyecto y si la primera tarea tiene una fecha de inicio
    if (this.currentProject && this.currentProject?.tasks?.length > 0) {
      const firstTask = this.currentProject.tasks[0];
      if (firstTask && firstTask.start_date_raw) {
        this.currentDate = new Date(firstTask.start_date_raw);
      }
    }
  },
}
</script>