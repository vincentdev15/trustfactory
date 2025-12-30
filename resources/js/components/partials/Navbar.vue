<template>
    <nav class="px-8 w-full h-20 flex items-center justify-between border-b-2 border-primary">
        <ul class="flex items-center justify-around gap-8 text-xl">
            <li class="transition-all hover:text-primary bg-primary px-3 py-2 rounded">
                <Link :href="route('home')" id="home-page">
                    <img :src="image" alt="Logo Trustfactort">
                </Link>
            </li>

            <li class="transition-all hover:text-primary">
                <Link :href="route('pages.market')" id="market-page">
                    Market
                </Link>
            </li>
        </ul>

        <ul class="flex items-center justify-around gap-8 text-xl">
            <li v-show="user && user.is_admin" class="transition-all hover:text-primary">
                <Link :href="route('dashboard')" id="dashboard-page">
                    Dashboard
                </Link>
            </li>

            <li v-show="user">
                Hello {{ user?.name }}
            </li>

            <li v-show="user" class="transition-all hover:text-primary">
                <Link :href="route('cart')" id="cart-page">
                    <div class="relative">
                        <div>Cart</div>

                        <div v-if="page.props.auth.user?.items_count > 0" class="absolute -top-2 -right-4">
                            <div class="flex items-center justify-center size-6 text-sm rounded-full bg-primary text-light">
                                {{ page.props.auth.user.items_count }}
                            </div>
                        </div>
                    </div>
                </Link>
            </li>

            <li v-show="!user" class="transition-all hover:text-primary">
                <Link :href="route('login')" id="login-page">
                    Login
                </Link>
            </li>

            <li v-show="user" class="transition-all hover:text-primary">
                <form @submit.prevent="router.post(route('logout'))">
                    <vs-button-as-link type="submit">Logout</vs-button-as-link>
                </form>
            </li>
        </ul>
    </nav>
</template>

<script setup>
    import { Link, router, usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';
    import image from '@img/trustfactory.png';

    const page = usePage();

    const user = computed(() => page.props.auth.user);
</script>
