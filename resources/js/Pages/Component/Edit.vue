<template>
    <AppLayout title="Editar componente">
        <main class="mx-2 md:mx-12 mt-4">
            <Back />

            <section class="border border-grayD9 rounded-[10px] px-5 py-4 mx-2 md:mx-8 lg:mx-28 mt-10">
                <h1 class="font-bold">Editar componente UI</h1>
                <section class="border border-grayD9 rounded-[10px] px-5 py-4 mx-2 md:mx-8 lg:mx-28 mt-10">
                    <h1 class="font-bold">Crear componente UI</h1>
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <InputLabel class="mb-1 ml-2" value="Nombre del componente" />
                            <el-input v-model="form.name" placeholder="Ej. Botón de agregar" clearable />
                            <InputError :message="form.errors.name" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Categoría" />
                            <el-select v-model="form.category" placeholder="Selecciona la categoría del componente">
                                <el-option v-for="item in categories" :key="item" :label="item" :value="item" />
                            </el-select>
                            <InputError :message="form.errors.category" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Autor del componente" />
                            <el-input v-model="form.author" placeholder="Escribe el creador del componente" clearable />
                            <InputError :message="form.errors.author" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Vistas de componente" />
                            <el-input-number v-model="form.views">
                                <template #prefix>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </template>
                            </el-input-number>
                            <InputError :message="form.errors.views" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Código html*" />
                            <el-input
                                v-model="form.html_code"
                                placeholder="Introduce el código html aquí"
                                type="textarea"
                                rows="5"
                            />
                            <InputError :message="form.errors.html_code" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Código CSS" />
                            <el-input
                                v-model="form.css_code"
                                placeholder="Introduce el código CSS aquí"
                                type="textarea"
                                :rows="5"
                            />
                            <InputError :message="form.errors.css_code" />
                        </div>

                        <div>
                            <InputLabel class="mb-1 ml-2" value="Código JS" />
                            <el-input
                                v-model="form.js_code"
                                placeholder="Introduce el código JS aquí"
                                type="textarea"
                                :rows="5"
                            />
                            <InputError :message="form.errors.js_code" />
                        </div>

                        <!-- Vista previa del componente -->
                        <div class="col-span-full border border-gray-300 rounded-lg p-4 bg-gray-50">
                            <div class="flex items-center justify-between">
                                <h2 class="font-semibold text-lg mb-2">Vista Previa</h2>
                                
                                <!-- Selector de color -->
                                <div class="flex items-center">
                                    <label for="colorPicker" class="text-gray-500 mr-2">Color de fondo</label>
                                    <input type="color" id="colorPicker" v-model="form.bg_color" class="cursor-pointer">
                                </div>
                            </div>
                            <div :id="`preview-${componentId}`" class="border border-gray-200 rounded-lg p-4 flex items-center justify-center min-h-56" :class="'bg-['+ form.bg_color + ']'">
                                <!-- Si es un componente hecho con tailwind se ejecuta el div, si es css se ejectuta PreviewCOmponent para activar keyframes -->
                                <PreviewComponent v-if="component.css_code" :htmlCode="component.html_code" :cssCode="component.css_code" :jsCode="component.js_code" />
                                <div v-else v-html="component.html_code"></div>
                            </div>
                        </div>

                        <div class="md:col-span-full flex justify-end space-x-4 mt-3">
                            <el-button type="primary" @click="renderPreview">Vista Previa</el-button>
                            <PrimaryButton @click="update" :isLoading="form.processing" :disabled="form.processing">Guardar cambios</PrimaryButton>
                        </div>
                    </div>
                </section>
            </section>
        </main>
    </AppLayout>
</template>

<script>
import PreviewComponent from "@/Components/MyComponents/PreviewComponent.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Back from "@/Components/MyComponents/Back.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
data() {
    const form = useForm({
        name: this.component.name,
        category: this.component.category,
        views: this.component.views,
        author: this.component.author,
        html_code: this.component.html_code,
        css_code: this.component.css_code,
        js_code: this.component.js_code,
        bg_color: this.component.bg_color ?? '#f9fafb',
    });

    return {
        form,
        categories: ["Botones", "Switches", "Estados de carga", "Checkboxes", "Tooltips", "Otro"],
        previewHtml: '', // Para almacenar el HTML de la vista previa
        componentId: Date.now(), // Identificador único para encapsular estilos
    }
},
components:{
PreviewComponent,
PrimaryButton,
InputError,
InputLabel,
AppLayout,
Back,
},
props:{
    component: Object
},
methods:{
    // renderPreview() {
    //     this.componentId = Date.now(); // Generar un nuevo ID único para evitar conflictos
    //     this.previewHtml = this.form.html_code || '<p class="text-gray-400">No hay código HTML</p>';

    //     // Eliminar estilos previos si existen
    //     const styleId = `style-preview-${this.componentId}`;
    //     let existingStyle = document.getElementById(styleId);
    //     if (existingStyle) {
    //         existingStyle.remove();
    //     }

    //     // Inyectar el CSS en el head con el ID encapsulado
    //     if (this.form.css_code) {
    //         const styleTag = document.createElement("style");
    //         styleTag.id = styleId;
    //         styleTag.innerHTML = `#preview-${this.componentId} { ${this.form.css_code} }`;
    //         document.head.appendChild(styleTag);
    //     }
    // },
    update() {
      this.form.put(route('components.update', this.component.id), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "",
            type: "success",
          })
        }
      });
    },
},
mounted(){
    // this.renderPreview();
}
}
</script>