<template>
    <AppLayout title="Dashboard">
        <main class="py-5 md:px-16 px-3">
            <h1 class="font-bold">Dashboard</h1>

            <body class="mt-9">
                <!-- Indicadores -->
                <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Prospectos</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-user-plus text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_prospects }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Clientes</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-user-check text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_clients }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Cotizaciones</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-sheet-plastic text-xl text-gray-600"></i>
                            <p class="text-xl">{{ quotes?.length }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Poyectos</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-laptop-file text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_projects }}</p>
                        </div>
                    </article>
                </section>

                <h2 class="text-lg font-bold my-7">Desempeño</h2>

                <section class="grid grid-cols-2 md:grid-cols-3 gap-5 md:mx-8 lg:mx-14">
                    <article v-for="(user) in usersData.slice(1)" :key="user" @click="handleSelectUser(user)"
                        :class="user.assigned_tasks.filter(item => item.status === 'En curso')?.length > 0 ? 'animated-border' : 'border-[#E8E8E8]'" 
                        class="rounded-2xl border-2 p-2 text-center hover:shadow-lg cursor-pointer transition-all duration-300">
                        <p class="font-bold">{{ user.name }}</p>
                        <p class="text-sm text-gray-500">Último ingreso: {{ formatDate(user.last_access) }}</p>
                        <div class="px-5 flex space-x-3 justify-start my-1 items-center text-gray-600">
                            <el-tooltip content="Tareas terminadas" placement="right">
                                <svg title="Tareas" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                                </svg>
                                <template #content>
                                    <div>
                                        <p class="text-center text-green-300">Tareas Terminadas</p>
                                    </div>
                                </template>
                            </el-tooltip>
                            <p class="text-xl">{{ user.assigned_tasks.filter(item => item.status === 'Terminada')?.length }}</p>
                        </div>
                        <div class="px-5 flex space-x-3 justify-start my-1 items-center text-gray-600">
                            <el-tooltip content="Tareas en curso" placement="right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                </svg>
                                <template #content>
                                    <div>
                                        <p class="text-center text-blue-300">Tareas en curso:</p>
                                        <p v-for="task in user.assigned_tasks.filter(item => item.status === 'En curso')" :key="task">• {{ task.title }}. ID proyecto: {{ task.project_id }}</p>
                                    </div>
                                </template>
                            </el-tooltip>
                            <p class="text-xl">{{ user.assigned_tasks.filter(item => item.status === 'En curso')?.length }}</p>
                        </div>
                        <div class="px-5 flex space-x-3 justify-start my-1 items-center text-gray-600">
                            <el-tooltip content="Tareas por hacer" placement="right">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                                </svg>
                                <template #content>
                                    <div>
                                        <p class="text-center text-orange-300">Tareas por hacer:</p>
                                        <p v-for="task in user.assigned_tasks.filter(item => item.status === 'Por hacer')" :key="task">• {{ task.title }}. ID proyecto: {{ task.project_id }}</p>
                                    </div>
                                </template>
                            </el-tooltip>
                            <p class="text-xl">{{ user.assigned_tasks.filter(item => item.status === 'Por hacer')?.length }}</p>
                        </div>
                    </article>
                </section>

                <!-- Tabla de productividad -->
                <section v-if="userSelected" class="my-8 border rounded-2xl p-2 md:p-4"
                    :class="userSelected.assigned_tasks.filter(item => item.status === 'En curso')?.length > 0 ? 'animated-border' : 'border-[#E8E8E8]'">
                    <Loading v-if="loadingWorkDays" class="text-center" />

                    <section v-else>
                        <div class="flex justify-between items-center mb-1">
                            <h2 class="text-lg font-bold mb-3">Productividad</h2>
                            <button @click="userSelected = null" class="text-gray-500 border border-gray-300 py-1 px-3 rounded-md hover:border-red-500 hover:text-red-500 transition-all ease-linear duration-300">
                                <i class="fa-solid fa-x text-xs mr-1"></i> Cerrar
                            </button>
                        </div>

                        <!-- Selector de semana -->
                        <div class="flex justify-between items-center mb-4">
                            <span></span>
                            <h2 class="text-lg font-semibold">{{ userSelected.name }}</h2>
                            <input type="week" v-model="weekInput" @change="handleWeekChange" class="border rounded p-1" />
                        </div>

                        <p class="text-right my-2 text-sm mr-3">Total de horas: <strong>{{ formattedWeekTotal }}</strong></p>

                        <div class="overflow-x-auto">
                            <table class="min-w-full border border-gray-300 rounded-md text-sm">
                                <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2 border">Días</th>
                                    <th class="p-2 border">Actividades</th>
                                    <th class="p-2 border">Horas trabajadas</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(day, index) in daysOfWeek" :key="index">
                                    <td class="p-2 border w-72">
                                    {{ capitalize(day.toLocaleDateString('es-MX', {
                                        weekday: 'long',
                                        day: 'numeric',
                                        month: 'short',
                                        year: 'numeric'
                                    })) }}
                                    </td>
                                    <td class="p-2 border">
                                    <ul>
                                        <li v-if="userWorkedDays && userWorkedDays[formatDateProductivity(day)]" v-for="entry in userWorkedDays[formatDateProductivity(day)]" :key="entry.id">
                                            <p v-for="task in entry.tasks" :key="task">• {{ task.title }}. ID: {{ task.project_id }}. - {{ formatTotalMinutes(task.minutes) }}</p>
                                        </li>
                                        <li v-else class="text-gray-400">Sin actividades registradas</li>
                                    </ul>
                                    </td>
                                    <td class="p-2 border w-40">
                                    {{
                                        formatTotalMinutes(
                                        (userWorkedDays[formatDateProductivity(day)] ?? []).reduce((sum, entry) => sum + entry.total_minutes, 0)
                                        )
                                    }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </section>

                <!-- Graficas -->
                <section class="lg:flex lg:space-x-5 space-y-3 lg:space-y-0 mt-5">
                    <QuotePanel :items="quotes" :loading="loading" />                
                    <QuotePaymentPanel :items="quotes" :loading="loading" />
                </section>

                <section class="mt-9 rounded-2xl border border-gray-300  p-4">
                    <!-- Selector de Año -->
                    <el-date-picker
                        v-model="selectedYear"
                        type="year"
                        format="YYYY"
                        value-format="YYYY"
                        placeholder="Selecciona un año"
                        class="mb-1 ml-7"
                    />
                    <h1 class="font-bold text-center">Ventas mensuales</h1>
                    <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>                
                </section>
            </body>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import QuotePanel from '@/Components/MyComponents/Dashboard/QuotePanel.vue';
import Loading from '@/Components/MyComponents/Loading.vue';
import QuotePaymentPanel from '@/Components/MyComponents/Dashboard/QuotePaymentPanel.vue';
import { ref } from "vue";
import { format } from 'date-fns';
import { es } from 'date-fns/locale';
import dayjs from 'dayjs';
import 'dayjs/locale/es';
import isoWeek from 'dayjs/plugin/isoWeek';

dayjs.extend(isoWeek);

export default {
data() {
    return {
        weekInput: dayjs().format('YYYY-[W]WW'), // Para el input tipo week
        userWorkedDays: [], // Días trabajados del usuario seleccionado
        usersRaw: [],
        userSelected : null, // Usuario seleccionado para ver su productividad
        loading: false,
        loadingWorkDays: false, // dias trabajados se la semana seleccionada 
        quotes: [],
        usersData: [],
        selectedYear: ref(new Date().getFullYear().toString()), // Año seleccionado por defecto
    };
},
components:{
    Loading,
    AppLayout,
    QuotePanel,
    QuotePaymentPanel
},
props:{
    total_prospects: Number,
    total_clients: Number,
    total_projects: Number
},
methods:{
    handleSelectUser(user) {
        this.userSelected = user;
        this.weekInput = dayjs().format('YYYY-[W]WW'); // Reiniciar al seleccionar un usuario
        this.fetchUserWorkedDays(user.id);
    },
    capitalize(str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    },
    formatDate(dateTime) {
        if ( dateTime ) {
            let parsedDate = new Date(dateTime);
            return format(parsedDate, 'd MMM, y, hh:mm a', { locale: es }); // Formato personalizado
        }
    },
    formatTotalMinutes(minutes) {
        const hrs = Math.floor(minutes / 60);
        const mins = minutes % 60;
        return `${hrs} hrs ${mins} min`;
    },
    // formatMinutes(minutes) {
    //   if (!minutes || minutes === 0) return '';
    //   const hrs = Math.floor(minutes / 60);
    //   const min = minutes % 60;
    //   return `${hrs.toString().padStart(2, '0')} hrs ${min.toString().padStart(2, '0')} min` ?? '0 hrs 0 min';
    // },
    formatDateProductivity(date) {
    return date.toISOString().split('T')[0]; // 'YYYY-MM-DD'
    },
    taskExistsOnDay(task, day) {
      return dayjs(task.start_date).format('YYYY-MM-DD') === day;
    },
    handleWeekChange(date) {
        const selectedUserId = this.userSelected?.id;
        if (selectedUserId && this.weekInput) {
            this.fetchUserWorkedDays(selectedUserId);
        }
    },
    async fetchUserWorkedDays(userId) {
        this.loadingWorkDays = true;
        try {
            const response = await axios.get(route('users.fetch-work-days', { userId, week: this.weekInput }));
            if (response.status === 200) { 
                this.userWorkedDays = response.data.workedDays;
            }
        } catch (error) {
            console.log(error);
        } finally {
            this.loadingWorkDays = false;
        }
    }, 
    async fetchQuotesInfo() {
        this.loading = true;
        try {
            const response = await axios.get(route('quotes.fetch-all-info'));
            if (response.status === 200) {
                this.quotes = response.data.quotes;
            }

        } catch (error) {
            console.log(error)
        } finally {
            this.loading = false;
        }
    },
    async fetchUsersData() {
        this.loading = true;
        try {
            const response = await axios.get(route('users.fetch-info'));
            if (response.status === 200) {
                this.usersData = response.data.usersData;
            }

        } catch (error) {
            console.log(error)
        } finally {
            this.loading = false;
        }
    }
},
computed: {
    filteredData() {
      let monthlyIncome = Array(12).fill(0); // Inicializa los ingresos en 0 para cada mes

      this.quotes.forEach((quote) => {
        if (quote.paid_at) {
          const paidDate = new Date(quote.paid_at);
          if (paidDate.getFullYear().toString() === this.selectedYear) {
            const monthIndex = paidDate.getMonth(); // Obtiene el índice del mes (0-11)
            monthlyIncome[monthIndex] += quote.total_cost; // Suma al mes correspondiente
          }
        }
      });

      return monthlyIncome;
    },
    series() {
      return [
        {
          name: "Ingresos",
          data: this.filteredData, // Datos de ingresos por mes
        },
      ];
    },
    chartOptions() {
      return {
        chart: {
          type: "area",
          height: 350,
          toolbar: { show: false },
        },
        colors: ["#4CAF50"],
        stroke: {
          curve: "smooth",
        },
        xaxis: {
          categories: [
            "Ene", "Feb", "Mar", "Abr", "May", "Jun",
            "Jul", "Ago", "Sep", "Oct", "Nov", "Dic",
          ],
        },
        yaxis: {
          title: { text: "Ingresos ($MXN)" },
        },
        tooltip: {
          y: { formatter: (value) => `$${value.toLocaleString()}` },
        },
      };
    },
    // Días de la semana actual
    daysOfWeek() {
        const [year, week] = this.weekInput.split('-W');
        const simple = new Date(year, 0, 1 + (week - 1) * 7);
        const dayOfWeek = simple.getDay();
        const monday = new Date(simple);
        monday.setDate(simple.getDate() - ((dayOfWeek + 6) % 7)); // Ajustar a lunes

        const days = [];
        for (let i = 0; i < 7; i++) {
            const date = new Date(monday);
            date.setDate(monday.getDate() + i);
            days.push(date);
        }
        return days;
    },
    tareasUnicas() {
      // Solo tareas que inician dentro de la semana seleccionada
      return this.userSelected.assigned_tasks.filter(task => {
        const start = dayjs(task.start_date).format('YYYY-MM-DD');
        return this.daysOfWeek.includes(start);
      });
    },
    totalByDay() {
      const totals = {};
      this.daysOfWeek.forEach(day => {
        totals[day] = this.tareasUnicas
          .filter(t => dayjs(t.start_date).format('YYYY-MM-DD') === day)
          .reduce((sum, t) => sum + t.minutes, 0);
      });
      return totals;
    },
    totalWeekMinutes() {
        if (!this.userWorkedDays) return 0;

        return Object.values(this.userWorkedDays).reduce((total, entries) => {
        // entries puede ser un array (varios registros en un día)
        if (Array.isArray(entries)) {
            entries.forEach(entry => {
            total += entry.total_minutes || 0;
            });
        }
        return total;
        }, 0);
    },
    formattedWeekTotal() {
        const hrs = Math.floor(this.totalWeekMinutes / 60);
        const min = this.totalWeekMinutes % 60;
        return `${hrs} hrs ${min} min`;
    }
},
mounted() {
        this.fetchQuotesInfo();
        this.fetchUsersData();
    }

};
</script>

<style>
.animated-border {
  position: relative;
  z-index: 0;
  border: 2px solid transparent;
  border-radius: 1rem;
}

.animated-border::before {
  content: "";
  position: absolute;
  top: -2px;
  left: -2px;
  right: -2px;
  bottom: -2px;
  z-index: -1;
  background: linear-gradient(120deg, #6215C0, #17EDF4, #6215C0);
  background-size: 400% 400%;
  border-radius: inherit;
  animation: borderGradientMove 5s linear infinite;
  mask:
    linear-gradient(#fff 0 0) content-box,
    linear-gradient(#fff 0 0);
  mask-composite: exclude;
  -webkit-mask:
    linear-gradient(#fff 0 0) content-box,
    linear-gradient(#fff 0 0);
  -webkit-mask-composite: destination-out;
  padding: 3px; /* grosor del borde */
}

@keyframes borderGradientMove {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

table {
  border-collapse: collapse;
}
th,
td {
  white-space: nowrap;
}
</style>