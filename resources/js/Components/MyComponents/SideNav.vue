<template>
    <!-- sidebar -->
    <div class="h-screen hidden lg:block shadow-lg relative">
        <i @click="small = false" v-if="small"
            class="fa-solid fa-angle-right text-center text-xs pt-[2px] text-white rounded-full size-5 bg-primary absolute top-24 -right-3 cursor-pointer hover:scale-125 transition-transform ease-linear duration-150"></i>
        <i @click="small = true" v-else
            class="fa-solid fa-angle-left text-center text-xs pt-[2px] text-white rounded-full size-5 bg-primary absolute top-24 -right-3 cursor-pointer hover:scale-125 transition-transform ease-linear duration-150"></i>
        <div class="bg-secondary h-full overflow-auto px-1">
            <!-- Logo -->
            <div class="flex items-center justify-center mt-7">
                <Link v-if="small" :href="route('dashboard')">
                <ApplicationMark class="w-10 mx-4" />
                </Link>
                <Link v-else :href="route('dashboard')">
                <figure class="">
                    <img class="w-10" src="@/../../public/assets/images/dtw_logo.png" alt="logo">
                </figure>
                </Link>
            </div>
            <nav class="px-2 pt-10 text-white">
                <template v-if="small">
                    <div v-for="(menu, index) in menus" :key="index">
                        <button v-if="menu.show" @click="goToRoute(menu.route)" :active="menu.active"
                            :title="menu.label"
                            class="flex justify-center items-center mx-auto size-10 rounded-full mt-2 transition ease-linear duration-150"
                            :class="menu.active ? 'bg-[#D8D0E1] text-primary' : 'hover:text-primary hover:bg-[#D8D0E1] text-gray66'">
                            <span v-html="menu.icon"></span>
                        </button>
                    </div>
                </template>
                <template v-else v-for="(menu, index) in menus" :key="index">
                    <div v-if="menu.show">
                        <Accordion v-if="menu.options.length" :icon="menu.icon" :active="menu.active"
                            :title="menu.label" :id="index">
                            <div v-for="(option, index2) in menu.options" :key="index2">
                                <button @click="goToRoute(option.route)" v-if="option.show" :active="option.active"
                                    :title="option.label"
                                    class="w-full text-start pl-6 pr-2 mt-2 flex justify-betweenn text-xs rounded-md py-1 transition ease-linear duration-150"
                                    :class="option.active ? 'bg-[#D8D0E1] text-primary' : 'hover:text-primary hover:bg-[#D8D0E1] text-gray66'">
                                    <p class="w-full truncate"> {{ option.label }}</p>
                                </button>
                            </div>
                        </Accordion>
                        <button v-else-if="menu.show" @click="goToRoute(menu.route)" :active="menu.active"
                            :title="menu.label"
                            class="w-full text-start px-2 mt-2 flex justify-between text-xs rounded-md py-1 transition ease-linear duration-150"
                            :class="menu.active ? 'bg-[#D8D0E1] text-primary' : 'hover:text-primary hover:bg-[#D8D0E1] text-gray66'">
                            <p class="w-full text-sm truncate">
                                <span class="mr-2" v-html="menu.icon"></span>
                                {{ menu.label }}
                            </p>
                        </button>
                    </div>
                </template>

                <!-- Avatar de usuario -->
                <div class="mt-24 text-center">
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                        @click="showProfileCard = !showProfileCard"
                        class="flex items-center space-x-2 text-sm border rounded-full focus:outline-none transition"
                        :class="{ 'border-primary': showProfileCard, 'border-[#999999]': !showProfileCard, 'size-12 justify-center': small, 'h-12 w-full px-2 justify-between': !small }">
                        <div class="flex items-center">
                            <img class="size-9 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                                :alt="$page.props.auth.user.name">
                            <p v-if="!small" class="text-[11px] text-gray99 leading-snug text-start mt-1 ml-2">
                                {{ $page.props.auth.user.name }}</p>
                        </div>
                        <i v-if="!small" class="fa-solid fa-angle-right text-center text-xs text-[#999999]"></i>
                    </button>
                    <div v-if="showProfileCard"
                        class="z-50 h-64 w-56 bg-white shadow-md border border-grayD9 absolute bottom-3 left-[calc(100%+0.75rem)] rounded-[10px]">
                        <div
                            class="h-[40%] bg-gradient-to-r from-gray-200 from-5% via-gray99 via-50% to-gray-200 to-95% rounded-t-[10px]">
                            <button @click="showProfileCard = false" class="absolute top-1 right-2 text-xs text-black">
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
                            <img :src="$page.props.auth.user.profile_photo_url"
                                class="size-28 object-cover rounded-[5px]">
                        </figure>
                        <div class="flex flex-col text-black text-left mt-11 mx-7">
                            <span class="text-sm">{{ $page.props.auth.user.name }}</span>
                            <span class="text-[10px] text-gray66">
                                {{ $page.props.auth.user.employee_properties.job_position }}</span>
                            <p class="mt-3 flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-3 text-gray66">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                </svg>
                                <span class="text-[10px]">{{ $page.props.auth.user.email }}</span>
                            </p>
                            <p class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-3 text-gray66">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                                <span class="text-[10px]">{{ $page.props.auth.user.phone }}</span>
                            </p>
                        </div>
                        <form method="POST" @submit.prevent="logout"
                            class="flex mr-3 mt-2 justify-end text-redpad text-xs text-right">
                            <button>
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
import Accordion from './Accordion.vue';
import { Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';

export default {
    data() {
        return {
            small: true,
            showProfileCard: false,
            collapsedMenu: null,
            menus: [
                {
                    label: 'Inicio',
                    icon: '<i class="fa-solid fa-house text-base"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: true,
                    show: true,
                },
                {
                    label: 'CRM',
                    icon: '<i class="fa-solid fa-grip-lines text-base -rotate-45"></i>',
                    route: null,
                    active: route().current('prospects.*') || route().current('quotes.*') || route().current('quotes.*'),
                    options: [
                        {
                            label: 'Prospectos',
                            route: route('prospects.index'),
                            show: true,
                        },
                        {
                            label: 'Clientes',
                            route: route('dashboard'),
                            show: true,
                        },
                        {
                            label: 'Cotizaciones',
                            route: route('quotes.index'),
                            show: true,
                        },
                    ],
                    dropdown: true,
                    show: true,
                },
                {
                    label: 'PMS',
                    icon: '<i class="fa-solid fa-bahai text-base"></i>',
                    route: route('projects.index'),
                    active: route().current('projects.*'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'RRHH',
                    icon: '<i class="fa-solid fa-user-group text-base"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'Finanzas',
                    icon: '<i class="fa-solid fa-dollar-sign text-base"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'Compras',
                    icon: '<i class="fa-solid fa-bag-shopping text-base"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'Configuraciónes',
                    icon: '<i class="fa-solid fa-gears text-base"></i>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
            ],
        }
    },
    components: {
        ApplicationMark,
        Accordion,
        DropdownLink,
        Dropdown,
        Link
    },
    methods: {
        handleClickInMenu(index) {
            if (this.menus[index].options.length) {
                if (this.collapsedMenu === index) {
                    this.collapsedMenu = null;
                } else {
                    this.collapsedMenu = index;
                }
            } else {
                this.goToRoute(this.menus[index].route)
            }
        },
        goToRoute(route) {
            if (route === null) {
                this.small = false;
            } else {
                this.$inertia.get(route);
            }
        },
        logout() {
            this.$inertia.post(route('logout'));
        }
    },
    mounted() {
    }
}
</script>