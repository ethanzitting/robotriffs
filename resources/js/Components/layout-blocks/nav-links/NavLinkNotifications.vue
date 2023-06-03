<script setup>
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import NotificationBell from "../../NotificationBell.vue";

</script>

<template>
    <NavLink :href="route('user.notifications')" :active="route().current('user.notifications')">
        <NotificationBell />
        <p class="title">Notifications</p>
    </NavLink>
</template>
