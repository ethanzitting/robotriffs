<script setup>
import IconHome from "../icons/IconHome.vue";
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import TweetButtonMini from "../tweets/TweetButtonMini.vue";
</script>

<template>
    <div class="mobile-footer">
        <NavLink class="home" :link-to="route('home')" :active="route().current('home')">
            <IconHome class="icon"/>
        </NavLink>
        <TweetButtonMini class="tweet-button-small"/>
    </div>
</template>

<style lang="scss" scoped>
.mobile-footer {
    position: relative;
    align-items: center;
    padding: 0 50px;

    @media (max-width: 500px) {
        display: flex !important;
    }

    .home {
        height: min-content;

        .icon {
            height: 26px;
        }
    }

    .tweet-button-small {
        position: absolute;
        top: -74px;
        right: 24px;
        height: 56px;
        width: 56px;
        border-radius: 50%;
    }
}
</style>
