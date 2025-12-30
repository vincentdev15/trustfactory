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
                        <vs-link :href="route('products.create')" id="product-create-page">
                            Create a product
                        </vs-link>
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
                            <vs-link :href="route('products.edit', { product: product.id })" id="product-edit-page">
                                Edit
                            </vs-link>

                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </vs-box>
</template>

<script setup>
    defineProps({
        products: Array,
    });
</script>
