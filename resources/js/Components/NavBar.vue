<script setup>
import {Link} from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import UserMenu from "./UserMenu.vue";
import RobotRiffsLogo from "./icons/RobotRiffsLogo.vue";
import IconHome from "./icons/IconHome.vue";
import IconPerson from "./icons/IconPerson.vue";
import IconHashtag from "./icons/IconHashtag.vue";
import IconGear from "./icons/IconGear.vue";
</script>

<template>
    <header class="navbar">
        <Link :href="route('home')">
            <RobotRiffsLogo size="48px" />
        </Link>
        <NavLink :href="route('home')" :active="route().current('home')">
            <IconHome class="icon home"/>
            <p class="title">Home</p>
        </NavLink>
        <NavLink :href="`/${$page.props.auth.user.handle}`" :active="route().current('user.profile')">
            <IconPerson class="icon profile"/>
            <p class="title">Profile</p>
        </NavLink>
        <NavLink :href="`/directory`" :active="route().current('directory')">
            <IconHashtag class="icon hashtag"/>
            <p class="title">Directory</p>
        </NavLink>
        <NavLink :href="route('user.settings')" :active="route().current('user.settings')">
            <IconGear class="icon gear" />
            <p class="title">Settings</p>
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
        gap: 20px;
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

    .icon {
        height: 27px;
        width: 27px;
    }

    @media (max-width: 1250px) {
        &>* {
            padding: 0;
            margin: 0 auto;
        }

        .title {
            display: none;
        }
    }
}
</style>
