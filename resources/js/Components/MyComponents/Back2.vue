<template>
    <button
        @click="goBack"
        class="bg-white text-center w-40 rounded-xl h-9 relative text-black text-base font-semibold group"
        type="button"
        >
        <div
            class="bg-violet-400 rounded-lg h-7 w-1/4 flex items-center justify-center absolute left-1 top-[4px] group-hover:w-[151px] z-10 duration-300"
        >
            <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 1024 1024"
            height="25px"
            width="25px"
            >
            <path
                d="M224 480h640a32 32 0 1 1 0 64H224a32 32 0 0 1 0-64z"
                fill="#000000"
            ></path>
            <path
                d="m237.248 512 265.408 265.344a32 32 0 0 1-45.312 45.312l-288-288a32 32 0 0 1 0-45.312l288-288a32 32 0 1 1 45.312 45.312L237.248 512z"
                fill="#000000"
            ></path>
            </svg>
        </div>
        <p class="translate-x-2">Regresar</p>
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
      this.$inertia.visit(this.route);      
    },
  },
};
</script>