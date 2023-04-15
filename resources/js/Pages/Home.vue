<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import TweetFeed from "@/Components/tweets/TweetFeed.vue";
import TweetInput from "@/Components/tweets/TweetInput.vue";

defineProps({
    tweets: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h1>
                Home
            </h1>
        </template>

        <div class="main">
            <TweetInput placeholder="What's Happening?" />
            <TweetFeed :tweets="tweets.data" />
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.main {
    &>* {
        border-top: 1px solid #EEEEEE;
    }
}
</style>
