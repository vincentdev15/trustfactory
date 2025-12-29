import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useAuthStore = defineStore('authStore', () => {
    const user = ref(null);
    const initialized = ref(false);

    const setUser = (authUser) => {
        user.value = authUser;

        initialized.value = true;
    }

    const updateItem = async (updatedItem) => {
        const index = user.value?.cart?.items?.findIndex(
            item => item.id === updatedItem.id
        ) ?? null;

        if (index === -1) return;

        if (index) {
            user.value?.cart?.items?.splice(index, 1, updatedItem);
        }
    }

    return {
        setUser,
        updateItem,

        user,
        initialized,
    };
});
