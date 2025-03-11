<template>
  <ins class="adsbygoogle"
       style="display:block"
       data-ad-client="ca-pub-6559299449754042"
       data-ad-slot="3738960683"
       data-ad-format="auto"
       data-full-width-responsive="true">
  </ins>
</template>

<script>
export default {
  name: "GoogleAd",
  mounted() {
    // Espera a que el script de adsbygoogle esté disponible y ejecuta el anuncio
    this.loadAds();
  },
  methods: {
    loadAds() {
      if (window.adsbygoogle) {
        window.adsbygoogle.push({});
      }
    }
  }
};
</script>
