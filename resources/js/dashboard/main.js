import { createApp } from 'vue';
import App from './components/App.vue';

const el = document.getElementById('dashboard-app');

if (el) {
    createApp(App, {
        allLocations: JSON.parse(el.dataset.allLocations || '{}'),
        dateFilters: JSON.parse(el.dataset.dateFilters || '{}'),
        i18n: JSON.parse(el.dataset.i18n || '{}'),
    }).mount(el);
}
