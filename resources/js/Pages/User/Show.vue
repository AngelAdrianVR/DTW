<template>
    <AppLayout :title="user.data.name">
        <figure class="relative">
            <img class="md:h-36 h-20 w-screen" src="../../../../public/assets/images/show_user_bg.webp" alt="">
            <!-- imagen del usuario -->
            <img class="object-cover rounded-full absolute md:left-20 left-40 -bottom-16 md:-bottom-20 size-32 md:size-40" :src="user.data.profile_photo_url" alt="">
        </figure>

        <main>
            <Back class="mt-2 ml-7" />
            <div class="flex items-center justify-between ml-5 md:ml-64 lg:ml-72 lg:mr-7 mt-16 md:mt-0">
                <div class="flex space-x-10">
                    <div>
                        <h1 class="font-bold text-xl">{{ user.data.name }}</h1>
                        <h2 class="text-sm">{{ user.data.employee_properties?.charge }}</h2>
                    </div>
                    <div class="flex items-center space-x-2 self-start">
                        <i class="fa-solid fa-circle text-[7px] text-green-600"></i>
                        <p class="text-green-600">{{ 'Estatus' }}</p>
                    </div>
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

            <div class="text-sm mt-16 mx-8 lg:mx-36">

                <!-- Información del usuario -->
                <section class="md:grid grid-cols-3 gap-10">
                    <!-- Información personal -->
                    <div class="grid grid-cols-2 gap-3 self-start">
                        <p class="font-bold mb-3 mt-5 col-span-full">Información personal</p>
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
                        <p class="font-bold mb-3 mt-5 col-span-full">Información laboral</p>
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
                        <p class="font-bold mb-3 mt-5 col-span-full">Contacto de emergencia</p>
                        <p class="text-[#373737]">Nombre:</p>
                        <p>{{ user.data.emergency_contact?.name }}</p>
                        <p class="text-[#373737]">Teléfono:</p>
                        <p>{{ user.data.emergency_contact?.phone }}</p>
                        <p class="text-[#373737]">Parentesco:</p>
                        <p>{{ user.data.emergency_contact?.relationship }}</p>
                    </div>
                </section>

                <!-- Desempeño -->
                <section class="my-10">
                    <h2 class="rounded-full bg-[#EDEDED] py-1 text-center">Desempeño</h2>
                </section>

                <!-- Expediente -->
                <section class="my-10">
                    <h2 class="rounded-full bg-[#EDEDED] py-1 text-center">Expediente</h2>
                    
                    <article class="lg:w-1/3">
                        <!-- Tarjeta -->
                        <div class="mt-4 border border-[#D9D9D9] rounded-lg grid grid-cols-3 *:py-1 *:px-3">
                            <p class="font-bold col-span-2">Nombre</p>
                            <p class="font-bold text-right mr-5">Estatus</p>

                            <p class="bg-[#F2F2F2] col-span-full text-[#797979]">Contrato de trabajo</p>

                            <p class="col-span-2">Contrato de prueba</p>
                            <i class="fa-regular fa-clock text-amber-500 text-right mr-9"></i>
                            <p class="col-span-2">Contrato por tiempo indeterminado</p>
                            <i class="fa-solid fa-check text-green-500 text-right mr-9"></i>

                            <p class="bg-[#F2F2F2] col-span-full text-[#797979]">Contrato de trabajo</p>

                            <p class="col-span-2">Políticas de puntualidad y asistencia</p>
                            <i class="fa-solid fa-circle-plus text-primary text-right mr-9"></i>
                            <p class="col-span-2">Políticas de vacaciones</p>
                            <i class="fa-solid fa-circle-plus text-primary text-right mr-9"></i>
                            
                            <p class="bg-[#F2F2F2] col-span-full text-[#797979]">Documentos personales </p>

                            <p class="col-span-2">Currículum viate o solicitud de trabajo</p>
                            <i class="fa-solid fa-circle-plus text-primary text-right mr-9"></i>
                            <p class="col-span-2">INE</p>
                            <i class="fa-solid fa-circle-plus text-primary text-right mr-9"></i>
                            <p class="col-span-2">Comprobante de domicilio</p>
                            <i class="fa-solid fa-circle-plus text-primary text-right mr-9"></i>
                        </div>
                    </article>
                </section>

            </div>

        </main>
    </AppLayout>
</template>

<script>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import Back from "@/Components/MyComponents/Back.vue";

export default {
data() {
    return {

    }
},
components:{
PrimaryButton,
AppLayout,
Back
},
props:{
user: Object,
users: Array
},
methods:{

}
}
</script>