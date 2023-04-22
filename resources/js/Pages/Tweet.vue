<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";
import TweetFeed from "../Components/tweets/TweetFeed.vue";
import {Link} from "@inertiajs/vue3";
import ArrowLeft from "../Components/icons/ArrowLeft.vue";

defineProps({tweet: Object})
</script>
<template>
    <DefaultLayout>
        <template #header>
            <Link href="/home" class="back-arrow">
                <ArrowLeft size="20px" />
            </Link>
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

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;

    &:hover {
        background-color: #eee;
    }
}
</style>
