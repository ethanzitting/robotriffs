<script setup>
import IconHome from "../icons/IconHome.vue";
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
</script>

<template>
    <div class="mobile-footer">
        <NavLink class="home" :link-to="route('home')" :active="route().current('home')">
            <IconHome class="icon"/>
        </NavLink>
        <NavLink
            :href="route('login')"
            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >Log in</NavLink>
        <NavLink
            :href="route('register')"
            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
        >Register</NavLink>
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
}
</style>
