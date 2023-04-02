<script setup>
import TweetCard from "./TweetCard.vue";

defineProps({ posts: Array })

</script>

<template>
    <TweetCard
        class="tweet-card"
        v-for="post in posts"
        :post="post" :key="
        post.id"
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
