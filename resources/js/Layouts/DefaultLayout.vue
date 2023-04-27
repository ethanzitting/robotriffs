<script setup>
import {Head} from '@inertiajs/vue3';
import NavBar from "@/Components/layout-blocks/NavBar.vue";
import Extras from "@/Components/layout-blocks/Extras.vue";
import MobileFooter from "@/Components/layout-blocks/MobileFooter.vue";
import UserAvatar from "../Components/UserAvatar.vue";

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
                <UserAvatar size="32px" class="mobile-navbar-trigger"/>
                <slot name="header" />
            </div>
            <Extras class="extras"/>
            <MobileFooter class="mobile-footer"/>
            <div class="footer"></div>
        </div>
        <main class="main">
            <slot />
        </main>
    </div>
</template>

<style lang="scss" scoped>
$main-width: 620px;
$navbar-width-desktop: 260px;
$navbar-width-tablet: 80px;
$header-height: 55px;
$padding-left: calc(50vw - calc(#{$main-width} / 2));
$padding-right: calc(50vw - calc(#{$main-width} / 2));
$extras-width: 370px;

.default-layout-container {
    position: relative;
    min-height: 100vh;
    min-width: 100vw;
    max-width: 100vw;
    overflow: hidden;

    padding: 0 $padding-right 260px $padding-left;
    font-family: 'Roboto', sans-serif;
    z-index: 0;
    pointer-events: none;

    @media screen and (max-width: 800px) {
        padding-left: 0;
        padding-right: 0;
    }

    @media screen and (max-width: 500px) {
        padding-left: 0;
        padding-right: 0;
    }

    .fixed-elements {
        pointer-events: initial;
        position: relative;
    }

    .navbar {
        position: fixed;
        top: 0;
        left: calc(#{$padding-left} - #{$navbar-width-desktop});
        width: $navbar-width-desktop;
        z-index: 20;

        @media screen and (max-width: 1250px) {
            left: calc(#{$padding-left} - #{$navbar-width-tablet});
            width: $navbar-width-tablet;
        }

        @media screen and (max-width: 800px) {
            left: 0;
        }

        @media (max-width: 500px) {
            display: none;
        }
    }

    .header {
        position: fixed;
        top: 0;
        left: calc(#{$padding-left} + 1px);
        height: $header-height;
        padding: 0 16px;
        display: flex;
        flex-direction: row;
        font-size: 20px;
        font-weight: 700;
        align-items: center;
        width: $main-width - 2px;
        z-index: 20;
        background-color: #FFFFFFee;

        @media screen and (max-width: 800px) {
            left: calc(#{$navbar-width-tablet} + 1px)
        }

        .mobile-navbar-trigger {
            display: none;
        }

        @media screen and (max-width: 500px) {
            left: 0;

            .mobile-navbar-trigger {
                display: block;
                margin-right: 16px;
            }
        }
    }

    .mobile-footer {
        position: fixed;
        left: 0;
        bottom: 0;
        right: 0;
        height: 52px;
        background-color: white;
        border-top: 1px solid #EEE;
        z-index: 20;

        display: none;

        @media (max-width: 500px) {
            display: initial;
        }
    }

    .extras {
        position: fixed;
        padding-left: 20px;
        width: $extras-width;
        top: 0;
        right: calc(#{$padding-right} - #{$extras-width});

        @media screen and (max-width: 1400px) {
            display: none;
        }
    }

    .main {
        z-index: 10;
        position: relative;
        max-width: $main-width;
        min-width: $main-width;
        pointer-events: initial;
        padding-top: $header-height;
        margin: 0;

        border-right: 1px solid #EEEEEE;
        border-left: 1px solid #EEEEEE;

        @media screen and (max-width: 800px) {
            margin-left: $navbar-width-tablet;
            max-width: calc(100vw - #{$navbar-width-tablet});
            min-width: calc(100vw - #{$navbar-width-tablet});
        }

        @media screen and (max-width: 500px) {
            margin-left: 0;
            max-width: 100vw;
            min-width: 100vw;
        }
    }
}
</style>
