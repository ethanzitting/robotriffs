<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "../../Components/PostFeed.vue";

defineProps({
    profile: Object,
    posts: Array,
})

</script>

<template>
    <DefaultLayout :profile="profile" something="foo">
        <Head>
            <title>{{ profile.user.name}}</title>
        </Head>
        <p>{{ profile.user.name }}</p>
        <TweetInput></TweetInput>
        <PostFeed :posts="profile.user.posts"></PostFeed>
    </DefaultLayout>
</template>
