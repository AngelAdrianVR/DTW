<template>
    <div class="w-11/12 lg:mx-8 my-16 overflow-auto">
      <table v-if="projects?.length" class="w-full mx-auto text-sm">
        <thead>
          <tr class="text-center">
            <th class="font-bold pb-3 pl-2 text-left">ID</th>
            <th class="font-bold pb-3 text-left">Cliente</th>
            <th class="font-bold pb-3 text-left">Nombre del proyecto</th>
            <th class="font-bold pb-3 text-left">Costo del proyecto</th>
            <th class="font-bold pb-3 text-left">Días</th>
            <th class="font-bold pb-3 text-left">F. inicio</th>
            <th class="font-bold pb-3 text-left">F. est. de término</th>
            <th class="font-bold pb-3 text-left">Estatus</th>
            <th class="font-bold pb-3 text-left">Tareas</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id" class="mb-4 cursor-pointer hover:bg-primarylight group"
            @click="$inertia.get(route('projects.show', project.id))">
            <td class="text-left py-2 pr-2 pl-4 rounded-l-full">{{ project.id }}</td>
            <td class="text-left py-2">{{ project.client?.name ?? project.customer_info?.name }}</td>
            <td :title="project.name" class="text-left py-2 max-w-[220px] truncate pr-2">{{ project.name }}</td>
            <td class="text-left py-2">{{ project.price?.formated }}</td>
            <td class="text-left py-2">{{ project.hours_work / 8 }}</td>
            <td class="text-left py-2">{{ project.start_date }}</td>
            <td class="text-left py-2">{{ project.estimated_date }}</td>
            <td class="text-left py-2">
              <span
                :class="calculateProjectStatus(project.tasks)?.text_color + ' ' + calculateProjectStatus(project.tasks)?.bg"
                class="py-1 px-2 rounded-full border border-white">{{ calculateProjectStatus(project.tasks)?.label
                }}</span>
            </td>
            <td class="text-left py-2 rounded-r-full flex space-x-px items-center">
              <p class="text-[10px] mt-1">{{ project.tasks.filter(task => task.status === 'Terminada').length }}</p>
              <div class="relative bg-gray4 rounded-full h-5 w-24 mt-1 border border-primary group-hover:border-white">
                <div
                  :class="(project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) * 100 == 100 ? 'rounded-full' : 'rounded-l-full'"
                  class="absolute top-0 left-0 bg-primary h-5"
                  :style="{ width: (project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) * 100 + '%' }">
                </div>
                <p class="text-xs mt-px absolute top-0 right-8 text-black">{{ project.tasks.length != 0 ?
                  Math.round((project.tasks.filter(task => task.status === 'Terminada').length / project.tasks.length) *
                    100) : '0' }}%</p>
              </div>
              <p class="text-[10px] mt-1">{{ project.tasks.length }}</p>
            </td>
          </tr>
        </tbody>
      </table>
      <el-empty v-else description="No hay proyectos registrados" />
    </div>
</template>

<script>
export default {
data() {
    return {

    }
},
components:{

},
props:{
projects: Array
},
methods:{
    calculateProjectStatus(tasks) {
      const totalTasks = tasks.length;
      const completedTasks = tasks.filter(task => task.status === 'Terminada').length;
      const inProgressTasks = tasks.filter(task => task.status === 'En curso').length;

      if (totalTasks === 0) {
        return {
          label: 'Sin tareas',
          text_color: 'text-red-600',
          bg: 'bg-red-200',
        };
      }

      if (completedTasks === totalTasks) {
        return {
          label: 'Terminado',
          text_color: 'text-green-600',
          bg: 'bg-green-200',
        };
      } else if (inProgressTasks > 0 || completedTasks > 0) {
        return {
          label: 'En proceso',
          text_color: 'text-secondary',
          bg: 'bg-blue-200',
        };
      } else {
        return {
          label: 'Sin iniciar',
          text_color: 'text-orange-600',
          bg: 'bg-orange-200',
        };
      }
    },
}
}
</script>