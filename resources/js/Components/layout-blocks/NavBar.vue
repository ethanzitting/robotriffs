<script setup>
import UserMenu from "../UserMenu.vue";
import IconRobotRiffsLogo from "@/Components/icons/IconRobotRiffsLogo.vue";
import TweetButtonFull from "@/Components/tweets/TweetButtonFull.vue";
import NavLinkHome from "@/Components/layout-blocks/nav-links/NavLinkHome.vue";
import NavLinkProfile from "@/Components/layout-blocks/nav-links/NavLinkProfile.vue";
import NavLinkDirectory from "@/Components/layout-blocks/nav-links/NavLinkDirectory.vue";
import NavLinkSettings from "@/Components/layout-blocks/nav-links/NavLinkSettings.vue";
import TweetButtonMini from "@/Components/tweets/TweetButtonMini.vue";
</script>

<template>
    <header class="navbar">
        <IconRobotRiffsLogo class="logo" />
        <NavLinkHome />
        <NavLinkProfile />
        <NavLinkDirectory />
        <NavLinkSettings />
        <TweetButtonFull class="tweet-button-full" />
        <TweetButtonMini class="tweet-button-small"/>
        <UserMenu />
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

    .tweet-button {
        width: 90%;
        height: 50px;
        cursor: pointer;

        @media (max-width: 1250px) {
            display: none;
        }

        &-small {
            background-color: #1d9BF0;
            padding: 0;
            width: 50px;
            height: 50px;
            color: white;
            cursor: pointer;

            @media (min-width: 1250px) {
                display: none;
            }
        }

        &:hover {
            background-color: #1d9BF0;
        }
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
