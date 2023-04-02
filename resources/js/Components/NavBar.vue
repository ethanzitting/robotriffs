<script setup>
import {Link} from '@inertiajs/vue3';
import ApplicationMark from "@/Components/icons/ApplicationMark.vue";
import NavLink from "@/Components/NavLink.vue";
import UserMenu from "./UserMenu.vue";
</script>

<template>
    <header class="navbar">
        <Link :href="route('home')">
            <ApplicationMark />
        </Link>
        <NavLink :href="route('home')" :active="route().current('home')">
            Home
        </NavLink>
        <NavLink :href="`/${$page.props.auth.user.handle}`" :active="route().current('user.profile')">
            Profile
        </NavLink>
        <NavLink :href="`/directory`" :active="route().current('directory')">
            Directory
        </NavLink>
        <NavLink :href="route('user.settings')" :active="route().current('user.settings')">
            Settings
        </NavLink>
        <UserMenu />
    </header>
</template>

<style lang="scss" scoped>
.navbar {
    font-size: 20px;
    font-weight: 400;
    height: 100vh;
    width: 240px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 40px 0;
    color: #222222;

    &>*:last-child {
        margin-top: auto;
    }
}
</style>
