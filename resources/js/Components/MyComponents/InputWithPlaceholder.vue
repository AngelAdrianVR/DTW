<template>
  <div class="lg:w-full">
    <div class="input-container">
      <label
        class="input-placeholder text-gray-500 bg-gray-100 px-2 rounded-sm text-sm"
        :class="{ 'active': isFocused || modelValue }"
      >
        <slot />
      </label>
      <input
        :value="modelValue"
        :step="inputStep"
        :type="inputType"
        @focus="isFocused = true"
        @blur="isFocused = false"
        @input="updateModelValue"
        class="active:ring-0 focus:ring-0 border border-[#9A9A9A] placeholder:text-[#9A9A9A] focus:border-[#7F659C] outline-none bg-transparent block w-full text-[#9A9A9A] rounded-[10px] h-9" />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modelValue: '',
      isFocused: false,
    };
  },
  props: {
    inputType: {
      type: String,
      default: 'text',
    },
    inputStep: {
      type: Number,
      default: '1',
    },
    modelValue: {
      type: String,
      required: true,
    },
  },
  watch: {
    value(newVal) {
      this.modelValue = newVal; // Actualizar modelValue cuando cambia value
    },
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {

    const updateModelValue = (event) => {
      emit('update:modelValue', event.target.value);
    };
    

    return {
      updateModelValue,
    };
  
  },
};
</script>

<style scoped>
.input-container {
  position: relative;
}
.input-placeholder {
  position: absolute;
  top: 55%;
  left: 8px;
  transform: translateY(-50%);
  transition: transform 0.2s ease-in-out, color 0.1s ease-in-out;
  pointer-events: none;
}
.input-placeholder.active {
  transform: translateY(-150%) scale(0.75);
  color: #0355b5;
}
</style>
