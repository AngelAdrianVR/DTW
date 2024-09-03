<template>
    <AppLayout title="Dashboard">
        <main class="py-5 px-16">
            <h1 class="font-bold">Dashboard</h1>

            <body class="mt-9">
                <div class="flex space-x-5">
                    <QuotePanel :items="quotes" :loading="loading" />                
                    <QuotePaymentPanel :items="quotes" :loading="loading" />                
                </div>
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