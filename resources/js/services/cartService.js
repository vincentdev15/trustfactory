import api from './api.js';

export default {
    async index(filters) {
        try {
            const res = await api.get('/carts', {
                params: filters,
            });

            return res;
        } catch (error) {
            return error;
        }
    },

    async store(cart) {
        try {
            const res = await api.post('/carts', { ...cart });

            return res;
        } catch (error) {
            return error;
        }
    },

    async show(id) {
        try {
            const res = await api.get(`/carts/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },

    async update(cart) {
        try {
            const res = await api.put(`/carts/${cart.id}`, { ...cart });

            return res;
        } catch (error) {
            return error;
        }
    },

    async delete(id) {
        try {
            const res = await api.delete(`/carts/${id}`);

            return res;
        } catch (error) {
            return error;
        }
    },
};
