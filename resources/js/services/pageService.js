import api from './api.js';

export default {
    async marketplace(filters) {
        try {
            const res = await api.get('/pages/marketplace', {
                params: filters,
            });

            return res;
        } catch (error) {
            return error;
        }
    },

    async product(product) {
        try {
            const res = await api.post(`/pages/product/${product.id}`);

            return res;
        } catch (error) {
            return error;
        }
    },
};
