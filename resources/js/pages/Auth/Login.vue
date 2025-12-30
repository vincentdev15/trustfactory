<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="user.post(route('login.store'))" class="flex flex-col gap-4">
                <div class="flex flex-col gap-1">
                    <vs-label>Email</vs-label>

                    <vs-input id="email" name="email" type="text" v-model="user.email"></vs-input>
                </div>

                <div class="flex flex-col gap-1">
                    <vs-label>Password</vs-label>

                    <vs-input id="password" name="password" type="password" v-model="user.password"></vs-input>
                </div>

                <div class="flex items-center gap-4">
                    <vs-button class="w-full" type="submit">Login</vs-button>
                </div>

                <vs-link :href="route('register')" id="registration-page">I don't have an account yet</vs-link>
            </form>
        </vs-box>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    
    const user = useForm({
        email: null,
        password: null,
    });
</script>
