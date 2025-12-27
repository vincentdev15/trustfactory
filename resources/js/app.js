import './bootstrap';

// Vue application
import { createApp } from 'vue';

// Layout
import Layout from './layouts/Layout.vue';

const app = createApp(Layout);

// Loading partials
import Navbar from '@/components/partials/Navbar.vue';

app.component('Navbar', Navbar);

// Loading ui components
import VsBox from '@/components/ui/VsBox.vue';
import VsButton from '@/components/ui/VsButton.vue';
import VsError from '@/components/ui/VsError.vue';
import VsInput from '@/components/ui/VsInput.vue';
import VsLabel from '@/components/ui/VsLabel.vue';
import VsLink from '@/components/ui/VsLink.vue';
import VsLinkAsButton from '@/components/ui/VsLinkAsButton.vue';
import VsRadios from '@/components/ui/VsRadios.vue';
import VsSelect from '@/components/ui/VsSelect.vue';

app.component('VsBox', VsBox);
app.component('VsButton', VsButton);
app.component('VsError', VsError);
app.component('VsInput', VsInput);
app.component('VsLabel', VsLabel);
app.component('VsLink', VsLink);
app.component('VsLinkAsButton', VsLinkAsButton);
app.component('VsRadios', VsRadios);
app.component('VsSelect', VsSelect);

// Store
import { createPinia } from 'pinia';

const pinia = createPinia();

// Router
import router from './router';

// Application
app
    .use(router)
    .use(pinia);

app.mount('#trustfactory');
