<script setup>
import {usePage} from "@inertiajs/vue3";
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    to: String,
    specifiedUser: Object,
    size: String
})
const user = props.specifiedUser ?? usePage().props.auth.user;

const imgSrc = user.avatar
    ? user.avatar.url
    : 'https://placehold.co/600x600'

</script>

<template>
    <Link
        v-if="to"
        :href="to"
        :style="`
            min-height: ${size ?? '40px'};
            max-height: ${size ?? '40px'};
            min-width: ${size ?? '40px'};
            max-width: ${size ?? '40px'};
        `"
    >
        <img
            class="avatar"
            :src="imgSrc"
            :alt="user.name"
        >
    </Link>
    <img
        v-else
        class="avatar"
        :style="`
            min-height: ${size ?? '40px'};
            max-height: ${size ?? '40px'};
            min-width: ${size ?? '40px'};
            max-width: ${size ?? '40px'};
        `"

        :src="imgSrc"
        :alt="user.name"
    >
</template>

<style lang="scss" scoped>
.avatar {
    border-radius: 50%;
}
</style>
