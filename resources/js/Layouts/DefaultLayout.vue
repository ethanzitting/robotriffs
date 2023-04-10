<script setup>
import {Head} from '@inertiajs/vue3';
import NavBar from "@/Components/NavBar.vue";
import Extras from "@/Components/Extras.vue";

const props = defineProps({
    title: String,
})

</script>

<template>
    <Head :title="title" />
    <div class="default-layout-container">
        <div class="fixed-elements">
            <NavBar class="navbar"/>
            <div class="header">
                <slot name="header" />
            </div>
            <Extras class="extras"/>
        </div>
        <main class="main">
            <slot />
        </main>
    </div>
</template>

<style lang="scss" scoped>
.default-layout-container {
    position: relative;
    min-height: 100vh;
    margin: 0 auto;
    width: 1250px;
    max-width: 1250px;
    font-family: 'Roboto', sans-serif;
    padding: 55px 370px 100px 260px;
    z-index: 5;
    pointer-events: none;

    .fixed-elements {
        position: fixed;
        top: 0;
        left: calc(50vw - 625px);
        right: calc(50vw - 625px);
        min-height: 100vh;
        max-height: 100vh;
        margin: 0 auto;
        z-index: 20;

        &>* {
            pointer-events: initial;
        }

        @media screen and (max-width: 1250px) {
            left: 0;
        }

        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            width: 260px;
            border-right: 1px solid #EEEEEE;
        }

        .header {
            position: absolute;
            top: 0;
            left: 260px;
            right: 500px;
            height: 55px;
            padding: 0 16px;
            display: flex;
            flex-direction: row;
            font-size: 20px;
            font-weight: 700;
            align-items: center;
            width: 620px;
            z-index: 20;
            background-color: #FFFFFFee;
        }

        .extras {
            position: absolute;
            padding-left: 20px;
            width: 370px;
            top: 0;
            right: 0;
            border-left: 1px solid #EEEEEE;
        }
    }


    .main {
        z-index: 10;
        position: relative;
        max-width: 620px;
        min-width: 620px;
        pointer-events: initial;
    }
}
</style>
