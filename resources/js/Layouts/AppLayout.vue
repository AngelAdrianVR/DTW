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

const showingNavigationDropdown = ref(false);
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

// const logout = () => {
//     router.post(route('logout'));
// };

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

                            <!-- Hamburger -->
                            <div class="-me-2 flex items-center sm:hidden">
                                <button class="
                                    inline-flex
                                    items-center
                                    justify-center
                                    p-2
                                    rounded-md
                                    text-gray-500
                                    focus:outline-none focus:bg-gray4 focus:text-gray-500
                                    transition ease-in-out delay-150
                                    " @click="showingNavigationDropdown = !showingNavigationDropdown">
                                    <!-- <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg> -->
                                    <i v-show="showingNavigationDropdown" class="fa-solid fa-x"></i>
                                    <svg v-show="!showingNavigationDropdown" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="36" height="36" viewBox="0 0 256 256" xml:space="preserve">
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                            <path d="M 90 43.813 c 0 -3.427 -2.559 -6.262 -5.864 -6.712 v -3.034 c 0 -11.459 -9.323 -20.783 -20.782 -20.783 H 26.646 c -11.459 0 -20.783 9.323 -20.783 20.783 v 3.034 C 2.558 37.552 0 40.386 0 43.813 c 0 1.864 0.757 3.555 1.978 4.782 C 0.757 49.822 0 51.513 0 53.377 c 0 3.427 2.558 6.262 5.864 6.713 v 2.961 c 0 7.535 6.13 13.665 13.665 13.665 h 50.942 c 7.535 0 13.665 -6.13 13.665 -13.665 V 60.09 C 87.441 59.639 90 56.804 90 53.377 c 0 -1.864 -0.757 -3.555 -1.979 -4.782 C 89.243 47.368 90 45.677 90 43.813 z M 9.864 34.067 c 0 -9.254 7.529 -16.783 16.783 -16.783 h 36.707 c 9.254 0 16.782 7.529 16.782 16.783 v 2.964 H 9.864 V 34.067 z M 6.782 41.031 h 1.082 h 74.272 h 1.082 c 1.534 0 2.782 1.248 2.782 2.782 s -1.248 2.782 -2.782 2.782 H 6.782 C 5.248 46.595 4 45.347 4 43.813 S 5.248 41.031 6.782 41.031 z M 70.471 72.716 H 19.529 c -5.329 0 -9.665 -4.336 -9.665 -9.665 v -2.892 h 38.008 c 0.321 3.441 3.225 6.144 6.748 6.144 c 1.029 0 2.006 -0.23 2.88 -0.643 c 0.559 3.179 3.34 5.602 6.676 5.602 c 3.737 0 6.778 -3.04 6.778 -6.777 v -4.325 h 9.182 v 2.892 C 80.136 68.38 75.8 72.716 70.471 72.716 z M 83.218 56.159 H 68.954 c -1.104 0 -2 0.896 -2 2 v 6.325 c 0 1.531 -1.246 2.777 -2.778 2.777 c -1.531 0 -2.777 -1.246 -2.777 -2.777 v -4.96 c 0 -1.104 -0.896 -2 -2 -2 s -2 0.896 -2 2 c 0 1.532 -1.246 2.778 -2.778 2.778 c -1.531 0 -2.777 -1.246 -2.777 -2.778 v -1.365 c 0 -1.104 -0.896 -2 -2 -2 H 6.782 C 5.248 56.159 4 54.911 4 53.377 s 1.248 -2.782 2.782 -2.782 h 76.436 c 1.534 0 2.782 1.248 2.782 2.782 S 84.752 56.159 83.218 56.159 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 45 31.035 c -1.104 0 -2 -0.896 -2 -2 v -2.117 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.117 C 47 30.139 46.104 31.035 45 31.035 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 57.631 27.245 c -1.104 0 -2 -0.896 -2 -2 v -2.117 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.117 C 59.631 26.35 58.735 27.245 57.631 27.245 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 70.263 31.035 c -1.104 0 -2 -0.896 -2 -2 v -2.117 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.117 C 72.263 30.139 71.367 31.035 70.263 31.035 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 32.369 27.245 c -1.104 0 -2 -0.896 -2 -2 v -2.117 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.117 C 34.369 26.35 33.473 27.245 32.369 27.245 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 19.737 31.035 c -1.104 0 -2 -0.896 -2 -2 v -2.117 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.117 C 21.737 30.139 20.842 31.035 19.737 31.035 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
                                    
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" 
                    class="sm:hidden z-40 rounded-tl-[6px] rounded-bl-[6px] bg-white w-4/6 absolute right-0 top-14 min-h-[30%] max-h-[90%] overflow-y-scroll overflow-x-hidden shadow-lg border pt-4">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('profile.show')" :active="route().current('profile.show')">
                            Perfil
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('prospects.index')" :active="route().current('prospects.*')">
                            Prospectos
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('clients.index')" :active="route().current('clients.*')">
                            Clientes
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('quotes.index')" :active="route().current('quotes.*')">
                            Cotizaciones
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('projects.index')" :active="route().current('projects.*')">
                            PMS
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('suscription-projects.index')" :active="route().current('suscription-projects.*')">
                            Suscripciones
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('users.index')" :active="route().current('users.*')">
                            Usuarios
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Finanzas
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Compras
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Configuraciones
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 me-3">
                                <img class="h-10 w-10 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name">
                            </div>

                            <div>
                                <p class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </p>
                                <p class="font-medium text-sm text-primary">
                                    {{ $page.props.auth.user.employee_properties?.charge }}
                                </p>
                                <p class="font-medium text-sm text-gray-500">
                                    {{ $page.props.auth.user.email }}
                                </p>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink v-if="$page.props.jetstream.hasApiFeatures" :href="route('api-tokens.index')" :active="route().current('api-tokens.index')">
                                API Tokens
                            </ResponsiveNavLink>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout" class="text-red-500 text-right px-2">
                                <button>
                                <i class="fa-solid fa-arrow-right-from-bracket mr-[7px]"></i> Cerrar sesión
                                </button>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200 dark:border-gray-600" />

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    Manage Team
                                </div>

                                <!-- Team Settings -->
                                <ResponsiveNavLink :href="route('teams.show', $page.props.auth.user.current_team)" :active="route().current('teams.show')">
                                    Team Settings
                                </ResponsiveNavLink>

                                <ResponsiveNavLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')" :active="route().current('teams.create')">
                                    Create New Team
                                </ResponsiveNavLink>

                                <!-- Team Switcher -->
                                <template v-if="$page.props.auth.user.all_teams.length > 1">
                                    <div class="border-t border-gray-200 dark:border-gray-600" />

                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        Switch Teams
                                    </div>

                                    <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                        <form @submit.prevent="switchToTeam(team)">
                                            <ResponsiveNavLink as="button">
                                                <div class="flex items-center">
                                                    <svg v-if="team.id == $page.props.auth.user.current_team_id" class="me-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    <div>{{ team.name }}</div>
                                                </div>
                                            </ResponsiveNavLink>
                                        </form>
                                    </template>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
                <div class="overflow-y-auto h-[calc(100vh-3.2rem)] bg-white">
                    <slot />
                </div>

            </main>
        </div>
    </div>
</template>
