<template>
    <RouterLink
        class="group transition-all border-2 border-gray-300 hover:border-primary rounded-lg overflow-hidden"
        :to="{ name: 'public.pages.product', params: { id: product.id } }"
        id="product-public-page"
    >
        <article class="flex flex-col justify-between h-80 rounded-lg">
            <div class="h-60 overflow-hidden">
                <img class="transition-all duration-500 w-full h-full object-cover group-hover:scale-110" src="https://picsum.photos/300/200" alt="Fake image">
            </div>

            <div class="transition-all px-6 py-4 flex items-center justify-between gap-2 h-20 group-hover:text-primary">
                <div class="text-xl">{{ product.name }}</div>

                <div class="flex flex-col">
                    <div class="text-3xl">{{ product.price }}</div>

                    <div class="self-end text-sm italic">Stock : {{ product.stock_quantity }}</div>
                </div>
            </div>
        </article>
    </RouterLink>
</template>

<script setup>
    import { useRouter } from 'vue-router';
    import authService from '@/services/authService.js';
    import { useAuthStore } from '@/stores/authStore.js';

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    });

    const authStore = useAuthStore();

    const router = useRouter();

    async function logout() {
        const res = await authService.logout();

        if (res.status === 204) {
            router.push({ name: 'pages.home' });
        }
    }
</script>
