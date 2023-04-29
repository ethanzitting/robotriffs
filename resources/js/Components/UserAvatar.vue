<script setup>
import {usePage} from "@inertiajs/vue3";
import {Link} from '@inertiajs/vue3';

const props = defineProps({
    to: String,
    specifiedUser: Object,
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
    >
        <img
            class="avatar"
            :src="imgSrc"
            :alt="user.name"
        >
    </Link>
    <div>
        <img
            v-else
            class="avatar"
            :src="imgSrc"
            :alt="user.name"
        >
    </div>
</template>

<style lang="scss" scoped>
.avatar {
    border-radius: 50%;
}
</style>
