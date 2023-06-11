<script setup>
import IconHome from "../icons/IconHome.vue";
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import PWAInstallButton from "../PWAInstallButton.vue";

</script>

<template>
    <div class="mobile-footer">
        <NavLink class="home" :link-to="route('home')" :active="route().current('home')">
            <IconHome class="icon"/>
        </NavLink>
        <NavLink
            :href="route('login')"
            class=""
        >
            Log in
        </NavLink>
        <NavLink
            :href="route('register')"
            class=""
        >
            Register
        </NavLink>
        <PWAInstallButton />
    </div>
</template>

<style lang="scss" scoped>
.mobile-footer {
    position: relative;
    align-items: center;
    min-height: 70px;
    padding: 0 50px 10px 50px;
    display: flex;
    gap: 18px;
    justify-content: space-around;
    font-weight: 700;

    @media (max-width: 500px) {
        display: flex !important;
    }

    .home {
        height: min-content;

        .icon {
            height: 26px;
            width: 26px;
        }
    }
}
</style>
