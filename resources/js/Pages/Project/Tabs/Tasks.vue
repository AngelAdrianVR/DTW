<template>
    <div class="md:grid grid-cols-3 text-left p-4 text-sm">
      <!-- -- Por hacer -- -->
      <div class="lg:border-r lg:mb-0 mb-16 border-[#9A9A9A] h-auto lg:pr-7">
        <div class="flex items-center justify-between border border-[#D9D9D9] rounded-lg px-5 py-4 mb-3">
            <h2 class="font-bold">POR HACER</h2>
            <span class="font-bold rounded-full px-[10px] py-1 bg-[#F2F2F2]">{{ pendingTasksList?.length ?? 0 }}</span>
        </div>
        <draggable @start="handleStartDrag" @add="handleAddDrag" @end="drag = false" v-model="pendingTasksList"
          :animation="300" item-key="id" tag="ul" group="tasks" id="pendent"
          :class="(drag && !pendingTasksList?.length) ? 'h-40' : ''">
          <template #item="{ element: task }">
            <li>
              <ProjectTaskCard @delete-task="deleteProjectTask" @updated-status="updateTask($event)" :taskComponent="tasks"
                :users="users" :id="task.id" />
            </li>
          </template>
        </draggable>
        <div class="text-center" v-if="!pendingTasksList?.length">
          <p class="text-xs text-gray-500">No hay tareas para mostrar</p>
          <i class="fa-regular fa-folder-open text-9xl text-gray-300/50 mt-16"></i>
        </div>
      </div>

      <!-- -- En curso -- -->
      <div class="lg:border-r lg:mb-0 mb-16 border-[#9A9A9A] h-auto lg:px-7">
        <div class="flex items-center justify-between border border-[#D9D9D9] rounded-lg px-5 py-4 mb-3">
            <h2 class="font-bold">EN CURSO</h2>
            <span class="font-bold rounded-full px-[10px] py-1 bg-[#F2F2F2]">{{ inProgressTasksList?.length ?? 0 }}</span>
        </div>
        <draggable @start="handleStartDrag" @add="handleAddDrag" @end="drag = false" v-model="inProgressTasksList"
          :animation="300" item-key="id" tag="ul" group="tasks" id="process"
          :class="(drag && !inProgressTasksList?.length) ? 'h-40' : ''">
          <template #item="{ element: task }">
            <li>
              <ProjectTaskCard @delete-task="deleteProjectTask" @updated-status="updateTask($event)" :taskComponent="task"
                :users="users" />
            </li>
          </template>
        </draggable>
        <div class="text-center" v-if="!inProgressTasksList?.length">
          <p class="text-xs text-gray-500">No hay tareas para mostrar</p>
          <i class="fa-regular fa-folder-open text-9xl text-gray-300/50 mt-16"></i>
        </div>
      </div>

      <!-- -- Terminado -- -->
      <div class="h-auto lg:px-7">
        <div class="flex items-center justify-between border border-[#D9D9D9] rounded-lg px-5 py-4 mb-3">
            <h2 class="font-bold">TERMINADA</h2>
            <span class="font-bold rounded-full px-[10px] py-1 bg-[#F2F2F2]">{{ finishedTasksList?.length ?? 0 }}</span>
        </div>
        <draggable @start="handleStartDrag" @add="handleAddDrag" @end="drag = false" v-model="finishedTasksList"
          :animation="300" item-key="id" tag="ul" group="tasks" id="finished"
          :class="(drag && !finishedTasksList?.length) ? 'h-40' : ''">
          <template #item="{ element: task }">
            <li>
              <ProjectTaskCard @delete-task="deleteProjectTask" @updated-status="updateTask($event)" :taskComponent="task"
                :users="users" />
            </li>
          </template>
        </draggable>
        <div class="text-center" v-if="!finishedTasksList?.length">
          <p class="text-xs text-gray-500">No hay tareas para mostrar</p>
          <i class="fa-regular fa-folder-open text-9xl text-gray-300/50 mt-16"></i>
        </div>
      </div>
    </div>
</template>

<script>
import ProjectTaskCard from "@/Components/MyComponents/Project/ProjectTaskCard.vue";

export default {
data() {
    return {
        pendingTasksList: [],
        inProgressTasksList: [],
        finishedTasksList: [],
        drag: false,
        draggingTaskId: null,
    }
},
components:{
ProjectTaskCard,
},
props:{
tasks: Array,
users: Array,
},
methods:{
    handleStartDrag(evt) {
      this.draggingTaskId = evt.item.__draggable_context.element.id;
      this.drag = true;
    },
    handleAddDrag(evt) {
      let status = 'Terminada';
      if (evt.to.id === 'pendent') {
        status = 'Por hacer';
      } else if (evt.to.id === 'process') {
        status = 'En curso';
      }

      this.drag = false;
      this.updateTaskStatus(status);
    },
    async updateTaskStatus(status) {
      try {
        const response = await axios.put(route('tasks.update-status', this.draggingTaskId), { status: status });

        if (response.status === 200) {
          const taskIndex = this.tasks.findIndex(item => item.id === this.draggingTaskId);
          this.tasks[taskIndex].status = status;
          console.log(this.tasks[taskIndex]);
        }
      } catch (error) {
        console.log(error);
      }
    },
    updateTask(task) {
      const taskIndex = this.tasks.findIndex(
        (item) => item.id === task.id
      );

      if (taskIndex !== -1) {
        this.tasks[taskIndex] = task;
      }

      this.updateTasksLists();
    },
    pendingTasks() {
      this.pendingTasksList = this.tasks.filter((task) => task.status === "Por hacer");
    },
    inProgressTasks() {
      this.inProgressTasksList = this.tasks.filter((task) => task.status === "En curso");
    },
    finishedTasks() {
      this.finishedTasksList = this.tasks.filter((task) => task.status === "Terminada");
    },
    updateTasksLists() {
      this.pendingTasks();
      this.inProgressTasks();
      this.finishedTasks();
    },
    async deleteProjectTask(data) {
      try {
        const response = await axios.delete(route('tasks.destroy', data));

        if (response.status === 200) {
          this.$notify({
            title: "Éxito",
            message: "Se ha eliminado correctamente",
            type: "success",
          });

          const index = this.tasks.findIndex(item => item.id === data);

          if (index !== -1) {
            this.tasks.splice(index, 1);
          }
          this.updateTasksLists();
        }
      } catch (error) {
        console.log(error);
      }
    },
},
mounted() {
    this.updateTasksLists();
  },
}
</script>