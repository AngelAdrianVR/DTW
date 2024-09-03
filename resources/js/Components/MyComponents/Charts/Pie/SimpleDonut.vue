<template>
    <div id="chart">
        <apexchart type="donut" :width="width" :options="chartOptions" :series="series"></apexchart>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // series: [44, 55, 41, 17, 15],
            // chartOptions: {
            //     chart: {
            //         type: 'donut',
            //     },
            //     responsive: [{
            //         breakpoint: 480,
            //         options: {
            //             chart: {
            //                 width: 200
            //             },
            //             legend: {
            //                 position: 'bottom'
            //             }
            //         }
            //     }]
            // },
        }
    },
    props: {
        width: String,
        series: Array,
        chartOptions: Object,
    }
}
</script>