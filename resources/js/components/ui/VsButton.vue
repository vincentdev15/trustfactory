<template>
    <button
        :class="{
            'transition-all appearence-none outline-none w-full rounded border border-gray-300 text-primary hover:border-primary hover:text-primary-dark cursor-pointer': true,
            'px-2 py-1 text-sm': props.size === 'small',
            'px-3 py-2': props.size === 'medium',
        }">
        <slot></slot>
    </button>
</template>

<script setup>
    const props = defineProps({
        size: {
            type: String,
            default: 'medium',
        },
    });
</script>
