<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PostFeed from "@/Components/PostFeed.vue";
import TweetInput from "@/Components/TweetInput.vue";

defineProps({
    user: Object,
    currentUser: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard" :user="currentUser">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>
        <div>
            <TweetInput :user="currentUser"></TweetInput>
            <PostFeed :posts="currentUser.posts"></PostFeed>
        </div>
    </DefaultLayout>
</template>
