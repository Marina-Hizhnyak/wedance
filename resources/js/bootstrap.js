import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// import axios from 'axios';
// window.axios = axios;


// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


// let token = document.head.querySelector('meta[name="csrf-token"]');
// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found. Please add <meta name="csrf-token" content="{{ csrf_token() }}"> to your layout.');
// }
