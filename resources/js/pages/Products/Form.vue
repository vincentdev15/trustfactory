<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="!props.product.id ? form.post(route('admin.products.store')) : form.put(route('admin.products.update', { product: props.product.id }))">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <vs-label>Name</vs-label>

                        <vs-input id="name" name="name" type="text" v-model="form.name"></vs-input>

                        <vs-error v-if="form.errors.name">{{ form.errors.name }}</vs-error>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Price</vs-label>

                        <vs-input id="price" name="price" type="number" min="0" step="0.01" v-model="form.price"></vs-input>

                        <vs-error v-if="form.errors.price">{{ form.errors.price }}</vs-error>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Stock quantity</vs-label>

                        <vs-input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" v-model="form.stock_quantity"></vs-input>

                        <vs-error v-if="form.errors.stock_quantity">{{ form.errors.stock_quantity }}</vs-error>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Low stock limit</vs-label>

                        <vs-input id="low_stock_limit" name="low_stock_limit" type="number" min="0" step="1" v-model="form.low_stock_limit"></vs-input>

                        <vs-error v-if="form.errors.low_stock_limit">{{ form.errors.low_stock_limit }}</vs-error>
                    </div>

                    <div class="flex items-center gap-4">
                        <vs-button class="w-1/2" type="submit">Save</vs-button>

                        <vs-link-as-button class="w-1/2" :href="route('admin.products.index')">Cancel</vs-link-as-button>
                    </div>
                </div>
            </form>
        </vs-box>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    
    const props = defineProps({
        product: Object
    });

    const form = useForm({
        name: props.product?.name ?? null,
        price: props.product?.price ?? null,
        stock_quantity: props.product?.stock_quantity ?? null,
        low_stock_limit: props.product?.low_stock_limit ?? null,
    })
</script>
