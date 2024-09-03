<template>
    <main class="py-5 px-16">
        <h1 class="font-bold">Dashboard</h1>
    </main>
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
