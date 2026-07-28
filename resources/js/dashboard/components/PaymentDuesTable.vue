<template>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>{{ nameLabel }}</th>
                <th>{{ refLabel }}</th>
                <th>{{ dueLabel }}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="loading"><td colspan="3">...</td></tr>
            <tr v-else-if="rows.length === 0"><td colspan="3">{{ emptyLabel }}</td></tr>
            <tr v-for="row in rows" :key="row.id" v-else>
                <td>{{ row[nameField] }}</td>
                <td>
                    <a
                        v-if="row.can_view"
                        href="#"
                        :data-href="viewUrlBase + '/' + row.id"
                        class="btn-modal"
                        data-container=".view_modal"
                    >{{ row[refField] }}</a>
                    <span v-else>{{ row[refField] }}</span>
                </td>
                <td v-html="formatDue(row.due)"></td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import api from '../api';

export default {
    name: 'PaymentDuesTable',
    props: {
        endpoint: { type: String, required: true },
        viewUrlBase: { type: String, required: true },
        nameField: { type: String, required: true },
        refField: { type: String, required: true },
        nameLabel: { type: String, required: true },
        refLabel: { type: String, required: true },
        dueLabel: { type: String, required: true },
        emptyLabel: { type: String, default: '' },
    },
    data() {
        return {
            loading: true,
            rows: [],
        };
    },
    mounted() {
        api.get(this.endpoint).then((response) => {
            this.rows = response.data;
            this.loading = false;
        });
    },
    methods: {
        formatDue(value) {
            return window.__currency_trans_from_en ? window.__currency_trans_from_en(value, true) : value;
        },
    },
};
</script>
