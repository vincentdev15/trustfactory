<template>
    <vs-box>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="px-3 py-2 text-start">Name</th>

                    <th class="px-3 py-2 text-end">Price</th>

                    <th class="px-3 py-2 text-end">Stock quantity</th>

                    <th class="px-3 py-2 text-end">Low stock limit</th>

                    <th class="px-3 py-2 text-end">
                        <RouterLink class="transition-all text-primary hover:text-primary-dark" :to="{ name: 'pages.products.create' }" id="product-create-page">
                            Create a product
                        </RouterLink>
                    </th>
                </tr>
            </thead>

            <tbody>
                <tr
                    :class="{
                        'group': true,
                        'bg-red-100': product.stock_quantity - product.low_stock_limit <= 0,
                    }"
                    v-for="product in products"
                    :key="product.id"
                >
                    <td class="px-3 py-2 transition-all group-hover:bg-primary/20">{{ product.name }}</td>

                    <td class="px-3 py-2 text-end transition-all group-hover:bg-primary/20">{{ product.price }}</td>

                    <td class="px-3 py-2 text-end transition-all group-hover:bg-primary/20">{{ product.stock_quantity }}</td>

                    <td class=" px-3 py-2 text-end transition-all group-hover:bg-primary/20">{{ product.low_stock_limit }}</td>

                    <td class="flex justify-end px-3 py-2 transition-all group-hover:bg-primary/20">
                        <div class="flex items-center gap-4">
                            <RouterLink class="transition-all text-primary hover:text-primary-dark" :to="{ name: 'pages.products.edit', params: { id: product.id } }" id="product-edit-page">
                                Edit
                            </RouterLink>

                            <form @submit.prevent="destroy(product.id)">
                                <vs-button size="small" type="submit" :disabled="!product.can_delete">Delete</vs-button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </vs-box>
</template>

<script setup>
    import { ref, onMounted } from 'vue';
    import productService from '@/services/productService.js';

    const loading = ref(false);

    const products = ref([]);

    onMounted(async () => {
        loadDatas();
    });

    const loadDatas = async () => {
        loading.value = true;

        const productsRes = await productService.index();

        if (productsRes.status === 200) {
            products.value = productsRes.data.data;
        }

        loading.value = false;
    }

    const destroy = async (id) => {
        const res = await productService.destroy(id);

        if (res.status === 200) {
            const index = products.value.findIndex(product => product.id === id);

            if (index !== -1) {
                products.value.splice(index, 1);
            }
        } else {
            errors.value = res.response.data.errors;
        }
    }
</script>
