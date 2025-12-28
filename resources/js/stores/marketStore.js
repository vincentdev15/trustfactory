import { defineStore } from 'pinia';
import { ref } from 'vue';
import pageService from '@/services/pageService.js';

export const useMarketStore = defineStore('marketStore', () => {
    const products = ref(null);
    
    const loadProducts = async () => {
        const productsRes = await pageService.marketplace();

        if (productsRes.status === 200) {
            products.value = productsRes.data.data;
        }
    }

    const updateProduct = async (updatedProduct) => {
        const index = products.value.findIndex(
            product => product.id === updatedProduct.id
        );

        if (index === -1) return;

        products.value.splice(index, 1, updatedProduct);
    }

    return {
        loadProducts,
        updateProduct,

        products,
    };
});
