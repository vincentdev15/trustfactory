import './bootstrap';

// Vue application
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';

// Layout
import Layout from './layouts/Layout.vue';

// Loading partials
import Navbar from '@/components/partials/Navbar.vue';

// Loading ui components
import VsBox from '@/components/ui/VsBox.vue';
import VsButton from '@/components/ui/VsButton.vue';
import VsButtonAsLink from '@/components/ui/VsButtonAsLink.vue';
import VsError from '@/components/ui/VsError.vue';
import VsInput from '@/components/ui/VsInput.vue';
import VsLabel from '@/components/ui/VsLabel.vue';
import VsLink from '@/components/ui/VsLink.vue';
import VsLinkAsButton from '@/components/ui/VsLinkAsButton.vue';
import VsRadios from '@/components/ui/VsRadios.vue';
import VsSelect from '@/components/ui/VsSelect.vue';

// Loading app components
import ProductCard from '@/components/app/ProductCard.vue';
import ProductQuantity from '@/components/app/ProductQuantity.vue';

import { ZiggyVue } from '../../vendor/tightenco/ziggy';

createInertiaApp({
    id: 'trustfactory',
    resolve: name => {
        const pages = import.meta.glob('./pages/**/*.vue', { eager: true });

        const page = pages[`./pages/${name}.vue`];
        
        page.default.layout ??= Layout;

        return page;
    },
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        el.className = 'grow relative flex flex-col';

        app.use(plugin);
        app.use(ZiggyVue);

        app.component('Navbar', Navbar);

        app.component('VsBox', VsBox);
        app.component('VsButton', VsButton);
        app.component('VsButtonAsLink', VsButtonAsLink);
        app.component('VsError', VsError);
        app.component('VsInput', VsInput);
        app.component('VsLabel', VsLabel);
        app.component('VsLink', VsLink);
        app.component('VsLinkAsButton', VsLinkAsButton);
        app.component('VsRadios', VsRadios);
        app.component('VsSelect', VsSelect);

        app.component('ProductCard', ProductCard);
        app.component('ProductQuantity', ProductQuantity);

        app.mount(el);
    },
});
