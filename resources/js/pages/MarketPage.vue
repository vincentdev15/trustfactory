<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
        <product-card v-for="product in marketStore.products" :key="product.id" :product="product"></product-card>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import { useMarketStore } from '@/stores/marketStore.js';

    const marketStore = useMarketStore();

    const loading = ref(false);

    onMounted(async () => {
        loadDatas();
    });

    const loadDatas = async () => {
        loading.value = true;

        await marketStore.loadProducts();

        loading.value = false;
    }
</script>
