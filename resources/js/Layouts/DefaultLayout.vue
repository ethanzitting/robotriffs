<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import NavLink from "@/Components/NavLink.vue";
import ApplicationMark from "../Components/icons/ApplicationMark.vue";

defineProps({
    title: String,
});

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div class="body">
        <Head>
            <title>{{ title }}</title>
        </Head>

        <header class="header">
            <Link :href="route('dashboard')">
                <ApplicationMark />
            </Link>
            <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                Dashboard
            </NavLink>
            <NavLink :href="route('profile.show')" :active="route().current('profile.show')">
                Manage Account
            </NavLink>
            <q-btn @click="logout">Log Out</q-btn>
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
        top: 0;
        left: 0;
        width: 300px;
        padding: 16px;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .main {
        margin-left: 300px;
    }
}
</style>
