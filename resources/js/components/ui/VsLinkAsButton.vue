<template>
    <Link class="inline-block transition-all appearence-none outline-none px-3 py-2 rounded border border-gray-300 hover:border-primary hover:text-primary text-center cursor-pointer">
        <slot></slot>
    </Link>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
