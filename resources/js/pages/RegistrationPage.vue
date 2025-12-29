<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="register()">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <vs-label>Name</vs-label>

                        <vs-input id="name" name="name" type="text" v-model="user.name"></vs-input>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Email address</vs-label>

                        <vs-input id="email" name="email" type="text" v-model="user.email"></vs-input>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Password</vs-label>

                        <vs-input id="password" name="password" type="password" v-model="user.password"></vs-input>
                    </div>

                    <div class="flex flex-col gap-1">
                        <vs-label>Password confirmation</vs-label>

                        <vs-input id="password_confirmation" name="password_confirmation" type="password" v-model="user.password_confirmation"></vs-input>
                    </div>

                    <div class="flex items-center gap-4">
                        <vs-button class="w-full" @submit.prevent="register()">Register</vs-button>
                    </div>

                    <vs-link :to="{ name: 'pages.login' }" id="registration-page">I already have an account</vs-link>
                </div>
            </form>
        </vs-box>
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { useRouter } from 'vue-router';
    import authService from '@/services/authService.js';

    const user = reactive({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    });

    const router = useRouter();

    async function register() {
        const res = await authService.register(user);

        if (res.status === 201) {
            user.name = null;
            user.email = null;
            user.password = null;
            user.password_confirmation = null;

            router.push({
                name: 'pages.dashboard',
            });
        }
    }
</script>
