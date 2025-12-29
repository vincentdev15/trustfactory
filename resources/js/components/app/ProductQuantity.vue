<template>
    <div v-if="!isInCart">
        <form @submit.prevent="addToCart()">
            <vs-button
                type="submit"
                :inverse="true"
                :disabled="product.stock_quantity === 0"
            >Add to Cart</vs-button>
        </form>
    </div>

    <div v-else>
        <div class="flex items-center gap-2">
            <vs-button
                class="w-12"
                type="submit"
                :inverse="true"
                @click="updateQuantity(false)"
                :disabled="quantity === 0"
            >-</vs-button>

            <vs-input class="w-20 text-center" v-model="quantity"></vs-input>

            <vs-button
                class="w-12"
                type="submit"
                :inverse="true"
                @click="updateQuantity(true)"
                :disabled="quantity >= (cart.status === 'open' ? product.available_quantity : product.available_quantity + item.quantity)"
            >+</vs-button>
        </div>
    </div>
</template>

<script setup>
    import { ref, computed } from 'vue';
    import itemService from '@/services/itemService.js';
    import { useAuthStore } from '@/stores/authStore.js';

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    });

    const emit = defineEmits(['product-updated'])

    const authStore = useAuthStore();

    const errors = ref([]);

    const cart = computed(() => {
        return authStore.user?.cart ?? null;
    });

    const isInCart = computed(() => {
        if (!cart.value?.items?.length) {
            return false;
        }

        return cart.value?.items?.some(
            item => item.product_id === props.product.id
        );
    });

    const item = computed(() => {
        return cart.value?.items?.find(
            item => item.product_id === props.product.id
        ) || null;
    });

    const quantity = computed({
        get() {
            return item.value?.quantity ?? 0;
        },
        async set(value) {
            if (!item.value) return;

            const newValue = Math.max(0, Number(value));

            if (newValue === item.value.quantity) return;

            item.value.quantity = newValue;

            const res = await itemService.update(item.value);

            if (res.status === 200) {
                emit('product-updated', res.data.data, res.data.product);
            } else {
                errors.value = res.response?.data?.errors;
            }
        }
    });

    const addToCart = async () => {
        const res = await itemService.store(props.product.id);

        if (res.status === 201) {
            emit('product-updated', res.data.data);
        } else {
            errors.value = res.response.data.errors;
        }
    }

    const updateQuantity = async (add = true) => {
        if (!item.value) return;

        const newQuantity = add ? item.value.quantity + 1 : item.value.quantity - 1;

        if (newQuantity < 0) return;

        quantity.value = newQuantity;
    }
</script>
