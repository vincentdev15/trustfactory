import api from './api.js';

export default {
    async index(filters) {
        try {
            const res = await api.get('/products', {
                params: filters,
            });

            return res;
        } catch (error) {
            return error;
        }
    },

    async store(product) {
        try {
            const res = await api.post('/products', { ...product });

            return res;
        } catch (error) {
            return error;
        }
    },

    async show(id) {
        try {
            const res = await api.get(`/products/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },

    async update(product) {
        try {
            const res = await api.put(`/products/${product.id}`, { ...product });

            return res;
        } catch (error) {
            return error;
        }
    },

    async delete(id) {
        try {
            const res = await api.delete(`/products/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },
};
