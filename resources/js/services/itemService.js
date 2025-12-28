import api from './api.js';

export default {
    async store(id) {
        try {
            const res = await api.post('/items', { product_id: id });

            return res;
        } catch (error) {
            return error;
        }
    },

    async update(item) {
        try {
            const res = await api.put(`/items/${item.id}`, { ...item });

            return res;
        } catch (error) {
            return error;
        }
    },

    async destroy(id) {
        try {
            const res = await api.delete(`/items/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },
};
