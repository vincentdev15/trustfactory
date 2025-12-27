<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="login()" class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <vs-label>Email</vs-label>

                    <vs-input id="email" name="email" type="text" v-model="user.email"></vs-input>
                </div>

                <div class="flex flex-col gap-1">
                    <vs-label>Password</vs-label>

                    <vs-input id="password" name="password" type="password" v-model="user.password"></vs-input>
                </div>

                <div class="flex items-center gap-4">
                    <vs-button type="submit">Login</vs-button>
                </div>

                <vs-link :to="{ name: 'pages.register' }" id="registration-page">I don't have an account yet</vs-link>
            </form>
        </vs-box>
    </div>
</template>

<script setup>
    import { reactive } from 'vue';
    import { useRouter } from 'vue-router';
    import authService from '@/services/authService.js';

    const user = reactive({
        email: null,
        password: null,
    });

    const router = useRouter();

    async function login() {
        const res = await authService.login(user);

        if (res.status === 200) {
            user.email = null;
            user.password = null;

            await router.push({
                name: 'pages.dashboard',
            });
        }
    }
</script>
