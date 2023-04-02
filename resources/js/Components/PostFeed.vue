<script setup>
import TweetCard from "./TweetCard.vue";

defineProps({ posts: Array })

</script>

<template>
    <TweetCard
        v-for="post in posts"
        :post="post" :key="
        post.id"
    />
</template>
