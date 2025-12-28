<template>
    <button
        :class="{
            'transition-all appearence-none outline-none rounded border border-gray-300': true,
            'px-2 py-1 text-sm': props.size === 'small',
            'px-3 py-2': props.size === 'medium',
            'text-primary hover:border-primary hover:text-primary-dark cursor-pointer': props.disabled === false && props.inverse === false,
            'bg-primary text-light hover:bg-dark hover:text-primary cursor-pointer': props.disabled === false && props.inverse === true,
            'text-gray-500 bg-gray-300': props.disabled === true,
        }"
        :disabled="props.disabled"
    >
        <slot></slot>
    </button>
</template>

<script setup>
    const props = defineProps({
        size: {
            type: String,
            default: 'medium',
        },
        inverse: {
            type: Boolean,
            default: false,
        },
        disabled: {
            type: Boolean,
            default: false,
        },
    });
</script>
