<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ labels.product }}</th>
                <th>{{ labels.location }}</th>
                <th>{{ labels.stock }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading"><td colspan="3">...</td></tr>
            <tr v-else-if="rows.length === 0"><td colspan="3">{{ labels.empty }}</td></tr>
            <tr v-for="(row, index) in rows" :key="index" v-else>
                <td>{{ row.product }}</td>
                <td>{{ row.location }}</td>
                <td>{{ formatStock(row.stock) }} {{ row.unit }}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import api from '../api';

export default {
    name: 'StockAlertTable',
    props: {
        labels: { type: Object, required: true },
    },
    data() {
        return {
            loading: true,
            rows: [],
        };
    },
    mounted() {
        api.get('/home/product-stock-alert').then((response) => {
            this.rows = response.data;
            this.loading = false;
        });
    },
    methods: {
        formatStock(value) {
            return window.__currency_trans_from_en
                ? window.__currency_trans_from_en(value, false, false, undefined, true)
                : value;
        },
    },
};
</script>
