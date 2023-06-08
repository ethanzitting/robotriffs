<script setup>
import {Link, usePage} from '@inertiajs/vue3';
import { authStore } from '@/stores/auth'

const props = defineProps({
    to: String,
    specifiedUser: Object,
})
const auth = authStore()

const user = props.specifiedUser ?? auth.user ?? usePage().props.auth.user

const imgSrc = user?.avatar?.url
    ? user.avatar.url
    : 'https://placehold.co/600x600'

</script>

<template>
    <Link
        v-if="to"
        :href="to"
        class="avatar"
    >
        <div class="image" />
        <img
            :src="imgSrc"
            :alt="user.name"
        >
    </Link>
    <div
        v-else
        class="avatar"
    >
        <img
            :src="imgSrc"
            :alt="user.name"
        >
    </div>
</template>

<style lang="scss" scoped>
.avatar {
    border-radius: 50%;
    overflow: hidden;
    background-color: white;

    img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
}
</style>
