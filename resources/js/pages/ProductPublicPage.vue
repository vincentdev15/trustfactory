<template>
    <div class="xl:px-80 w-full flex gap-8">
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

                <form @submit.prevent="updateQuantity()">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <div>Quantity :</div>

                            <vs-input class="w-20" id="quantity" name="quantity" type="number" min="0" step="1" v-model="product.quantity"></vs-input>
                        </div>
                    </div>
                </form>

                <div class="font-bold flex items-center justify-between">
                    <div>Total price :</div>
                    
                    <div>{{ product.price }}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, reactive, onMounted } from 'vue';
    import productService from '@/services/productService.js';
    import { useRoute, useRouter } from 'vue-router';

    const route = useRoute();
    const router = useRouter();
    const id = route.params.id ?? null;

    const product = reactive({});
    const errors = ref([]);
    
    onMounted(async () => {
        const res = await productService.show(id);

        if (res.status === 200) {
            Object.assign(product, res.data.data);
        }
    });

    const updateQuantity = async () => {
        // const res = await productService.update(product);

        // if (res.status === 200) {
        //     router.push({ name: 'pages.dashboard' });
        // } else {
        //     errors.value = res.response.data.errors;
        // }
    }
</script>
