import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthStore = defineStore('authStore', () => {
    const user = ref(null);
    const initialized = ref(false);

    const setUser = (authUser) => {
        user.value = authUser;

        initialized.value = authUser ? true : false;
    }

    return {
        setUser,

        user,
        initialized,
    };
});
