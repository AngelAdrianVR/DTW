<template>
    <main class="rounded-[20px] border border-grayD9 p-4 w-1/2 h-60">
        <div v-if="loading" class="text-xs my-4 text-center">
            Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-primary"></i>
        </div>

        <div v-else>
            <p class="text-[#6D6E72] font-bold text-sm">Cotizaciones</p>
            <SimpleDonut width="400" :series="getQuotesSeries" :chartOptions="chartOptions" />
        </div>
    </main>
</template>

<script>
import SimpleDonut from '@/Components/MyComponents/Charts/Pie/SimpleDonut.vue';

export default {
    data() {
        return {
            loading: false, //estado de carga
            items: [], //informacion de cotizaciones recuperadas 
            chartOptions: {
                labels: ["Aceptadas", "Rechazadas", 'Esperando respuesta'],
                colors: ["#17A281", "#FF0000", "#F48B0F"],
                chart: {
                    type: 'donut',
                },
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 400
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }],
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    showAlways: true,
                                    show: true
                                },
                            }
                        }
                    }
                },
            },
        }
    },
    components: {
        SimpleDonut
    },
    props: {
        // items: {
        //     default: [],
        //     required: true,
        //     type: Array,
        // },
    },
    computed: {
        getQuotesSeries() {
            const counts = this.items.reduce((acc, item) => {
                if (item.authorized_at) acc.authorized += 1;
                if (item.rejected_at) acc.rejected += 1;
                if (item.sent_at) acc.waiting += 1;
                return acc;
            }, { authorized: 0, rejected: 0, waiting: 0 });

            return [counts.authorized, counts.rejected, counts.waiting];
        }
    },
    methods:{
        async fetchQuotesInfo() {
            this.loading = true;
            try {
                const response = await axios.get(route('quotes.fetch-all-info'));
                if (response.status === 200) {
                    this.items = response.data.quotes;
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