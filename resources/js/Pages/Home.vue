<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PostFeed from "@/Components/PostFeed.vue";
import TweetInput from "@/Components/TweetInput.vue";

defineProps({
    user: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>
        <div>
            <TweetInput />
            <PostFeed :posts="$page.props.auth.user.posts"></PostFeed>
        </div>
    </DefaultLayout>
</template>
