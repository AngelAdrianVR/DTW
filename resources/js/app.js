import './bootstrap';
import '../css/app.css';

import './vendor/css/animate.css';
import './vendor/css/flex-slider.css';
import './vendor/css/owl.css';
import './vendor/css/templatemo-cyborg-gaming.css';

import './vendor/bootstrap/js/bootstrap.min.js'
import './vendor/jquery/jquery.min.js';
import './vendor/js/isotope';
import './vendor/js/owl-carousel';
import './vendor/js/popup';
import './vendor/js/tabs';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Toast from "vue-toastification";
// Import the CSS or use your own!
import "vue-toastification/dist/index.css";

import ElementPlus from 'element-plus'
import 'element-plus/dist/index.css'

const options = {
    timeout: 4000,
};

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(Toast, options)
            .use(ElementPlus)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
