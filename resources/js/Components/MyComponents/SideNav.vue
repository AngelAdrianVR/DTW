<template>
    <!-- sidebar -->
    <div class="h-screen hidden lg:block shadow-lg relative z-10">
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
            <nav class="px-2 text-white" :class="small ? 'pt-5' : 'pt-10'">
                <template v-if="small">
                    <div v-for="(menu, index) in menus" :key="index">
                        <button v-if="menu.show" @click="goToRoute(menu.route)" :active="menu.active"
                            :title="menu.label"
                            class="flex justify-center items-center mx-auto size-10 rounded-full mt-2 transition ease-linear duration-150"
                            :class="menu.active ? 'bg-[#3E3D3F] text-primary' : 'hover:text-primary hover:bg-[#3E3D3F] text-white'">
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
                                    class="w-full text-start px-2 mt-2 flex justify-betweenn text-xs rounded-full py-1 transition ease-linear duration-150"
                                    :class="option.active ? 'bg-[#3E3D3F] text-primary' : 'hover:text-primary hover:bg-[#3E3D3F] text-white'">
                                    <p class="w-full truncate"> {{ option.label }}</p>
                                </button>
                            </div>
                        </Accordion>
                        <button v-else-if="menu.show" @click="goToRoute(menu.route)" :active="menu.active"
                            :title="menu.label"
                            class="w-full text-start px-2 mt-2 flex justify-between text-xs rounded-full py-1 transition ease-linear duration-150"
                            :class="menu.active ? 'bg-[#3E3D3F] text-primary' : 'hover:text-primary hover:bg-[#3E3D3F] text-white'">
                            <p class="w-full text-xs truncate flex items-center">
                                <span class="mr-2" v-html="menu.icon"></span>
                                {{ menu.label }}
                            </p>
                        </button>
                    </div>
                </template>

                <!-- Avatar de usuario -->
                <div class="absolute bottom-2 text-center w-full pr-6">
                    <button v-if="$page.props.jetstream.managesProfilePhotos"
                        @click="showProfileCard = !showProfileCard"
                        class="flex items-center space-x-2 text-sm border-2 rounded-full focus:outline-none transition"
                        :class="{ 'border-primary': showProfileCard, 'border-[#999999]': !showProfileCard, 'size-12 justify-center': small, 'h-12 w-full px-2 justify-between': !small }">
                        <div class="flex items-center">
                            <img class="size-9 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url"
                                :alt="$page.props.auth.user.name">
                            <p v-if="!small" class="text-[11px] text-gray99 leading-snug text-start mt-1 ml-2">
                                {{ $page.props.auth.user.name }}</p>
                        </div>
                        <i v-if="!small" class="fa-solid fa-angle-right text-center text-xs text-[#999999]"></i>
                    </button>
                    <ProfileCard v-if="showProfileCard" @close="showProfileCard = false" class="bottom-0 left-[calc(100%+0.3rem)]" />
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
import ProfileCard from './ProfileCard.vue';

