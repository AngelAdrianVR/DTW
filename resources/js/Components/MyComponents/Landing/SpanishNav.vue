<template>
    <a href="/" class="flex space-x-2 items-center !cursor-default w-24 md:w-32 mr-4">
        <img src="@/../../public/assets/images/white_logo.png" class="md:h-14 h-10" alt="logo" />
    </a>
    <section class="hidden md:block w-full rounded-full bg-[#757575] p-[6px] text-right">
        <div class="mr-12 hidden md:inline relative">
            <button class="mx-4 hover:text-black" @click="$inertia.get(route('dtw'))">Inicio</button>
            <button class="mx-4 hover:text-black" @click="route().current('dtw') ? scrollToSection('Servicios') : $inertia.get(route('dtw'))">Servicios</button>
            <button class="mx-4 hover:text-black" @click="scrollToSection('Contacto')">Contacto</button>
            <button class="mx-4 hover:text-black" @click="showMore = !showMore">
                <el-dropdown trigger="click">
                    <p class="text-white p-1">Más <i class="fa-solid fa-angle-down text-white text-xs"></i></p>
                    <template #dropdown>
                    <el-dropdown-menu>                                
                        <el-dropdown-item @click="$inertia.get(route('us'))">
                            Nosotros
                        </el-dropdown-item>                        
                        <el-dropdown-item @click="$inertia.get(route('quote-request.create'))">
                            Cotizar
                        </el-dropdown-item>                        
                        <!-- <el-dropdown-item @click="$inertia.get(route('packages'))">
                            Paquetes de programación
                        </el-dropdown-item>                         -->
                    </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </button>
            <button class="mx-4 rounded-full px-4 py-[2px] bg-[#2F2F2F]">
                <div class="flex items-center space-x-2">
                    <el-dropdown trigger="click">
                        <div class="flex items-center space-x-2">
                            <img src="@/../../public/assets/images/mexico.png" class="h-3" alt="Español" />
                            <p class="text-white font-bold p-1">
                            Español <i class="fa-solid fa-angle-down text-white text-xs"></i>
                            </p>
                        </div>
                        <template #dropdown>
                        <el-dropdown-menu>                                
                            <el-dropdown-item @click="$inertia.get(route('dtw-en'))">
                                <p class="flex items-center space-x-3 px-4">
                                <img src="@/../../public/assets/images/eua.png" class="h-3 w-7 pr-2" alt="Inglés" />
                                Inglés
                                </p>
                            </el-dropdown-item>                        
                        </el-dropdown-menu>
                        </template>
                    </el-dropdown>
                </div>
            </button>
        </div>
    </section>

    <section class="md:hidden w-full rounded-full bg-[#757575] py-[4px] text-right flex justify-between">
        <button class="mx-4 rounded-full px-4 py-[2px] bg-[#2F2F2F]">
            <div class="flex items-center space-x-2">

                <el-dropdown trigger="click">
                    <div class="flex items-center space-x-1">
                        <img src="@/../../public/assets/images/mexico.png" class="h-3" alt="Español" />
                        <p class="text-white p-1">
                        Es <i class="fa-solid fa-angle-down text-white text-xs ml-2"></i>
                        </p>
                    </div>
                    <template #dropdown>
                    <el-dropdown-menu>                                
                        <el-dropdown-item @click="$inertia.get(route('dtw-en'))">
                            <p class="flex items-center space-x-3 px-4">
                            <img src="@/../../public/assets/images/eua.png" class="h-3 w-7 pr-2" alt="Inglés" />
                            En
                            </p>
                        </el-dropdown-item>                        
                    </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </div>
        </button>

        <button @click="showMobileMenu = !showMobileMenu" class="md:hidden mr-4">
            <i class="fa-solid fa-bars text-lg"></i>
        </button>

        <!-- mobile menu (hamburger) -->
        <div v-if="showMobileMenu" 
            class="flex flex-col z-30 w-2/3 bg-[#262626] rounded-xl fixed top-20 right-1 border-white border py-1 text-white md:hidden">
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="$inertia.get(route('dtw'))">Inicio</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="route().current('dtw') ? scrollToSection('Servicios') : $inertia.get(route('dtw'))">Servicios</button>
            <button class="mx-1 py-2 hover:bg-[#7F659C] rounded-lg" @click="scrollToSection('Contacto')">Contacto</button>
            <button class="mx-2 py-2 hover:bg-[#7F659C] rounded-lg" @click="showMore = !showMore">Más <i class="fa-solid fa-angle-down ml-1 text-sm"></i></button>
            <ul v-if="showMore" class="text-center p-3">
                <li @click="$inertia.get(route('us'))" class="hover:bg-[#7F659C] rounded-lg p-1">Nosotros</li>
                <li @click="$inertia.get(route('quote-request.create'))" class="hover:bg-[#7F659C] rounded-lg p-1">Cotizar</li>
                <!-- <li @click="$inertia.get(route('packages'))" class="hover:bg-[#7F659C] rounded-lg p-1">Paquetes programación</li> -->
            </ul>
            <!-- <button class="mx-2"> 
                <el-dropdown trigger="click">
                    <div class="flex items-center space-x-2">
                        <img src="@/../../public/assets/images/mexico.png" class="h-3" alt="Español" />
                        <p class="text-white font-bold p-1">
                        Español <i class="fa-solid fa-angle-down text-white text-xs"></i>
                        </p>
                    </div>
                    <template #dropdown>
                    <el-dropdown-menu>                                
                        <el-dropdown-item @click="$inertia.get(route('dtw-en'))">
                            <p class="flex items-center space-x-3 px-4">
                            <img src="@/../../public/assets/images/eua.png" class="h-3 w-7 pr-2" alt="Español" />
                            Inglés
                            </p>
                        </el-dropdown-item>                        
                    </el-dropdown-menu>
                    </template>
                </el-dropdown>
            </button> -->
        </div>
    </section>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
data () {
    return {
        showMobileMenu: false,
        showMore: false,
    }
},
components:{
    Link,
},
props:{

},
emits: ['scrolling'],
methods:{
    scrollToSection(section) {
        this.$emit('scrolling', section);
    }
}
};
</script>
