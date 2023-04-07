<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";

const props = defineProps({tweet: Object})
</script>
<template>
    <DefaultLayout>
        <TweetCard
            :tweet="props.tweet"
            show-stats
        />
        <TweetInput />
    </DefaultLayout>
</template>
