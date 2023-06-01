<script setup>
import IconLogOut from "../../icons/IconLogOut.vue";
import {router} from "@inertiajs/vue3";
</script>

<template>
    <button
        @click="router.post(route('logout'))"
    >
        <IconLogOut class="icon gear" />
        <span class="title">Log Out</span>
    </button>
</template>

<style lang="scss" scoped>
.icon {
    height: 25px;
    width: 25px;
}
</style>
