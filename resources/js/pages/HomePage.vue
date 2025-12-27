<template>
    <div class="grow flex flex-col items-center justify-center gap-12 rounded-lg text-5xl text-center text-enhance bg-dark">
        <div>Welcome to</div>

        <img :src="image" alt="">
        
        <div>ecommerce</div>
    </div>
</template>

<script setup>
    import image from '@img/trustfactory.png';
</script>
