<template>
    <div class="md:grid grid-cols-2 text-sm">
        <div class="grid grid-cols-2 text-left gap-y-3 p-4 md:ml-10 items-center">
            <p class="text-secondary font-bold col-span-2 mb-2">Información del proyecto</p>

            <span class="text-[#6A6A6A]">Nombre del proyecto</span>
            <span>{{ project.name }}</span>
            <span class="text-[#6A6A6A]">Creado por</span>
            <span>{{ project.user?.name }}</span>
            <span class="text-[#6A6A6A]">Creado el</span>
            <span>{{ project.created_at }}</span>
            <span class="text-[#6A6A6A]">Días hábiles</span>
            <span>{{ project.hours_work/8 }}</span>
            <span class="text-[#6A6A6A]">Fecha de inicio</span>
            <span>{{ project.start_date }}</span>
            <span class="text-[#6A6A6A]">Fecha esperada de fin</span>
            <span>{{ project.estimated_date }}</span>
            <span class="text-[#6A6A6A]">Fecha final</span>
            <span>{{ project.finish_date ?? '-' }}</span>
            <span class="text-[#6A6A6A]">Descripción</span>
            <span v-html="project.description"></span>
        </div>

        <div class="grid grid-cols-2 text-left p-4 md:ml-10 items-center gap-y-3 self-start">
            <p class="text-secondary font-bold col-span-2">Campos adicionales</p>

            <span class="text-[#6A6A6A] mt-2">Cliente</span>
            <span>{{ project.client?.name }}</span>
            <span class="text-[#6A6A6A] mt-2">Cotización</span>
            <span>{{ project.quote?.quote_name }}</span>
            <span class="text-[#6A6A6A] mt-2">Condiciones de pago</span>
            <span>{{ project.payment_method }}</span>
            <span class="text-[#6A6A6A] mt-2">Requiere factura</span>
            <span>{{ project.invoice == true ? 'Sí' : 'No' }}</span>

            <p class="text-secondary font-bold col-span-2 mb-2 mt-5">Documentos adjuntos</p>
            <li v-for="file in project.media" :key="file" class="flex items-center justify-between col-span-full">
            <a :href="file.original_url" target="_blank" class="flex items-center">
                <i :class="getFileTypeIcon(file.file_name)"></i>
                <span class="ml-2">{{ file.file_name }}</span>
            </a>
            </li>
        </div>
    </div>
</template>

<script>
export default {
data() {
    return {

    }
},
components:{

},
props:{
project: Object
},
methods:{
    getFileTypeIcon(fileName) {
      // Asocia extensiones de archivo a iconos
      const fileExtension = fileName.split('.').pop().toLowerCase();
      switch (fileExtension) {
        case 'pdf':
          return 'fa-regular fa-file-pdf text-red-700';
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
          return 'fa-regular fa-image text-blue-300';
        default:
          return 'fa-regular fa-file-lines';
      }
    },
}
}
</script>