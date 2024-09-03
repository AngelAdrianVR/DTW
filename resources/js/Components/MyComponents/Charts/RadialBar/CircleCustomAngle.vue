<template>
    <div id="chart">
        <apexchart type="radialBar" height="280" :options="chartOptions" :series="series"></apexchart>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // series: [76, 67, 61, 90], //obtenido desde el componente padre con la info real
            // chartOptions: {
            //     chart: {
            //         height: 280,
            //         type: 'radialBar',
            //     },
            //     plotOptions: {
            //         radialBar: {
            //             offsetY: 0,
            //             startAngle: 0,
            //             endAngle: 270,
            //             hollow: {
            //                 margin: 5,
            //                 size: '30%',
            //                 background: 'transparent',
            //                 image: undefined,
            //             },
            //             track: {
            //                 background: "#e7e7e7",
            //                 strokeWidth: '97%',
            //                 margin: 5, // margin is in pixels
            //                 dropShadow: {
            //                     enabled: true,
            //                     top: 2,
            //                     left: 0,
            //                     color: '#999',
            //                     opacity: 1,
            //                     blur: 2
            //                 }
            //             },
            //             dataLabels: {
            //                 name: {
            //                     show: false,
            //                 },
            //                 value: {
            //                     show: false,
            //                 }
            //             },
            //             barLabels: {
            //                 enabled: true,
            //                 useSeriesColors: true,
            //                 offsetX: -8,
            //                 fontSize: '12px',
            //                 formatter: function (seriesName, opts) {
            //                     return seriesName + ":  " + opts.w.globals.series[opts.seriesIndex]
            //                 },
            //             },
            //         }
            //     },
            //     colors: ['#1AA217', '#17A281', '#A24917'],
            //     labels: ['Tiempo ejecución', 'Tiempo pausado', 'Tiempo de falla'],
            //     responsive: [{
            //         breakpoint: 480,
            //         options: {
            //             legend: {
            //                 show: false
            //             }
            //         }
            //     }]
            // },
        }
    },
    props: {
        series: {
            type: Array,
            default: 0
        },
        chartOptions: Object,
    }
}
</script>