<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import SideNav from '@/Components/MyComponents/SideNav.vue';
import NotificationsCenter from '@/Components/MyComponents/NotificationsCenter.vue';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

defineProps({
    title: String,
});

const notifications = ref([]);

const fetchNotifications = async () => {
    try {
        const response = await axios.get(route('users.get-notifications'))

        if (response.status === 200) {
            notifications.value = response.data.items;
        }
    } catch (error) {
        console.log(error)
    }
};

const logout = () => {
    router.post(route('logout'));
};

onMounted(() => {
    fetchNotifications();
});


</script>

<template>
    <div>

        <Head :title="title" />

        <div class="overflow-hidden h-screen md:flex bg-white">
            <!-- sidenav -->
            <aside class="col-span-2">
                <SideNav />
            </aside>

            <!-- resto de pagina -->
            <main class="w-full">
                <nav class="lg:bg-white bg-grayED border-b border-gray-100">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-between h-12">
                            <div class="flex">
                                <!-- Logo -->
                                <div class="shrink-0 flex items-center lg:hidden">
                                    <Link :href="route('dashboard')">
                                    <figure class="">
                                        <img class="w-8" src="@/../../public/assets/images/dtw_logo.png" alt="logo">
                                    </figure>
                                    </Link>
                                </div>
                            </div>
                            <div class="hidden sm:flex sm:items-center sm:ms-6">
                                <!-- notifications -->
                                <NotificationsCenter class="hidden lg:block" />
                            </div>
                        </div>
                    </div>
                </nav>
                <div class="overflow-y-auto h-[calc(100vh-9.1rem)] lg:h-[calc(100vh-4.1rem)] bg-white">
                    <slot />
                </div>

            </main>
        </div>
    </div>
</template>
