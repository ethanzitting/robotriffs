<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";
import TweetFeed from "../Components/tweets/TweetFeed.vue";

defineProps({tweet: Object})
</script>
<template>
    <DefaultLayout>
        <template #header>
            <h1>
                Tweet
            </h1>
        </template>
        <TweetCard
            :tweet="tweet.data"
            show-stats
        />
        <TweetInput
            :parent-tweet="tweet.data.id"
            placeholder="Tweet your reply"
        />
        <TweetFeed :tweets="tweet.data.children"/>
    </DefaultLayout>
</template>
