<template>
  <AppLayout title="Detalles de cliente">
    <header class="px-2 lg:px-14 mt-5">
      <Back />
      <div class="flex justify-between items-center mt-7">
        <div class="w-1/3">
          <el-select @change="$inertia.get(route('clients.show', selectedClient))" v-model="selectedClient"
            filterable placeholder="Buscar cliente" no-data-text="No hay clientes registrados"
            no-match-text="No se encontraron coincidencias">
            <el-option v-for="client in clients" :key="client.id" :label="client.name" :value="client.id" />
          </el-select>
        </div>
        <div class="flex space-x-2 w-full justify-end">
          <PrimaryButton @click="$inertia.get(route('clients.create'))">Crear cliete</PrimaryButton>
          <button @click="$inertia.get(route('clients.edit', client.id))"
            class="size-9 rounded-full bg-[#D9D9D9]">
            <i class="fa-solid fa-pen text-sm text-gray-600"></i>
          </button>
        </div>
      </div>
    </header>
    <main class="px-2 lg:px-14 mt-5">
      <h1 class="font-bold text-lg text-center">{{ client.name }}</h1>
      <el-tabs v-model="activeTab" @tab-click="handleClick">
        <el-tab-pane name="1">
          <template #label>
            <div class="flex items-center space-x-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" />
              </svg>
              <span class="text-sm">Información del cliente</span>
            </div>
          </template>
          <General :client="client" />
        </el-tab-pane>
        <el-tab-pane name="2">
          <template #label>
            <div class="flex items-center space-x-1">
              <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" height="16" width="16"
                id="Accounting-Document--Streamline-Ultimate">
                <desc>Accounting Document Streamline Icon: https://streamlinehq.com</desc>
                <path d="m8.504 5.5 0 -1" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path d="M10 5.5H7.971a1.342 1.342 0 0 0 -0.5 2.587l2.064 0.826a1.342 1.342 0 0 1 -0.5 2.587H7"
                  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                </path>
                <path d="m8.504 12.5 0 -1" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path
                  d="M20.5 22.5a1 1 0 0 1 -1 1h-15a1 1 0 0 1 -1 -1v-21a1 1 0 0 1 1 -1h9.59a1 1 0 0 1 0.71 0.293l5.414 5.414a1 1 0 0 1 0.293 0.707Z"
                  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1">
                </path>
                <path d="M14.5 0.59V5.5a1 1 0 0 0 1 1h4.91" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path d="m6.587 16.5 10.917 0" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path d="m12.52 13.5 4.984 0" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path d="m14.504 10.5 3 0" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
                <path d="m6.587 19.5 10.917 0" fill="none" stroke="currentColor" stroke-linecap="round"
                  stroke-linejoin="round" stroke-width="1"></path>
              </svg>
              <span class="text-sm">Cotizaciones</span>
            </div>
          </template>
          <Quotes :clientId="client.id" />
        </el-tab-pane>
        <el-tab-pane name="3">
          <template #label>
            <div class="flex items-center space-x-1">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="m6.75 7.5 3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0 0 21 18V6a2.25 2.25 0 0 0-2.25-2.25H5.25A2.25 2.25 0 0 0 3 6v12a2.25 2.25 0 0 0 2.25 2.25Z" />
              </svg>
              <span class="text-sm">Proyectos</span>
            </div>
          </template>
          <Projects :clientId="client.id" />
        </el-tab-pane>
      </el-tabs>
    </main>
  </AppLayout>
</template>

<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import General from "./Tabs/General.vue";
import Quotes from "./Tabs/Quotes.vue";
import Projects from "./Tabs/Projects.vue";
import Back from "@/Components/MyComponents/Back.vue";

export default {
  data() {
    return {
      activeTab: '1',
      selectedClient: this.client.id,
    };
  },
  components: {
    AppLayout,
    Loading,
    PrimaryButton,
    Back,
    General,
    Quotes,
    Projects,
  },
  props: {
    client: Object,
    clients: Array,
  },
  methods: {
    handleClick(tab) {
      // Agrega la variable currentTab=tab.props.name a la URL para mejorar la navegacion al actalizar o cambiar de pagina
      const currentURL = new URL(window.location.href);
      currentURL.searchParams.set('currentTab', tab.props.name);
      // Actualiza la URL
      window.history.replaceState({}, document.title, currentURL.href);
    }
  },
  mounted() {
    // Obtener la URL actual
    const currentURL = new URL(window.location.href);
    // Extraer el valor de 'currentTab' de los parámetros de búsqueda
    const currentTabFromURL = currentURL.searchParams.get('currentTab');

    if (currentTabFromURL) {
      this.activeTab = currentTabFromURL;
    }
  },
};
</script>