<script setup>
import DefaultLayout from "../Layouts/DefaultLayout.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import TweetInput from "../Components/tweets/TweetInput.vue";
import {Link} from "@inertiajs/vue3";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import TweetReplies from "../Components/tweets/TweetReplies.vue";
import {ref} from "vue";

defineProps({
    tweet: Object,
    user: Object
})

let replyKey = ref('-')
const refreshReplies = () => replyKey = replyKey.value + '-'
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
            @submitted="refreshReplies"
        />
        <TweetReplies
            :tweet="tweet.data"
            :key="replyKey"
        />
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;
    height: 30px;
    width: 30px;

    &:hover {
        background-color: #eee;
    }
}
</style>
