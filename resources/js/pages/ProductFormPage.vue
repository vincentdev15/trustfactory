<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="save()">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <vs-label>Name</vs-label>

                        <vs-input id="name" name="name" type="text" v-model="product.name"></vs-input>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Price</vs-label>

                        <vs-input id="price" name="price" type="number" min="0" step="0.01" v-model="product.price"></vs-input>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Stock quantity</vs-label>

                        <vs-input id="stock_quantity" name="stock_quantity" type="number" min="0" step="1" v-model="product.stock_quantity"></vs-input>
                    </div>

                    <div class="flex items-center gap-4">
                        <vs-button @submit.prevent="save()">Save</vs-button>

                        <vs-link-as-button :to="{ name: 'pages.dashboard' }">Cancel</vs-link-as-button>
                    </div>
                </div>
            </form>
        </vs-box>
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
        if (id) {
            const res = await productService.show(id);

            if (res.status === 200) {
                Object.assign(product, res.data.data);
            }
        }
    });

    const save = async () => {
        if (id) {
            const res = await productService.update(product);

            if (res.status === 200) {
                router.push({ name: 'pages.dashboard' });
            } else {
                errors.value = res.response.data.errors;
            }
        } else {
            const res = await productService.store(product);

            if (res.status === 201) {
                router.push({ name: 'pages.dashboard' });
            } else {
                errors.value = res.response.data.errors;
            }
        }
    }
</script>
