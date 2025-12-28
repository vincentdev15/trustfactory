<template>
    <input
        v-model="model"
        :class="{
            'transition-all appearence-none outline-none px-3 py-2 rounded border border-gray-300 focus:border-primary': true,
            'text-primary hover:border-primary hover:text-primary-dark cursor-pointer': props.disabled === false,
            'text-gray-500 bg-gray-300': props.disabled === true,
        }"
        :disabled="props.disabled"
    >
</template>

<script setup>
    const model = defineModel({ required: true });

    const props = defineProps({
        disabled: {
            type: Boolean,
            default: false,
        },
    });
</script>
