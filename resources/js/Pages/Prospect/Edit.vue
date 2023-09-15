<template>
  <AppLayout title="Prospectos-editar |">
    <template #header>
      <div class="flex justify-between">
        <Link :href="route('prospects.index')" class="hover:bg-gray-300/50 rounded-full w-10 h-10 flex justify-center items-center">
          <i class="fa-solid fa-chevron-left"></i>
        </Link>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Editar {{ prospect.company }}
        </h2>
      </div>
    </template>
    <div class="lg:w-1/2 mx-auto p-3 mt-6 shadow-md lg:py-4 lg:px-5 bg-white rounded-lg">
      <form @submit.prevent="update">
        <div class="">
          <el-input v-model="form.prospect_name" placeholder="Nombre del prospecto" clearable>
                <template #prefix>
                <el-icon class="el-input__icon"><i class="fa-solid fa-user-plus"></i></el-icon>
                </template>
            </el-input>

         <InputError :message="$page.props?.errors.prospect_name" />
        </div>

        <div class="mt-3">
          <el-input v-model="form.company" placeholder="Nombre de la empresa" clearable>
            <template #prefix>
                <el-icon class="el-input__icon"><i class="fa-solid fa-building"></i></el-icon>
                </template>
            </el-input>

         <InputError :message="$page.props?.errors.company" />
        </div>

        <div class="">
        <el-input v-model="form.project_type" class="mt-3" placeholder="Tipo de proyecto" clearable>
            <template #prefix>
              <el-icon class="el-input__icon"><i class="fa-solid fa-earth-americas"></i></el-icon>
            </template>
          </el-input>

          <InputError :message="$page.props?.errors.project_type" />
        </div>

        <div class="">
          <el-input v-model="form.notes" class="mt-3 mb-6" placeholder="Notas del proyecto" clearable>
          </el-input>

          <InputError :message="$page.props?.errors.notes" class="mb-1" />
        </div>

        <PrimaryButton> Actualizar </PrimaryButton>
      </form>
    </div>
  </AppLayout>
</template>

<script>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

export default {
  data() {
    const form = useForm({
      prospect_name: this.prospect.prospect_name,
      company: this.prospect.company,
      project_type: this.prospect.project_type,
      notes: this.prospect.notes,
    });
    return {
      form,
    };
  },
  components: {
    ApplicationLogo,
    AppLayout,
    SecondaryButton,
    Link,
    TextInput,
    PrimaryButton,
    InputError
  },
  props: {
    prospect: Object
  },
  methods: {
    update() {
            this.form.put(route("prospects.update", this.prospect.id), {
                onSuccess: () => {
                    this.$notify({
                        title: 'Success',
                        message: "The prospect has been edited",
                        type: 'success'
                    });
                }
            });
        },
  },
};
</script>

