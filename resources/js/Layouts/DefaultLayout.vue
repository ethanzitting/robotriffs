<script setup>
import {Head} from '@inertiajs/vue3';
import NavBar from "@/Components/NavBar.vue";

const props = defineProps({
    title: String,
})

</script>

<template>
    <div class="container">
        <Head>
            <title>{{ title }}</title>
        </Head>

        <header class="header">
            <NavBar/>
        </header>

        <main class="main">
            <slot />
        </main>
    </div>
</template>

<style lang="scss" scoped>
.container {
    position: relative;
    min-height: 100vh;
    margin: 0 auto;

    font-family: 'Roboto', sans-serif;

    display: flex;
    flex-direction: row;
    justify-content: center;

    .main {
        max-width: 980px;
        min-width: 980px;
    }
}
</style>
