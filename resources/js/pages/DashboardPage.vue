<template>
    dashboard
</template>

<script setup>
    import { ref, onMounted } from 'vue';

    const loading = ref(false);

    onMounted(async () => {
        loadDatas();
    });

    const loadDatas = async () => {
        loading.value = true;

        loading.value = false;
    }
</script>
