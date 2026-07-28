<template>
    <div>
        <div class="row">
            <div class="col-md-4 col-xs-12" v-if="hasMultipleLocations">
                <location-select
                    v-model="locationId"
                    :locations="allLocations"
                    :placeholder="i18n.select_location"
                />
            </div>
            <div class="col-md-8 col-xs-12">
                <date-range-filter v-model="dateKey" :options="dateOptions" />
            </div>
        </div>
        <br>

        <kpi-cards :start="dateRange.start" :end="dateRange.end" :location-id="locationId" :labels="i18n.kpi" />

        <sales-charts v-if="hasLocations" />

        <div class="row">
            <div class="col-sm-6">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title">{{ i18n.sales_payment_dues }}</h3></div>
                    <div class="box-body">
                        <payment-dues-table
                            endpoint="/home/sales-payment-dues"
                            view-url-base="/sells"
                            name-field="customer"
                            ref-field="invoice_no"
                            :name-label="i18n.customer"
                            :ref-label="i18n.invoice_no"
                            :due-label="i18n.due_amount"
                            :empty-label="i18n.no_data"
                        />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title">{{ i18n.purchase_payment_dues }}</h3></div>
                    <div class="box-body">
                        <payment-dues-table
                            endpoint="/home/purchase-payment-dues"
                            view-url-base="/purchases"
                            name-field="supplier"
                            ref-field="ref_no"
                            :name-label="i18n.supplier"
                            :ref-label="i18n.ref_no"
                            :due-label="i18n.due_amount"
                            :empty-label="i18n.no_data"
                        />
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="box box-warning">
                    <div class="box-header"><h3 class="box-title">{{ i18n.product_stock_alert }}</h3></div>
                    <div class="box-body">
                        <stock-alert-table :labels="i18n.stock_alert" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DateRangeFilter from './DateRangeFilter.vue';
import LocationSelect from './LocationSelect.vue';
import KpiCards from './KpiCards.vue';
import SalesCharts from './SalesCharts.vue';
import PaymentDuesTable from './PaymentDuesTable.vue';
import StockAlertTable from './StockAlertTable.vue';

export default {
    name: 'DashboardApp',
    components: {
        DateRangeFilter,
        LocationSelect,
        KpiCards,
        SalesCharts,
        PaymentDuesTable,
        StockAlertTable,
    },
    props: {
        allLocations: { type: Object, required: true },
        dateFilters: { type: Object, required: true },
        i18n: { type: Object, required: true },
    },
    data() {
        const today = new Date().toISOString().slice(0, 10);
        return {
            dateKey: 'today',
            locationId: '',
            dateOptions: [
                { key: 'today', label: this.i18n.today, start: today, end: today },
                { key: 'this_week', label: this.i18n.this_week, start: this.dateFilters.this_week.start, end: this.dateFilters.this_week.end },
                { key: 'this_month', label: this.i18n.this_month, start: this.dateFilters.this_month.start, end: this.dateFilters.this_month.end },
                { key: 'this_fy', label: this.i18n.this_year, start: this.dateFilters.this_fy.start, end: this.dateFilters.this_fy.end },
            ],
        };
    },
    computed: {
        hasMultipleLocations() {
            return Object.keys(this.allLocations).length > 1;
        },
        hasLocations() {
            return Object.keys(this.allLocations).length > 0;
        },
        dateRange() {
            const option = this.dateOptions.find((o) => o.key === this.dateKey);
            return { start: option.start, end: option.end };
        },
    },
};
</script>
