import api from './api.js';

export default {
    async index() {
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

    async show() {
        try {
            const res = await api.get('/carts');

            return res;
        } catch (error) {
            return error;
        }
    },

    async update(cart) {
        try {
            const res = await api.put(`/carts`, { ...cart });

            return res;
        } catch (error) {
            return error;
        }
    },

    async validate() {
        try {
            const res = await api.patch('/carts');

            return res;
        } catch (error) {
            return error;
        }
    },

    async delete() {
        try {
            const res = await api.delete('/carts');

            return res;
        } catch (error) {
            return error;
        }
    },
};
