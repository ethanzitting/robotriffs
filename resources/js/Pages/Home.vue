<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import PostFeed from "@/Components/PostFeed.vue";
import TweetInput from "@/Components/TweetInput.vue";

defineProps({
    user: Object,
    posts: Array,
})

</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Home
            </h2>
        </template>

        <div class="main">
            <h3 class="page-title">Home</h3>
            <TweetInput />
            <PostFeed :posts="posts"></PostFeed>
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.main {
    min-height: 100vh;
    border-left: 1px solid #EEEEEE;
    border-right: 1px solid #EEEEEE;

    .page-title {
        font-size: 20px;
        font-weight: 700;
        margin: 16px;
        border: none;
    }

    &>* {
        border-top: 1px solid #EEEEEE;
    }
}
</style>
