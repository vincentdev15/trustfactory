<template>
    <div class="w-80 self-center">
        <vs-box>
            <form @submit.prevent="user.post(route('register.store'))" class="flex flex-col gap-4">
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

                    <vs-link :href="route('login')" id="registration-page">I already have an account</vs-link>
                </div>
            </form>
        </vs-box>
    </div>
</template>

<script setup>
    import { useForm } from '@inertiajs/vue3';
    
    const user = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    });

</script>
