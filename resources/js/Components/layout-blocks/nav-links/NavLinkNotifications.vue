<script setup>
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import IconBell from "../../icons/IconBell.vue";
</script>

<template>
    <NavLink :href="route('user.notifications')" :active="route().current('user.notifications')">
        <IconBell class="icon gear" />
        <p class="title">Notifications</p>
    </NavLink>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
