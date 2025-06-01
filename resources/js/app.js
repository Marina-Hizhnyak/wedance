import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Wedance';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const vueApp = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue);

        window.addEventListener('inertia:error', event => {
            const status = event?.detail?.response?.status;
            if ([401, 419, 409].includes(status)) {
                console.warn('Session expired or invalid. Reloading...');
                window.location.reload();
            }
        });

        vueApp.mount(el);
        return vueApp;
    },
    progress: {
        color: '#4B5563',
    },
});
