import { createWebHistory, createRouter } from 'vue-router';
import { ref } from 'vue';
import { useAuthStore } from '@/stores/authStore.js';
import api from '@/services/api.js';

const DashboardPage = () => import('@/pages/DashboardPage.vue');
const HomePage = () => import('@/pages/HomePage.vue');
const LoginPage = () => import('@/pages/LoginPage.vue');
const RegistrationPage = () => import('@/pages/RegistrationPage.vue');

const routes = [
    { path: '/dashboard', name: 'pages.dashboard', component: DashboardPage, meta: { require_auth: true } },
    { path: '/home', name: 'pages.home', component: HomePage, meta: { require_auth: false } },
    { path: '/login', name: 'pages.login', component: LoginPage, meta: { require_auth: false } },
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

    if (isAuthenticated.value && (to.name === 'pages.login' || to.name === 'pages.home')) {
        return { name: 'pages.dashboard' };
    }

    if (!isAuthenticated.value && to.meta.require_auth === true) {
        return { name: 'pages.login' };
    }
});

export default router;