export default {
    data() {
        return {
            small: true,
            showProfileCard: false,
            collapsedMenu: null,
            menus: [
                {
                    label: 'Inicio',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: true,
                    show: true,
                },
                {
                    label: 'CRM',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>',
                    route: null,
                    active: route().current('prospects.*') || route().current('clients.*') || route().current('quotes.*'),
                    options: [
                        {
                            label: 'Prospectos',
                            route: route('prospects.index'),
                            active: route().current('prospects.*'),
                            show: true,
                        },
                        {
                            label: 'Clientes',
                            route: route('clients.index'),
                            active: route().current('clients.*'),
                            show: true,
                        },
                        {
                            label: 'Cotizaciones',
                            route: route('quotes.index'),
                            active: route().current('quotes.*'),
                            show: true,
                        },
                    ],
                    dropdown: true,
                    show: true,
                },
                {
                    label: 'PMS',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="-0.565 -0.565 18 18" height="18" width="18" id="Award-Ribbon-Star-1--Streamline-Ultimate"><desc>Award Ribbon Star 1 Streamline Icon: https://streamlinehq.com</desc><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M3.378920416666667 9.167439166666666 0.5271874999999999 12.6525l2.6359375 0.5271874999999999 1.0543749999999998 3.163125 2.7723033333333333 -4.398852499999999" stroke-width="1.13"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.491079583333335 9.167439166666666 16.3428125 12.6525l-2.6359375 0.5271874999999999 -1.0543749999999998 3.163125 -2.7723033333333333 -4.398852499999999" stroke-width="1.13"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M2.6359375 6.32625c0 1.5379816666666668 0.6109681375 3.013052291666667 1.6985067458333334 4.100534666666666C5.421975825 11.514337333333334 6.896990216666666 12.1253125 8.434999999999999 12.1253125c1.5379816666666668 0 3.013052291666667 -0.6109751666666666 4.100534666666666 -1.6985278333333331C13.623087333333332 9.339302291666666 14.234062499999999 7.864231666666667 14.234062499999999 6.32625c0 -1.5380097833333333 -0.6109751666666666 -3.013024175 -1.6985278333333331 -4.100555754166667C11.448052291666666 1.1381556375 9.972981666666668 0.5271874999999999 8.434999999999999 0.5271874999999999c-1.5380097833333333 0 -3.013024175 0.6109681375 -4.100555754166667 1.6985067458333334C3.2469056375 3.313225825 2.6359375 4.788240216666667 2.6359375 6.32625Z" stroke-width="1.13"></path><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m8.80824875 3.0168199249999996 0.8772399999999999 1.727776195833333h1.4951037499999997c0.08231154166666665 -0.002010341666666667 0.16328754166666667 0.020855537499999997 0.23238425 0.06561727083333334s0.12308070833333333 0.10932462916666666 0.15492283333333334 0.18526071666666666c0.031842125 0.0759360875 0.03999595833333333 0.15970266666666666 0.023407125 0.24034829583333334 -0.016518541666666667 0.08064562916666666 -0.05700654166666667 0.15442376249999998 -0.116192125 0.21169038333333332l-1.37279625 1.3481941666666666 0.7605558333333333 1.7467690041666666c0.033529125 0.07999191666666666 0.041120625 0.168489125 0.021579541666666667 0.25297970833333333 -0.019470791666666664 0.084560875 -0.06501979166666666 0.16082733333333332 -0.13018016666666665 0.21804474999999998 -0.065160375 0.05728770833333333 -0.14669870833333332 0.09257412500000001 -0.233016875 0.10100912499999999 -0.08631816666666667 0.008435 -0.17312837499999997 -0.010473458333333333 -0.24812958333333332 -0.05398399999999999L8.434999999999999 8.026535125l-1.8381200541666667 1.0339904166666667c-0.07500823749999999 0.04351054166666666 -0.1618043875 0.062419 -0.2481366125 0.05398399999999999 -0.086332225 -0.008435 -0.16782838333333333 -0.043721416666666665 -0.23299578749999997 -0.10100912499999999 -0.06517443333333332 -0.057217416666666666 -0.11071640416666667 -0.133483875 -0.13020125416666667 -0.21804474999999998 -0.01948485 -0.08449058333333333 -0.011935524999999999 -0.17298779166666667 0.021586570833333332 -0.25297970833333333l0.7605558333333333 -1.7467690041666666 -1.37279625 -1.3510128625c-0.0591504375 -0.057259591666666665 -0.09965249583333334 -0.131037725 -0.11620618333333332 -0.21168335416666664 -0.0165536875 -0.08065265833333332 -0.008385795833333333 -0.1644192375 0.023428212499999997 -0.24034829583333334 0.03181400833333333 -0.0759360875 0.0858050375 -0.14049898333333333 0.15490174583333333 -0.18526071666666666 0.06909670833333333 -0.04476173333333333 0.15009379583333332 -0.0676276125 0.23239830833333333 -0.0656243H7.18451125l0.8779429166666667 -1.7249575000000001c0.03584875 -0.06782442916666667 0.08948129166666666 -0.12459900833333333 0.15520399999999998 -0.16419430416666667 0.06572270833333332 -0.03959529583333333 0.14100508333333334 -0.060521124999999995 0.21769329166666665 -0.060521124999999995 0.0767585 0 0.15197058333333333 0.020925829166666667 0.21769329166666665 0.060521124999999995 0.06572270833333332 0.03959529583333333 0.11935525 0.096369875 0.15520399999999998 0.16419430416666667Z" stroke-width="1.13"></path></svg>',
                    route: route('projects.index'),
                    active: route().current('projects.*'),
                    options: [],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'Suscripciones',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" height="18" width="18" id="Desktop-Dollar--Streamline-Core"><desc>Desktop Dollar Streamline Icon: https://streamlinehq.com</desc><g id="Desktop-Dollar--Streamline-Core"><path id="Vector" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M7.76062 2H1c-0.132608 0 -0.259785 0.05268 -0.353553 0.14645C0.552678 2.24021 0.5 2.36739 0.5 2.5v8c0 0.1326 0.052678 0.2598 0.146447 0.3536C0.740215 10.9473 0.867392 11 1 11h12c0.1326 0 0.2598 -0.0527 0.3536 -0.1464 0.0937 -0.0938 0.1464 -0.221 0.1464 -0.3536v-1" stroke-width="1"></path><path id="Vector_2" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m6 11 -1 2.5" stroke-width="1"></path><path id="Vector_3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="m8 11 1 2.5" stroke-width="1"></path><path id="Vector_4" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M4 13.5h6" stroke-width="1"></path><path id="Vector 3" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M13.4241 2.72214c-0.0585 -0.16561 -0.1488 -0.3162 -0.2636 -0.44444 -0.2441 -0.27278 -0.5989 -0.44445 -0.9938 -0.44445h-1.0321c-0.6573 0 -1.19014 0.53286 -1.19014 1.19018 0 0.55931 0.38944 1.04316 0.93584 1.16268l1.5713 0.34373c0.6121 0.1339 1.0484 0.67634 1.0484 1.30292 0 0.73638 -0.5969 1.33383 -1.3333 1.33383h-0.8889c-0.5806 0 -1.0744 -0.37103 -1.2575 -0.88889" stroke-width="1"></path><path id="Vector 2489" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M11.7222 1.83333V0.5" stroke-width="1"></path><path id="Vector 2490" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" d="M11.7222 8.50008V7.16675" stroke-width="1"></path></g></svg>',
                    route: route('suscription-projects.index'),
                    active: route().current('suscription-projects.*'),
                    options: [],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'RRHH',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>',
                    route: null,
                    active: route().current('users.*'),
                    options: [
                        {
                            label: 'Usuarios',
                            route: route('users.index'),
                            active: route().current('users.*'),
                            show: true,
                        },
                    ],
                    dropdown: true,
                    show: true,
                },
                {
                    label: 'Finanzas',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>',
                    route: route('dashboard'),
                    active: route().current('dashboard'),
                    options: [
                    ],
                    dropdown: false,
                    show: true,
                },
                {
                    label: 'Compras',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" /></svg>',
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
        Link,
        ProfileCard,
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