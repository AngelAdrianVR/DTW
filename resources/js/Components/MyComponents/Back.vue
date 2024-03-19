<template>
  <button v-if="route == null" @click="goBack" class="flex justify-center items-center rounded-full py-[9px] px-3 focus:outline-none hover-3dbuttom bg-[#EDEDED]">
        <i class="fa-solid fa-angle-left text-black"></i>
  </button>

  <button v-else @click="goToRoute" class="flex justify-center items-center rounded-full py-[9px] px-3 focus:outline-none hover-3dbuttom bg-[#EDEDED]">
        <i class="fa-solid fa-angle-left text-black"></i>
  </button>
</template>

<script>
export default {
  props:{
    route: {
      type: String,
      default: null
    }
  },
  methods: {
    goBack() {
      // Puedes personalizar esta lógica según tus necesidades
      // En este ejemplo, se utiliza la función history.back() para retroceder una página
      window.history.back();
    },
    goToRoute() {
      this.$inertia.visit(route(this.route));      
    },
  },
};
</script>
