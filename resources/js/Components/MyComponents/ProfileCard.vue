<template>
    <div class="z-50 h-64 w-56 bg-white shadow-md border border-grayD9 absolute rounded-[10px]">
        <div
            class="h-[40%] bg-gradient-to-r from-gray-200 from-5% via-gray99 via-50% to-gray-200 to-95% rounded-t-[10px]">
            <button @click="$emit('close')" class="absolute top-1 right-2 text-xs text-black">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <Link :href="route('profile.show')">
            <button
                class="absolute flex items-center justify-center size-5 rounded-[5px] top-1 left-2 text-[11px] text-primary bg-primarylight">
                <i class="fa-solid fa-pen"></i>
            </button>
            </Link>
        </div>
        <figure class="size-28 rounded-[5px] bg-gray-500 absolute top-6 left-[calc(50%-3.5rem)]">
            <img :src="$page.props.auth.user.profile_photo_url" class="size-28 object-cover rounded-[5px]">
        </figure>
        <div class="flex flex-col text-black text-left mt-11 mx-7">
            <span class="text-sm">{{ $page.props.auth.user.name }}</span>
            <span class="text-[10px] text-gray66">{{ '$page.props.auth.user.employee_properties.job_position' }}</span>
            <p class="mt-3 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 text-gray66">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                </svg>
                <span class="text-[10px]">{{ $page.props.auth.user.email ?? '-' }}</span>
            </p>
            <p class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-3 text-gray66">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                </svg>
                <span class="text-[10px]">{{ '$page.props.auth.user.phone' }}</span>
            </p>
        </div>
        <form method="POST" @submit.prevent="logout" class="text-red-500 flex mr-3 mt-2 justify-end text-redpad text-xs text-right">
            <button>
                Cerrar sesión
            </button>
        </form>
    </div>
</template>
<script>
import { Link } from "@inertiajs/vue3"

export default {
    emits: ['close'],
    components: {
        Link,
    },
    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
}
</script>