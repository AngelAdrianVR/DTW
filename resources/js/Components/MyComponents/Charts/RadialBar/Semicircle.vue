<template>
    <div id="chart">
        <apexchart type="radialBar" :options="chartOptions" :series="series"></apexchart>
    </div>
</template>
<script>
export default {
    data() {
        return {
            // series: [80],
            chartOptions: {
                chart: {
                    type: 'radialBar',
                    offsetY: -20,
                    sparkline: {
                        enabled: true
                    }
                },
                plotOptions: {
                    radialBar: {
                        startAngle: -90,
                        endAngle: 90,
                        track: {
                            background: "#e7e7e7",
                            strokeWidth: '97%',
                            margin: 5, // margin is in pixels
                            dropShadow: {
                                enabled: true,
                                top: 2,
                                left: 0,
                                color: '#999',
                                opacity: 1,
                                blur: 2
                            }
                        },
                        dataLabels: {
                            name: {
                                show: false
                            },
                            value: {
                                offsetY: -2,
                                fontSize: '14px',
                                color: '#000'
                            }
                        }
                    }
                },
                grid: {
                    padding: {
                        top: -10
                    }
                },
                fill: {
                    type: 'gradient',
                    gradient: {
                        shade: 'light',
                        shadeIntensity: 0.4,
                        inverseColors: false,
                        opacityFrom: 1,
                        opacityTo: 1,
                        stops: [0, 50, 53, 91],
                        // Colores iniciales; se actualizarán dinámicamente
                        colorStops: []
                    }
                },
                // labels: ['Average Results'],
            },
        }
    },
    props: {
        series: {
            type: Array,
            default: 0
        }
        // chartOptions: Object,
    },
    computed: {
        gradientColors() {
            const value = this.series[0]; // Se asume que 'series' es un array con un solo valor
            if (value <= 30) {
                return [
                    { offset: 0, color: '#FF0000' }, // Rojo en la parte superior
                    { offset: 100, color: '#FF6347' } // Un rojo más claro en la parte inferior
                ];
            } else if (value > 30 && value <= 60) {
                return [
                    { offset: 0, color: '#FFA500' }, // Naranja en la parte superior
                    { offset: 100, color: '#FFD700' } // Amarillo en la parte inferior
                ];
            } else {
                return [
                    { offset: 0, color: '#008000' }, // Verde en la parte superior
                    { offset: 100, color: '#00FF00' } // Verde más claro en la parte inferior
                ];
            }
        }
    },
    watch: {
        // Actualiza los colores del gradiente cuando cambie el valor de 'series'
        gradientColors(newColors) {
            this.chartOptions.fill.gradient.colorStops = newColors;
        }
    },
    created() {
        // Asigna el gradiente inicial al montarse el componente
        this.chartOptions.fill.gradient.colorStops = this.gradientColors;
    }
}
</script>