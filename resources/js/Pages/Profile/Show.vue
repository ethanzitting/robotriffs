<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "@/Components/PostFeed.vue";
import TweetInput from "@/Components/TweetInput.vue";

defineProps({
    user: Object,
})

</script>

<template>
    <DefaultLayout :user="user">
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <p>{{ user.name }}</p>
        <TweetInput :user="user"></TweetInput>
        <PostFeed :posts="user.posts"></PostFeed>
    </DefaultLayout>
</template>
