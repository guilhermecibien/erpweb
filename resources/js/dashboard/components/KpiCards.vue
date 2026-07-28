<template>
    <div>
        <div class="row row-custom">
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-cash"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ labels.total_purchase }}</span>
                        <span class="info-box-number" v-html="format(totals.total_purchase)"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ labels.total_sell }}</span>
                        <span class="info-box-number" v-html="format(totals.total_sell)"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-yellow">
                        <i class="fa fa-dollar"></i>
                        <i class="fa fa-exclamation"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ labels.purchase_due }}</span>
                        <span class="info-box-number" v-html="format(totals.purchase_due)"></span>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-yellow">
                        <i class="ion ion-ios-paper-outline"></i>
                        <i class="fa fa-exclamation"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ labels.invoice_due }}</span>
                        <span class="info-box-number" v-html="format(totals.invoice_due)"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-custom">
            <div class="col-md-3 col-sm-6 col-xs-12 col-custom">
                <div class="info-box info-box-new-style">
                    <span class="info-box-icon bg-red"><i class="fas fa-minus-circle"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ labels.expense }}</span>
                        <span class="info-box-number" v-html="format(totals.total_expense)"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import api from '../api';

const LOADER = '<i class="fas fa-sync fa-spin fa-fw margin-bottom"></i>';

export default {
    name: 'KpiCards',
    props: {
        start: { type: String, required: true },
        end: { type: String, required: true },
        locationId: { type: [String, Number], default: '' },
        labels: { type: Object, required: true },
    },
    data() {
        return {
            loading: true,
            totals: {},
        };
    },
    watch: {
        start() { this.fetchTotals(); },
        end() { this.fetchTotals(); },
        locationId() { this.fetchTotals(); },
    },
    mounted() {
        this.fetchTotals();
    },
    methods: {
        format(value) {
            if (this.loading || value === undefined) {
                return LOADER;
            }
            return window.__currency_trans_from_en ? window.__currency_trans_from_en(value, true) : value;
        },
        fetchTotals() {
            this.loading = true;
            api.get('/home/get-totals', {
                params: { start: this.start, end: this.end, location_id: this.locationId },
            }).then((response) => {
                this.totals = response.data;
                this.loading = false;
            });
        },
    },
};
</script>
