<template>
    <div
        class="grid grid-cols-2 gap-4"
        :class="`grid-cols-${props.cols}`"
    >
        <div class="w-full flex items-center" v-for="option in props.options" :key="option.value">
            <input
                v-model="model"
                :id="option.value"
                class="hidden"
                type="radio"
                :value="option.value"
            >

            <div
                :class="{
                    'transition-all w-full px-3 py-2 flex items-center justify-center border border-gray-300 rounded cursor-pointer': true,
                    'border-gray-500': model !== option.value,
                    'border-primary text-primary': model === option.value,
                }"
                @click="model = option.value"
            >
                {{ option.label }}
            </div>
        </div>
    </div>
</template>

<script setup>
    const model = defineModel({ required: true });

    const props = defineProps({
        options: {
            type: Array,
        },
        cols: {
            type: Number,
            default: 2,
        },
    });
</script>
