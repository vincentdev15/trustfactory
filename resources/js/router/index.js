import { createWebHistory, createRouter } from 'vue-router';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore.js';
import api from '@/services/api.js';

const CartPage = () => import('@/pages/CartPage.vue');
const DashboardPage = () => import('@/pages/DashboardPage.vue');
const HomePage = () => import('@/pages/HomePage.vue');
const LoginPage = () => import('@/pages/LoginPage.vue');
const MarketplacePage = () => import('@/pages/MarketplacePage.vue');
const ProductFormPage = () => import('@/pages/ProductFormPage.vue');
const ProductPage = () => import('@/pages/ProductPage.vue');
const RegistrationPage = () => import('@/pages/RegistrationPage.vue');

const routes = [
    { path: '/cart', name: 'pages.cart', component: CartPage, meta: { require_auth: true } },
    { path: '/dashboard', name: 'pages.dashboard', component: DashboardPage, meta: { require_auth: true, require_admin: true } },
    { path: '/home', name: 'pages.home', component: HomePage, meta: { require_auth: false } },
    { path: '/login', name: 'pages.login', component: LoginPage, meta: { require_auth: false } },
    { path: '/marketplace', name: 'pages.marketplace', component: MarketplacePage, meta: { require_auth: false } },
    { path: '/product/:id', name: 'pages.product', component: ProductPage, meta: { require_auth: false } },
    { path: '/products/create', name: 'pages.products.create', component: ProductFormPage, meta: { require_auth: true, require_admin: true } },
    { path: '/products/:id/edit', name: 'pages.products.edit', component: ProductFormPage, meta: { require_auth: true, require_admin: true } },
    { path: '/register', name: 'pages.register', component: RegistrationPage, meta: { require_auth: false } },

    { path: '/:pathMatch(.*)*', redirect: { name: 'pages.home' } },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior(to, from, savedPosition) {
        return { top: 0 }
    },
});

router.beforeEach(async (to, from) => {
    const authStore = useAuthStore();

    if (!authStore.initialized) {
        await api.get('/init');
    }

    const isAuthenticated = ref(false);

    isAuthenticated.value = authStore.user !== null;

    if (isAuthenticated.value) {
        if (to.meta.require_admin && !authStore.user.is_admin) {
            return { name: 'pages.marketplace' };
        }
        
        if (to.name === 'pages.login') {
            return authStore.user.is_admin ? { name: 'pages.dashboard' } : { name: 'pages.marketplace' };
        }
    }

    if (!isAuthenticated.value && to.meta.require_auth === true) {
        return { name: 'pages.login' };
    }
});

export default router;
