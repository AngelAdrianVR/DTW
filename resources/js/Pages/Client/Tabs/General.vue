<template>
    <div class="text-xs">
        <h1 class="text-primary font-bold text-sm">Cliente</h1>
        <article class="grid md:grid-cols-8 grid-cols-3 gap-y-2 mt-1">
            <span>Empresa</span>
            <span class="md:col-span-7 col-span-2">{{ client.name }}</span>
            <span>RFC</span>
            <span class="md:col-span-7 col-span-2">{{ client.rfc ?? '-' }}</span>
            <span>Domicilio</span>
            <span class="md:col-span-7 col-span-2">{{ client.address ?? '-' }} • {{ client.state }}</span>
            <span>Responsable</span>
            <span class="md:col-span-7 col-span-2">{{ client.responsible.name }}</span>
            <span>Creador</span>
            <span class="md:col-span-7 col-span-2">{{ client.user.name }}</span>
            <span :class="client.notes ? 'bg-red-200' : null">Notas</span>
            <span class="md:col-span-7 col-span-2" :class="client.notes ? 'bg-red-200' : null">{{ client.notes ?? '-' }}</span>
        </article>
        <h1 class="text-primary font-bold text-sm mt-3">Contacto</h1>
        <article class="grid md:grid-cols-8 grid-cols-3 gap-y-2 mt-1">
            <span>Nombre</span>
            <span class="md:col-span-7 col-span-2">{{ client.contacts[0].name }}</span>
            <span>Teléfono</span>
            <span class="md:col-span-7 col-span-2">{{ client.contacts[0].phone }}</span>
            <span>Correo electrónico</span>
            <span class="md:col-span-7 col-span-2">{{ client.contacts[0].email ?? '-' }}</span>
        </article>
    </div>
</template>
<script>
export default {
    props: {
        client: Object,
    }
}
</script>