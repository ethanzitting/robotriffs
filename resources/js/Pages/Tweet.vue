<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";
import {Link} from "@inertiajs/vue3";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import TweetReplies from "../Components/tweets/TweetReplies.vue";

defineProps({
    tweet: Object,
    user: Object
})
</script>
<template>
    <DefaultLayout>
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft />
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
            :user="user.data"
        />
        <TweetReplies :tweet="tweet.data" :user="user.data"/>
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
