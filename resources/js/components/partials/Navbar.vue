<template>
    <nav class="px-8 w-full h-20 flex items-center justify-between border-b-2 border-primary">
        <ul class="flex items-center justify-around gap-8 text-xl">
            <li class="transition-all hover:text-primary bg-primary px-3 py-2 rounded">
                <RouterLink :to="{ name: 'pages.home' }" id="home-page">
                    <img :src="image" alt="Logo Trustfactort">
                </RouterLink>
            </li>

            <li class="transition-all hover:text-primary">
                <RouterLink :to="{ name: 'public.pages.marketplace' }" id="marketplace-page">
                    Marketplace
                </RouterLink>
            </li>
        </ul>

        <ul class="flex items-center justify-around gap-8 text-xl">
            <li v-show="authStore.user && authStore.user.is_admin" class="transition-all hover:text-primary">
                <RouterLink :to="{ name: 'pages.dashboard' }" id="dashboard-page">
                    Dashboard
                </RouterLink>
            </li>

            <li v-show="authStore.user">
                Hello {{ authStore.user?.name }}
            </li>

            <li v-show="authStore.user" class="transition-all hover:text-primary">
                <RouterLink :to="{ name: 'pages.cart' }" id="cart-page">
                    <div class="relative">
                        <div>Cart</div>

                        <div v-if="itemsCount > 0" class="absolute -top-2 -right-4">
                            <div class="flex items-center justify-center size-6 text-sm rounded-full bg-primary text-light">
                                {{ itemsCount }}
                            </div>
                        </div>
                    </div>
                </RouterLink>
            </li>

            <li v-show="!authStore.user" class="transition-all hover:text-primary">
                <RouterLink :to="{ name: 'pages.login' }" id="login-page">
                    Login
                </RouterLink>
            </li>

            <li v-show="authStore.user" class="transition-all hover:text-primary">
                <div class="cursor-pointer" @click="logout()">Logout</div>
            </li>
        </ul>
    </nav>
</template>

<script setup>
    import { computed } from 'vue';
    import { useRouter } from 'vue-router';
    import authService from '@/services/authService.js';
    import { useAuthStore } from '@/stores/authStore.js';
    import image from '@img/trustfactory.png';

    const authStore = useAuthStore();

    const router = useRouter();

    async function logout() {
        const res = await authService.logout();

        if (res.status === 204) {
            router.push({ name: 'pages.home' });
        }
    }

    const itemsCount = computed(() => {
        return authStore.user?.cart?.items?.reduce(
            (total, item) => total + item.quantity,
            0
        ) ?? 0;
    });
</script>
