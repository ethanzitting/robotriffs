<script setup>
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import IconGear from "../../icons/IconGear.vue";
</script>

<template>
    <NavLink :href="route('user.settings')" :active="route().current('user.settings')">
        <IconGear class="icon gear" />
        <p class="title">Settings</p>
    </NavLink>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
