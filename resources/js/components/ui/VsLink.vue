<template>
    <Link class="transition-all text-primary hover:text-primary-dark text-center">
        <slot></slot>
    </Link>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
