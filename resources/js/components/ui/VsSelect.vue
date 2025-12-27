<template>
    <select
        v-model="model"
        class="transition-all appearence-none outline-none px-3 py-2 rounded border border-gray-300 focus:border-primary bg-background"
    >
        <option
            v-if="props.nullOptionLabel"
            :value="null"
            key="nullOptionLabel"
        >
            {{ props.nullOptionLabel }}
        </option>

        <option
            v-for="option in props.options"
            :value="option.value"
            :key="option.value"
        >
            {{ option.label }}
        </option>
    </select>
</template>

<script setup>
    const model = defineModel({ required: true });

    const props = defineProps({
        options: {
            type: Array,
        },
        nullOptionLabel: {
            type: String,
        },
    });
</script>
