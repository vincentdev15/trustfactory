import api from './api.js';

export default {
    async market(filters) {
        try {
            const res = await api.get('/pages/market', {
                params: filters,
            });

            return res;
        } catch (error) {
            return error;
        }
    },

    async product(id) {
        try {
            const res = await api.get(`/pages/product/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },
};
