<script setup>
import UserAvater from "./UserAvater.vue";
import {Link} from '@inertiajs/vue3';
import SingleDot from "./icons/SingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
import TweetLikeButton from "./TweetLikeButton.vue";
dayjs.extend(relativeTime)

defineProps({
    tweet: Object
})
</script>

<template>
    <div class="container">
        <UserAvater
            :to="'/' + tweet.user.handle"
            :user="tweet.user"
            :size="'48px'"
        />
        <div class="content-wrapper">
            <div class="tweet-header">
                <Link :href="'/' + tweet.user.handle" class="name">
                    {{ tweet.user.name }}
                </Link>
                <Link :href="'/' + tweet.user.handle" class="handle">
                    @{{ tweet.user.handle }}
                </Link>
                <SingleDot class="dot"/>
                <span>{{ dayjs(tweet.created_at).fromNow() }}</span>
            </div>
            <p>{{ tweet.content }}</p>
            <div class="interaction-icons">
                <TweetLikeButton
                    :tweet="tweet"
                    :count="tweet.likes.length"
                />
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.container {
    padding: 12px;
    display: flex;
    flex-direction: row;
    gap: 12px;

    .tweet-header {
        display: flex;
        flex-direction: row;
        gap: 4px;
        color: #536471;

        .name {
            color: black;
            font-weight: 700;
        }

        .dot {
            align-self: center;
        }
    }
}
</style>
