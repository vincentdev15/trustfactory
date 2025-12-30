<template>
    <div class="xl:px-80 w-full h-100 flex gap-8">
        <div class="w-2/3">
            <img class="w-full h-full object-cover rounded-lg" src="https://picsum.photos/600/400" alt="Fake image">
        </div>
        
        <div class="w-1/3 flex flex-col justify-between gap-8">
            <div class="flex flex-col gap-4">
                <div class="text-5xl mt-4">{{ product.name }}</div>

                <div class="italic text-xl">Stock : {{ product.stock_quantity }}</div>
            </div>

            <div class="mb-4 flex flex-col gap-4 text-xl">
                <div class="flex items-center justify-between">
                    <div>Unit price :</div>
                    
                    <div>{{ product.price }}</div>
                </div>

                <div v-if="user" class="flex flex-col gap-4">
                    <div v-if="item">Quantity :</div>

                    <product-quantity :product="product"></product-quantity>
                </div>

                <div v-if="item" class="font-bold flex items-center justify-between">
                    <div>Total price :</div>
                    
                    <div>{{ item?.total_price ?? null }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    defineProps({
        product: Object,
    });

    const page = usePage();

    const user = computed(() => page.props.auth.user);

    const item = computed(() => {
        return user?.cart?.items?.find(
            item => item.product_id === product.id
        ) || null;
    });
</script>
