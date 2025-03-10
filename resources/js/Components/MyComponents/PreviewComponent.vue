<template>
  <div ref="shadowContainer"></div>
</template>

<script>
export default {
  props: {
    htmlCode: String,
    cssCode: String
  },
  mounted() {
    this.attachShadowDOM();
  },
  methods: {
    attachShadowDOM() {
      // Crear el Shadow DOM
      const shadow = this.$refs.shadowContainer.attachShadow({ mode: "open" });

      // Crear un contenedor para el HTML del componente
      const wrapper = document.createElement("div");
      wrapper.innerHTML = this.htmlCode;

      // Crear la etiqueta <style> y agregar los estilos
      const styleTag = document.createElement("style");
      styleTag.textContent = this.cssCode;

      // Agregar estilos y contenido al Shadow DOM
      shadow.appendChild(styleTag);
      shadow.appendChild(wrapper);
    }
  }
};
</script>
