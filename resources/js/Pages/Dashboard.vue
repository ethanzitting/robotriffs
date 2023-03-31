<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PostFeed from "../Components/PostFeed.vue";
import TweetInput from "../Components/TweetInput.vue";

defineProps({
    posts: Array,
    user: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>
        <div>
            <TweetInput :user="user"></TweetInput>
            <PostFeed :posts="posts"></PostFeed>
        </div>
    </DefaultLayout>
</template>
