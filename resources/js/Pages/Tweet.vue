<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";
import TweetFeed from "../Components/tweets/TweetFeed.vue";

defineProps({tweet: Object})
</script>
<template>
    <DefaultLayout>
        <TweetCard
            :tweet="tweet"
            show-stats
        />
        <TweetInput :parent-tweet="tweet.id"/>
        <TweetFeed :tweets="tweet.children"/>
    </DefaultLayout>
</template>
