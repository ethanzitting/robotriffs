<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from "@/Components/icons/ApplicationMark.vue";
import NavLink from "@/Components/NavLink.vue";

const props = defineProps({
    title: String,
    user: Object,
})

const logout = () => {
    router.post(route('logout'));
}

</script>

<template>
    <div class="body">
        <Head>
            <title>{{ title }}</title>
        </Head>

        <header class="header">
            <Link :href="route('home')">
                <ApplicationMark />
            </Link>
            <NavLink :href="route('home')" :active="route().current('home')">
                Home
            </NavLink>
            <NavLink :href="`/${user.handle}`" :active="route().current('user.profile')">
                Profile
            </NavLink>
            <NavLink :href="`/directory`" :active="route().current('directory')">
                Directory
            </NavLink>
            <NavLink :href="route('user.settings')" :active="route().current('user.settings')">
                Settings
            </NavLink>
            <button @click="logout">Log Out</button>
        </header>

        <main class="main">
            <slot />
        </main>
    </div>
</template>

<style lang="scss" scoped>
.body {
    position: relative;

    .header {
        position: fixed;
        font-size: 20px;
        font-weight: 400;
        top: 0;
        left: 0;
        width: 300px;
        height: 100vh;
        display: flex;
        flex-direction: column;
        gap: 16px;
        border-right: 1px solid #EEEEEE;
        padding: 40px;
        color: #222222;

        &>*:last-child {
            margin-top: auto;
        }
    }

    .main {
        margin-left: 300px;
    }
}
</style>
