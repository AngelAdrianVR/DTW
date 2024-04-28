<template>
    <div class="text-xs">
        <h1 class="text-primary font-bold text-sm">Prospecto</h1>
        <article class="grid md:grid-cols-8 grid-cols-3 gap-y-2 mt-1">
            <span>Empresa</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.name }}</span>
            <span>Domicilio</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.address ?? '-' }} • {{ prospect.state }}</span>
            <span>Responsable</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.responsible.name }}</span>
            <span>Creador</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.user.name }}</span>
            <span :class="prospect.abstract ? 'bg-red-200' : null">Notas</span>
            <span class="md:col-span-7 col-span-2" :class="prospect.abstract ? 'bg-red-200' : null">{{ prospect.abstract ?? '-' }}</span>
        </article>
        <h1 class="text-primary font-bold text-sm mt-3">Contacto</h1>
        <article class="grid md:grid-cols-8 grid-cols-3 gap-y-2 mt-1">
            <span>Nombre</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.contact.name }}</span>
            <span>Teléfono</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.contact.phone }}</span>
            <span>Correo electrónico</span>
            <span class="md:col-span-7 col-span-2">{{ prospect.contact.email ?? '-' }}</span>
        </article>
    </div>
</template>
<script>
export default {
    props: {
        prospect: Object,
    }
}
</script>