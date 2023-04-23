<script setup>
import {onMounted, ref} from "vue";
import TweetCards from "./TweetCards.vue";

const props = defineProps({
    tweet: Object,
})

const tweets = ref([]);

onMounted(async () => {
    const response = await axios.get(`/api/tweets/${props.tweet.id}/replies?`);

    tweets.value = response.data.data
});
</script>

<template>
    <TweetCards :tweets="tweets" />
</template>
