<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
        <product-card v-for="product in products" :key="product.id" :product="product"></product-card>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import pageService from '@/services/pageService.js';

    const loading = ref(false);

    const products = ref([]);

    onMounted(async () => {
        loadDatas();
    });

    const loadDatas = async () => {
        loading.value = true;

        const productsRes = await pageService.marketplace();

        if (productsRes.status === 200) {
            products.value = productsRes.data.data;
        }

        loading.value = false;
    }
</script>
