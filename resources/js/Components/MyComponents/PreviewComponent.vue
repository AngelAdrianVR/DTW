<template>
  <div ref="shadowContainer"></div>
</template>

<script>
export default {
  props: {
    htmlCode: String,
    cssCode: String,
    jsCode: String // Inyectamos el código JS
  },
  mounted() {
    this.attachShadowDOM();
  },
  watch: {
    htmlCode: 'updateComponent',
    cssCode: 'updateComponent',
    jsCode: 'updateComponent',
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

        // Crear la etiqueta <script> y agregar el código JS
        const scriptTag = document.createElement("script");
        scriptTag.textContent = this.jsCode;

        // Agregar los estilos, HTML y JS al Shadow DOM
        shadow.appendChild(styleTag);
        if ( this.cssCode ) {
            shadow.appendChild(wrapper);
        }
        if ( this.jsCode ) {
            shadow.appendChild(scriptTag);
        }
    },
    updateComponent() {
      const shadow = this.$refs.shadowContainer.shadowRoot;
      const wrapper = shadow.querySelector('div');
      const styleTag = shadow.querySelector('style');
      const scriptTag = shadow.querySelector('script');
      
      // Actualizamos HTML y CSS
      wrapper.innerHTML = this.htmlCode;
      styleTag.textContent = this.cssCode;
      
      // Actualizamos el código JS
      if (scriptTag) {
        scriptTag.remove(); // Remover el script previo si existe
      }
      
      const newScriptTag = document.createElement('script');
      newScriptTag.textContent = this.jsCode;
      shadow.appendChild(newScriptTag);
    }
  }
};
</script>
