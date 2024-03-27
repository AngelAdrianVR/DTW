<template>
    <AppLayout :title="user.data.name">
        <figure class="relative">
            <img class="w-screen" src="../../../../public/assets/images/show_user_bg.png" alt="">
            <img class="rounded-full absolute left-20 -bottom-20 size-40" :src="user.data.profile_photo_url" alt="">
        </figure>

        <main>
            <div class="flex items-center justify-between lg:ml-72 lg:mr-7 mt-7">
                <div class="flex space-x-10">
                    <div>
                        <h1 class="font-bold text-sm">{{ user.data.name }}</h1>
                        <h2 class="text-sm">{{ user.data.employee_properties?.charge }}</h2>
                    </div>
                    <p class="text-green-600">◘{{ 'Estatus' }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <PrimaryButton @click="$inertia.get(route('users.edit', user.data.id))">Editar</PrimaryButton>
                    <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#C30303"
                        title="¿Continuar?" @confirm="deleteItem(client.id)">
                        <template #reference>
                            <i @click.stop
                                class="fa-regular fa-trash-can text-primary cursor-pointer bg-gray-200 rounded-full p-2"></i>
                        </template>
                    </el-popconfirm>
                </div>
            </div>

            <div class="text-sm mt-16 mx-36">

                <!-- Información del usuario -->
                <section class="grid grid-cols-3 gap-7">
                    <!-- Información personal -->
                    <div class="grid grid-cols-2 gap-3 self-start">
                        <p class="font-bold mb-3 col-span-full">Información personal</p>
                        <p class="text-[#373737]">Nombre:</p>
                        <p>{{ user.data.name }}</p>
                        <p class="text-[#373737]">Teléfono:</p>
                        <p>{{ user.data.employee_properties?.phone }}</p>
                        <p class="text-[#373737]">Correo electrónico:</p>
                        <p>{{ user.data.email }}</p>
                        <p class="text-[#373737]">Fecha de nacimiento:</p>
                        <p>{{ user.data.employee_properties?.birthdate?.split('T')[0] }}</p>
                        <p class="text-[#373737]">Estado civil:</p>
                        <p>{{ user.data.employee_properties?.civil_state }}</p>
                    </div>

                    <!-- Información laboral -->
                    <div class="grid grid-cols-2 gap-3 self-start">
                        <p class="font-bold mb-3 col-span-full">Información laboral</p>
                        <p class="text-[#373737]">Fecha de ingreso:</p>
                        <p>{{ user.data.created_at }}</p>
                        <p class="text-[#373737]">Departamento:</p>
                        <p>{{ user.data.employee_properties?.department }}</p>
                        <p class="text-[#373737]">Puesto:</p>
                        <p>{{ user.data.employee_properties?.charge }}</p>
                        <p class="text-[#373737]">Horario laboral:</p>
                        <p>{{ user.data.employee_properties?.schedule }}</p>
                    </div>

                    <!-- Contacto de emergencia -->
                    <div class="grid grid-cols-2 gap-3 self-start">
                        <p class="font-bold mb-3 col-span-full">Contacto de emergencia</p>
                        <p class="text-[#373737]">Nombre:</p>
                        <p>{{ user.data.emergency_contact?.name }}</p>
                        <p class="text-[#373737]">Teléfono:</p>
                        <p>{{ user.data.emergency_contact?.phone }}</p>
                        <p class="text-[#373737]">Parentesco:</p>
                        <p>{{ user.data.emergency_contact?.relationchip }}</p>
                    </div>
                </section>

                <!-- Desempeño -->
                <section class="my-10">
                    <h2 class="rounded-full bg-[#EDEDED] py-1 text-center">Desempeño</h2>
                </section>

                <!-- Expediente -->
                <section class="my-10">
                    <h2 class="rounded-full bg-[#EDEDED] py-1 text-center">Expediente</h2>

                    <div class="mt-7">

                    </div>
                </section>

            </div>

        </main>
    </AppLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";

export default {
data() {
    return {

    }
},
components:{
PrimaryButton,
AppLayout
},
props:{
user: Object,
users: Array
},
methods:{

}
}
</script>