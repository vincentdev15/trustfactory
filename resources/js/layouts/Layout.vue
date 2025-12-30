<template>
    <div class="fixed top-0 left-0 w-screen h-screen bg-light -z-10"></div>

    <header class="flex items-center justify-center">
        <navbar></navbar>
    </header>

    <main class="grow flex flex-col p-8 gap-4 text-dark">
        <slot></slot>
    </main>
</template>

<script setup>
</script>
