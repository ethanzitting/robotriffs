<script setup>
import TweetCard from "./TweetCard.vue";

defineProps({ posts: Array })

</script>

<template>
    <p>Posts</p>
    <TweetCard v-for="post in posts" :post="post" :key="post.id" />
</template>
