<script setup>
import {Head} from '@inertiajs/vue3';
import NavBar from "@/Components/NavBar.vue";
import Extras from "../Components/Extras.vue";

const props = defineProps({
    title: String,
})

</script>

<template>
    <div class="container">
        <Head :title="title" />

        <NavBar/>

        <main class="main">
            <slot />
        </main>

        <Extras />
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
    gap: 32px;

    .main {
        max-width: 600px;
        min-width: 600px;
        border-right: 1px solid #EEEEEE;
        border-left: 1px solid #EEEEEE;
    }
}
</style>
