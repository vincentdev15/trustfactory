<template>
    <article class="flex flex-col justify-between rounded-lg group transition-all border-2 border-gray-300 hover:border-primary overflow-hidden">
        <RouterLink
            :to="{ name: 'pages.product', params: { id: product.id } }"
            id="product-public-page"
        >
            <div class="h-60 overflow-hidden">
                <img class="transition-all duration-500 w-full h-full object-cover group-hover:scale-110" src="https://picsum.photos/300/200" alt="Fake image">
            </div>

            <div class="transition-all px-6 py-2 border-b border-gray-100 flex items-center justify-between gap-2 group-hover:text-primary">
                <div class="text-xl">{{ product.name }}</div>

                <div class="flex flex-col">
                    <div class="text-3xl">{{ product.price }}</div>

                    <div class="self-end text-sm italic">Stock : {{ product.stock_quantity }}</div>
                </div>
            </div>
        </RouterLink>

        <div v-if="authStore.user" class="flex items-center justify-center py-2 bg-gray-100">
            <product-quantity :product="product" @product-updated="onProductUpdated"></product-quantity>
        </div>
    </article>
</template>

<script setup>
    import { useAuthStore } from '@/stores/authStore.js';
    import { useMarketStore } from '@/stores/marketStore.js';

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    });

    const authStore = useAuthStore();
    const marketStore = useMarketStore();

    const onProductUpdated = (updatedProduct) => {
        marketStore.updateProduct(updatedProduct);
    }
</script>
