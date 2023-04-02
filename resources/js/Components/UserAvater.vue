<script setup>
import {usePage} from "@inertiajs/vue3";
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    to: String,
    specifiedUser: Object,
    size: String
})
const user = props.specifiedUser ?? usePage().props.auth.user;
</script>

<template>
    <Link
        v-if="to"
        :href="to"
        :style="`height: ${size ?? '40px'}; width: ${size ?? '40px'}`"
    >
        <img
            class="avatar"
            :src="user.profile_photo_url"
            :alt="user.name"
        >
    </Link>
    <img
        v-else
        class="avatar"
        :style="`height: ${size ?? '40px'}; width: ${size ?? '40px'}`"
        :src="user.profile_photo_url"
        :alt="user.name"
    >
</template>

<style lang="scss" scoped>
.avatar {
    border-radius: 50%;
}
</style>
