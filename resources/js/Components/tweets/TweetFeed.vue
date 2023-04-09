<script setup>
import TweetCard from "./TweetCard.vue";

const props = defineProps({ tweets: Array })

const sortedTweets = props.tweets.sort((a, b) => b.created_at.localeCompare(a.created_at))

</script>

<template>
    <TweetCard
        class="tweet-card"
        v-for="tweet in sortedTweets"
        :tweet="tweet" :key="
        tweet.id"
    />
</template>

<style lang="scss" scoped>
.tweet-card {
    border-top: 1px solid #EEEEEE;

    &:last-child {
        border-bottom: 1px solid #EEEEEE;
    }
}
</style>
