<template>
  <AppLayout title="Detalles de cliente">
    hola
  </AppLayout>
</template>

<script>
import Loading from "@/Components/MyComponents/Loading.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SearchInput from "@/Components/MyComponents/SearchInput.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
  data() {
    return {
      
    };
  },
  components: {
    AppLayout,
    Loading,
    SearchInput,
    PrimaryButton,
  },
  props: {
    client: Object,
  },
  methods: {
   
  }
};
</script>