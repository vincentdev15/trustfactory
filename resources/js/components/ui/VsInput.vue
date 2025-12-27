<template>
    <input
        v-model="model"
        class="transition-all appearence-none outline-none px-3 py-2 rounded border border-gray-300 focus:border-primary"
    >
</template>

<script setup>
    const model = defineModel({ required: true });
</script>
