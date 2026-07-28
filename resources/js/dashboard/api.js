import axios from 'axios';

const token = document.querySelector('meta[name="csrf-token"]');
if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token.getAttribute('content');
}
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default axios;
