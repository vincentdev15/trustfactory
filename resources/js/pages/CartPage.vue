<template>
    <div class="xl:px-20 w-full h-100 flex gap-8">
        <div class="w-2/3">
            <table>
                <thead>
                    <tr>
                        <th class="px-4 py-4"></th>

                        <th class="px-4 py-4">Product</th>

                        <th class="px-4 py-4 text-end">Unit price</th>

                        <th class="px-4 py-4">Quantity</th>

                        <th class="px-4 py-4 text-end">Total price</th>

                        <th class="px-4 py-4 text-end"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in authStore.user?.cart?.items" :key="item.id">
                        <td class="px-4 py-4">
                            <div class="w-40 h-32">
                                <img class="w-full h-full object-cover rounded-lg" src="https://picsum.photos/600/400" alt="Fake image">
                            </div>
                        </td>

                        <td class="px-4 py-4">{{ item.product.name }}</td>

                        <td class="px-4 py-4 text-end">{{ item.unit_price }}</td>

                        <td class="px-4 py-4">
                            <div class="relative flex justify-center">
                                <product-quantity :product="item.product"></product-quantity>

                                <div v-if="item.quantity > item.product.stock_quantity && authStore.user.cart.status === 'open'" class="absolute -bottom-8 text-center text-red-500">
                                    Stock : {{ item.product.stock_quantity }}    
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4 text-end">{{ item.total_price }}</td>

                        <td class="px-4 py-4 text-end">
                            <form @submit.prevent="deleteItem(item.id)">
                                <div class="flex flex-col gap-4">
                                    <vs-button type="submit">Delete</vs-button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <vs-box class="w-1/3 max-h-fit">
            <div class="flex flex-col justify-between gap-8">
                <div class="text-5xl mt-4">Your order</div>

                <div class="grow flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <div class="text-5xl text-primary">{{ authStore.user?.cart?.total_price }}</div>

                        <div class="italic text-gray-500">Total price</div>                        
                    </div>
                </div>

                <div v-if="authStore.user.cart.can_validate">
                    <form @submit.prevent="validateCart()">
                        <div class="flex flex-col gap-4">
                            <vs-button type="submit" :disabled="!authStore.user.cart.can_validate">VALIDATE THE CART</vs-button>
                        </div>
                    </form>
                </div>

                <div v-if="authStore.user.cart.can_pay">
                    <form @submit.prevent="payCart()">
                        <div class="flex flex-col gap-4">
                            <vs-button type="submit" :disabled="!authStore.user.cart.can_pay">PAY</vs-button>
                        </div>
                    </form>
                </div>
            </div>
        </vs-box>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import { useRoute } from 'vue-router';
    import { useAuthStore } from '@/stores/authStore.js';
    import itemService from '@/services/itemService.js';
    import cartService from '@/services/cartService.js';

    const authStore = useAuthStore();

    const route = useRoute();

    const errors = ref([]);

    const deleteItem = async (id) => {
        const res = await itemService.destroy(id);

        if (res.status === 200) {
            
        } else {
            errors.value = res.response.data.errors;
        }
    }

    const validateCart = async () => {
        const res = await cartService.validate();

        if (res.status === 200) {
            
        } else {
            errors.value = res.response.data.errors;
        }
    }

    const payCart = async () => {
        const res = await cartService.pay();

        if (res.status === 200) {
            
        } else {
            errors.value = res.response.data.errors;
        }
    }
</script>
