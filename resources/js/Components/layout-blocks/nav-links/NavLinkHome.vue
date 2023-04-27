<script setup>
import IconHome from "@/Components/icons/IconHome.vue";
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
</script>

<template>
    <NavLink :link-to="route('home')" :active="route().current('home')">
        <IconHome class="icon"/>
        <p class="title">Home</p>
    </NavLink>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
