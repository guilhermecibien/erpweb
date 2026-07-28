<template>
    <div>
        <div class="row" v-if="chart1">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header"><h3 class="box-title">{{ chart1.title }}</h3></div>
                    <div class="box-body">
                        <canvas ref="canvas1"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" v-if="chart2">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header"><h3 class="box-title">{{ chart2.title }}</h3></div>
                    <div class="box-body">
                        <canvas ref="canvas2"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api';

function buildDataset(dataset, index) {
    const colors = ['#3c8dbc', '#00a65a', '#f39c12', '#dd4b39', '#605ca8', '#00c0ef'];
    const color = colors[index % colors.length];
    return {
        label: dataset.label,
        data: dataset.data,
        borderColor: color,
        backgroundColor: color,
        fill: false,
    };
}

export default {
    name: 'SalesCharts',
    data() {
        return {
            chart1: null,
            chart2: null,
        };
    },
    mounted() {
        api.get('/home/dashboard-charts').then((response) => {
            this.chart1 = response.data.last_30_days;
            this.chart2 = response.data.current_fy;
            this.$nextTick(() => {
                this.renderChart(this.$refs.canvas1, this.chart1);
                this.renderChart(this.$refs.canvas2, this.chart2);
            });
        });
    },
    methods: {
        renderChart(canvas, chart) {
            if (!canvas || !window.Chart) {
                return;
            }
            new window.Chart(canvas.getContext('2d'), {
                type: 'line',
                data: {
                    labels: chart.labels,
                    datasets: chart.datasets.map(buildDataset),
                },
                options: {
                    legend: { position: 'top' },
                    scales: {
                        yAxes: [{ scaleLabel: { display: true, labelString: chart.axis_label } }],
                    },
                },
            });
        },
    },
};
</script>
