<template>
    <main class="rounded-[20px] border border-grayD9 p-4 lg:w-1/2 h-60">
        <div v-if="loading" class="text-xs my-4 text-center">
            Cargando <i class="fa-sharp fa-solid fa-circle-notch fa-spin ml-2 text-primary"></i>
        </div>

        <section v-else>
            <p class="text-[#6D6E72] font-bold text-sm">Cotizaciones pagadas</p>
            <article class="xl:flex space-x-4">

                <div class="xl:w-1/2">
                    <Semicircle :series="TotalMoneyPaidPercentage" />
                </div>

                <div class="xl:w-1/2">
                    <div class="flex items-center space-x-1">
                        <p class="text-gray-500 w-20">Total:</p>
                        <span class="text-black ml-3">${{ TotalMoneyQuotes?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? '0.00' }}</span>
                    </div>
                    <div class="flex items-center space-x-1">
                        <p class="text-gray-500 w-20">Pagado:</p>
                        <span class="text-black ml-3">${{ TotalMoneyPaid?.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ",") ?? '0.00' }}</span>
                    </div>
                </div>
            </article>
        </section>
    </main>
</template>

<script>
import Semicircle from '@/Components/MyComponents/Charts/RadialBar/Semicircle.vue';

export default {
    data() {
        return {
            TotalMoneyQuotes: null, //total de costos cobrados en todas las cotizaciones autorizadas
            TotalMoneyPaid: null, //monto de dinero pagado de todas las cotizaciones autorizadas
            TotalMoneyPaidPercentage: [0], //porcentaje de dinero pagado de todas las cotizaciones autorizadas
        }
    },
    components: {
        Semicircle
    },
    props: {
        items: {
            default: [],
            required: true,
            type: Array,
        },
        loading: Boolean,
    },
    methods:{
        calculateTotalMoney() {
            this.TotalMoneyQuotes = this.items
                .filter(item => item.authorized_at)
                .reduce((sum, item) => sum + item.total_cost, 0);
        },
        calculateTotalMoneyPaid() {
            this.TotalMoneyPaid = this.items
                .filter(item => item.paid_at)
                .reduce((sum, item) => sum + item.total_cost, 0);
            
        },
    },
    watch: {
        TotalMoneyPaid() {
            this.TotalMoneyPaidPercentage = [((this.TotalMoneyPaid * 100) / this.TotalMoneyQuotes).toFixed(1)];
        },
        items() {
            this.calculateTotalMoney();
            this.calculateTotalMoneyPaid();
        }
    },
    // mounted() {
    //     this.calculateTotalMoney();
    //     this.calculateTotalMoneyPaid();
    // }
};
</script>