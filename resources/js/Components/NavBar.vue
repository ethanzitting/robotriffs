<script setup>
import {Link} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import UserMenu from "./UserMenu.vue";
import RobotRiffsLogo from "./icons/RobotRiffsLogo.vue";
</script>

<template>
    <header class="navbar">
        <Link :href="route('home')">
            <RobotRiffsLogo size="48px" />
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
    display: flex;
    flex-direction: column;
    gap: 16px;
    padding: 40px 0;
    color: #222222;

    &>* {
        height: 60px;
        width: min-content;
        border-radius: 60px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0 30px;

        &:hover {
            background-color: #dddddd;
        }

        &:last-child {
            margin-top: auto;
        }
    }
}
</style>
