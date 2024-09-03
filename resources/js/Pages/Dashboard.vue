<template>
    <AppLayout title="Dashboard">
        <main class="py-5 px-16">
            <h1 class="font-bold">Dashboard</h1>

            <body class="mt-9">
                <QuotePanel />                
            </body>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import QuotePanel from '@/Components/MyComponents/Dashboard/QuotePanel.vue';

export default {
data() {
    return {

    }
},
components:{
    AppLayout,
    QuotePanel
},
props:{

},
methods:{

}

};
</script>