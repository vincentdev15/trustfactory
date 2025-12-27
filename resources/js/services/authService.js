import auth from './auth.js';
import api from './api.js';
import { useAuthStore } from '@/stores/authStore.js';

export default {
    async register(user) {
        try {
            await auth.get('/sanctum/csrf-cookie');

            const res = await auth.post('/register', { ...user });
    
            return res;
        } catch (error) {
            return error;
        }
    },

    async login(user) {
        try {
            await auth.get('/sanctum/csrf-cookie');

            const res = await auth.post('/login', { ...user });

            return res;
        } catch (error) {
            return error;
        }
    },

    async user() {
        try {
            const res = await api.get('/user');

            return res;
        } catch (error) {
            return error;
        }
    },

    async logout() {
        try {
            const res = await auth.post('/logout');

            if (res.status === 204) {
                useAuthStore().setUser(null);
            }

            return res;
        } catch (error) {
            return error;
        }
    },
};
