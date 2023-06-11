<script setup>
import IconHome from "../icons/IconHome.vue";
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import TweetButtonMini from "../tweets/TweetButtonMini.vue";
import NotificationBell from "../NotificationBell.vue";
import PWAInstallButton from "../PWAInstallButton.vue";
</script>

<template>
    <div class="mobile-footer">
        <NavLink class="home" :link-to="route('home')" :active="route().current('home')">
            <IconHome class="icon"/>
        </NavLink>
        <NavLink class="notifications" :link-to="route('user.notifications')" :active="route().current('user.notifications')">
            <NotificationBell />
        </NavLink>
        <PWAInstallButton />
        <TweetButtonMini class="tweet-button-small"/>
    </div>
</template>

<style lang="scss" scoped>
.mobile-footer {
    position: relative;
    align-items: center;
    min-height: 70px;
    gap: 20%;
    padding: 0 30px 10px 30px;

    @media (max-width: 500px) {
        display: flex !important;
    }

    .home, .notifications {
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
