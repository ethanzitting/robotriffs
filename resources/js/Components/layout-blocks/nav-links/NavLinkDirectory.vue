<script setup>
import NavLink from "@/Components/layout-blocks/nav-links/NavLink.vue";
import IconHashtag from "../../icons/IconHashtag.vue";
</script>

<template>
    <NavLink :href="`/directory`" :active="route().current('directory')">
        <IconHashtag class="icon hashtag"/>
        <p class="title">Directory</p>
    </NavLink>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
