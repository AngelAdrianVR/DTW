<template>
    <AppLayout title="Crear componente">
        <main class="mx-2 md:mx-12 mt-4">
            <Back />

            <section class="border border-grayD9 rounded-[10px] px-5 py-4 mx-2 md:mx-8 lg:mx-28 mt-10">
                <h1 class="font-bold">Crear componente UI</h1>
                <form @submit.prevent="store" class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <InputLabel class="mb-1 ml-2" value="Nombre del componente*" />
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

                    <div class="md:col-span-full flex justify-end mt-3">
                        <PrimaryButton :isLoading="form.processing" :disabled="form.processing">Agregar componente</PrimaryButton>
                    </div>
                </form>
            </section>
        </main>
    </AppLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Back from "@/Components/MyComponents/Back.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";

export default {
data() {
    const form = useForm({
        name: null,
        category: null,
        views: 0,
        author: 0,
        html_code: null,
        css_code: null,
        js_code: null,
    });

    return {
        form,
        categories: ["Botones", "Switches", "Estados de carga", "Otro"]
    }
},
components:{
PrimaryButton,
InputError,
InputLabel,
AppLayout,
Back,
},
props:{

},
methods:{
    store() {
      this.form.post(route('components.store'), {
        onSuccess: () => {
          this.$notify({
            title: "Correcto",
            message: "",
            type: "success",
          })
        }
      });
    },
}
}
</script>