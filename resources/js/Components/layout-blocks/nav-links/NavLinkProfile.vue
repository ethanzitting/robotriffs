<script setup>
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import IconPerson from "../../icons/IconPerson.vue";
</script>

<template>
    <NavLink :href="`/${$page.props.auth.user.handle}`" :active="route().current('user.profile')">
        <IconPerson class="icon"/>
        <p class="title">Profile</p>
    </NavLink>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
