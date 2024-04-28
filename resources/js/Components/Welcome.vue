
<template>

    <div>
        <div class="p-6 lg:p-8 bg-white border-b border-gray-200">

            <h1 class="mt-8 text-2xl font-medium text-gray-900">
               {{ $page.props.auth.user.name }} Bienvenido al panel de administración de DTW
            </h1>

            <p class="mt-6 text-gray-500 leading-relaxed">
                Módulo dashboard en desarrollo.
            </p>
        </div>

    </div>
</template>

<script>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

export default {
    data(){
        return{
// messages: 123,
        };
    },
    components:{
        ApplicationLogo,
    },
    props:{
        messages: Array,
    },
};

</script>
