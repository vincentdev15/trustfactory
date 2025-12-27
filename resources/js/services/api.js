import axios from 'axios';
import { useAuthStore } from '@/stores/authStore.js';

const api = axios.create({
    baseURL: import.meta.env.VITE_API_BASE_URL+'/api/v1',
});

api.interceptors.response.use((response) => {
    const authStore = useAuthStore();

    if (response.data?.shared?.user) {
        authStore.setUser(response.data.shared.user);
    }

    return response;
});

export default api;
