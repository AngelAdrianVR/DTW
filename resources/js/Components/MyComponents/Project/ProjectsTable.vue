<template>
    <div class="w-11/12 mx-8 my-16">
      <table v-if="projects?.length" class="w-full mx-auto text-sm">
        <thead>
          <tr class="text-center">
            <th class="font-bold pb-3 pl-2 text-left">ID</th>
            <th class="font-bold pb-3 text-left">Cliente</th>
            <th class="font-bold pb-3 text-left">Nombre del proyecto</th>
            <th class="font-bold pb-3 text-left">Contacto</th>
            <th class="font-bold pb-3 text-left">Costo de p</th>
            <th class="font-bold pb-3 text-left">Días</th>
            <th class="font-bold pb-3 text-left">F. inicio</th>
            <th class="font-bold pb-3 text-left">F. est. de término</th>
            <th class="font-bold pb-3 text-left">Prioridad</th>
            <th class="font-bold pb-3 text-left">Estatus</th>
            <th class="font-bold pb-3 text-left">Tareas</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="project in projects" :key="project.id" class="mb-4 cursor-pointer hover:bg-primarylight"
            @click="$inertia.get(route('projects.show', project.id))">
            <td class="text-left py-2 pr-2 pl-4 rounded-l-full">{{ project.id }}</td>
            <td :title="project.name" class="text-left py-2 max-w-[220px] truncate pr-2">{{ project.name }}</td>
            <td class="text-left py-2">{{ project.customer_info?.name }}</td>
            <td class="text-left py-2">{{ project.price?.formated }}</td>
            <td class="text-left py-2">{{ project.price?.formated }}</td>
            <td class="text-left py-2">{{ project.hours_work / 8 }}</td>
            <td class="text-left py-2">{{ project.start_date }}</td>
            <td class="text-left py-2">{{ 'fecha tentativa' }}</td>
            <!-- <td class="text-left py-2">
              <span
                :class="calculateProjectStatus(project.tasks)?.text_color + ' ' + calculateProjectStatus(project.tasks)?.bg"
                class="py-1 px-2 rounded-full border border-white">{{ calculateProjectStatus(project.tasks)?.label
                }}</span>
            </td>
            <td class="text-left py-2 flex space-x-px items-center">
              <p class="text-[10px] mt-1">{{ project.tasks.filter(task => task.status === 'Terminada').length }}</p>
              <div class="relative bg-gray4 rounded-full h-5 w-24 mt-1 border border-white">
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
            </td> -->
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
    
}
}
</script>