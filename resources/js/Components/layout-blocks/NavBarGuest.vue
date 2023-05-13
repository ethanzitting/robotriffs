<script setup>
import IconRobotRiffsLogo from "@/Components/icons/IconRobotRiffsLogo.vue";
import NavLinkHome from "@/Components/layout-blocks/nav-links/NavLinkHome.vue";
</script>

<template>
    <header class="navbar">
        <IconRobotRiffsLogo class="logo" />
        <NavLinkHome />
    </header>
</template>

<style lang="scss" scoped>
.navbar {
    font-size: 20px;
    font-weight: 400;
    height: 100vh;
    max-height: 90vh;
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 40px 10px 0 10px;
    color: #222222;
    background-color: white;

    &>* {
        height: 60px;
        width: min-content;
        border-radius: 60px;
        display: flex;
        gap: 20px;
        justify-content: center;
        align-items: center;
        padding: 0 30px;

        @media (min-width: 1250px) {
            &:hover {
                background-color: #dddddd;
            }
        }

        &:last-child {
            margin-top: auto;
        }
    }

    .icon {
        height: 27px;
        width: 27px;
    }

    @media (max-width: 1250px) {
        &>* {
            padding: 0;
            margin: 0 auto;
        }

        :deep(.title) {
            display: none;
        }
    }
}
</style>
