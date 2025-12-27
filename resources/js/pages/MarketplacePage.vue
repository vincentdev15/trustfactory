<template>
    marketplace
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import productService from '@/services/productService.js';

    const loading = ref(false);

    const products = ref([]);

    onMounted(async () => {
        loadDatas();
    });

    const loadDatas = async () => {
        loading.value = true;

        const productsRes = await productService.index();

        if (productsRes.status === 200) {
            products.value = productsRes.data.data;
        }

        loading.value = false;
    }

    const destroy = async (id) => {
        const res = await productService.delete(id);

        if (res.status === 200) {
            const index = products.value.findIndex(product => product.id === id);

            if (index !== -1) {
                products.value.splice(index, 1);
            }
        } else {
            errors.value = res.response.data.errors;
        }
    }
</script>
