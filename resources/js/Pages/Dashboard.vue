<template>
    <AppLayout title="Dashboard">
        <main class="py-5 md:px-16 px-3">
            <h1 class="font-bold">Dashboard</h1>

            <body class="mt-9">
                <!-- Indicadores -->
                <section class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-x-5">
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Prospectos</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-user-plus text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_prospects }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Clientes</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-user-check text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_clients }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Cotizaciones</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-sheet-plastic text-xl text-gray-600"></i>
                            <p class="text-xl">{{ quotes?.length }}</p>
                        </div>
                    </article>
                    <article class="rounded-lg bg-[#F2F2F2] p-2 text-center">
                        <p>Poyectos</p>
                        <div class="flex space-x-3 justify-center my-4">
                            <i class="fa-solid fa-laptop-file text-xl text-gray-600"></i>
                            <p class="text-xl">{{ total_projects }}</p>
                        </div>
                    </article>
                </section>

                <!-- Graficas -->
                <section class="lg:flex lg:space-x-5 space-y-3 lg:space-y-0 mt-5">
                    <QuotePanel :items="quotes" :loading="loading" />                
                    <QuotePaymentPanel :items="quotes" :loading="loading" />                
                </section>
            </body>
        </main>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import QuotePanel from '@/Components/MyComponents/Dashboard/QuotePanel.vue';
import QuotePaymentPanel from '@/Components/MyComponents/Dashboard/QuotePaymentPanel.vue';

export default {
data() {
    return {
        loading: false,
        quotes: [],
    }
},
components:{
    AppLayout,
    QuotePanel,
    QuotePaymentPanel
},
props:{
    total_prospects: Number,
    total_clients: Number,
    total_projects: Number
},
methods:{
    async fetchQuotesInfo() {
        this.loading = true;
        try {
            const response = await axios.get(route('quotes.fetch-all-info'));
            if (response.status === 200) {
                this.quotes = response.data.quotes;
            }

        } catch (error) {
            console.log(error)
        } finally {
            this.loading = false;
        }
    }
},
mounted() {
        this.fetchQuotesInfo();
    }

};
</script>