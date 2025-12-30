<template>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-12">
        <product-card v-for="product in products" :key="product.id" :product="product"></product-card>
    </div>
</template>

<script setup>
    defineProps({
        products: Array,
    });
</script>
