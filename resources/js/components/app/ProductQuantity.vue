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
                :disabled="quantity >= (page.props.auth.user?.cart?.status === 'open' ? product.available_quantity : product.available_quantity + item.quantity)"
            >+</vs-button>
        </div>
    </div>
</template>

<script setup>
    import { router, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    const props = defineProps({
        product: {
            type: Object,
            required: true,
        },
    });

    const page = usePage();

    const emit = defineEmits(['item-quantity-updated'])

    const isInCart = computed(() => {
        if (!page.props.auth.user?.cart?.items?.length) {
            return false;
        }

        return page.props.auth.user?.cart?.items?.some(
            item => item.product_id === props.product.id
        );
    });

    const item = computed(() => {
        return page.props.auth.user?.cart?.items?.find(
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

            router.put(route('items.update', { item: item.value.id }),
                { ...item.value },
                {
                    onSuccess: () => {
                        emit('item-quantity-updated', item.value);
                    },
                    onError: (errors) => {
                        errors.value = res.response?.data?.errors;
                    },
                    onFinish: () => {
                        //
                    }
                }
            );
        }
    });

    const addToCart = async () => {
        router.post(route('items.store'),
            { product_id: props.product.id },
            {
                onSuccess: () => {
                    emit('item-quantity-updated', item.value);
                },
                onError: (errors) => {
                    errors.value = errors;
                },
                onFinish: () => {
                    //
                }
            }
        );
    }

    const updateQuantity = async (add = true) => {
        if (!item.value) return;

        const newQuantity = add ? item.value.quantity + 1 : item.value.quantity - 1;

        if (newQuantity < 0) return;

        quantity.value = newQuantity;
    }
</script>
