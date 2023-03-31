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
                Home
            </NavLink>
            <NavLink href="/ethanzitting" :active="route().current('profile.show')">
                Profile
            </NavLink>
            <NavLink href="/user/account" :active="route().current('account.show')">
                Manage Account
            </NavLink>
            <button @click="logout">Log Out</button>
        </header>

        <main class="main">
            <slot />
        </main>
    </div>
</template>

<script>
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from "../Components/icons/ApplicationMark.vue";
import NavLink from "../Components/NavLink.vue";

export default {
    components: {NavLink, ApplicationMark, Head, Link},
    props: {
        title: {
            type: String,
            default: ''
        },
    },
    methods: {
        logout () {
            router.post(route('logout'));
        },
    }
}
</script>

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
