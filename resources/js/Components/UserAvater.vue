<script setup>
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    specifiedUser: Object
})
const user = props.specifiedUser ?? usePage().props.auth.user;
</script>

<template>
    <img
        class="avatar"
        :src="user.profile_photo_url"
        :alt="user.name"
    >
</template>

<style lang="scss" scoped>
.avatar {
    height: 40px;
    width: 40px;
    border-radius: 50%;
}
</style>
