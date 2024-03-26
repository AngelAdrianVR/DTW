<template>
    <div class="text-xs">
        <h1 class="text-primary font-bold text-sm">Prospecto</h1>
        <article class="grid grid-cols-8 gap-y-2 mt-1">
            <span>Empresa</span>
            <span class="col-span-7">{{ prospect.name }}</span>
            <span>Domicilio</span>
            <span class="col-span-7">{{ prospect.address ?? '-' }} • {{ prospect.state }}</span>
            <span>Responsable</span>
            <span class="col-span-7">{{ prospect.responsible.name }}</span>
            <span>Creador</span>
            <span class="col-span-7">{{ prospect.user.name }}</span>
            <span :class="prospect.abstract ? 'bg-red-200' : null">Notas</span>
            <span class="col-span-7" :class="prospect.abstract ? 'bg-red-200' : null">{{ prospect.abstract ?? '-' }}</span>
        </article>
        <h1 class="text-primary font-bold text-sm mt-3">Contacto</h1>
        <article class="grid grid-cols-8 gap-y-2 mt-1">
            <span>Nombre</span>
            <span class="col-span-7">{{ prospect.contact.name }}</span>
            <span>Teléfono</span>
            <span class="col-span-7">{{ prospect.contact.phone }}</span>
            <span>Correo electrónico</span>
            <span class="col-span-7">{{ prospect.contact.email ?? '-' }}</span>
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