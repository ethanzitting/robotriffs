<script setup>
import UserAvatar from "../UserAvatar.vue";
import {Link} from '@inertiajs/vue3';
import SingleDot from "../icons/SingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
import TweetLikeButton from "./TweetLikeButton.vue";
import TweetCommentButton from "./TweetCommentButton.vue";
import TweetImage from "./TweetImage.vue";
dayjs.extend(relativeTime)

defineProps({
    tweet: Object,
    showStats: Boolean
})
</script>

<template>
    <Link :href="`/${tweet.user.handle}/tweet/${tweet.id}`" class="container">
        <UserAvatar
            :to="'/' + tweet.user.handle"
            :specified-user="tweet.user"
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
                <span>{{ dayjs(tweet.dates.created).fromNow() }}</span>
            </div>
            <p v-if="tweet.parent?.user">
                Replying to
                <Link :href="'/' + tweet.parent.user.handle">
                    @{{ tweet.parent.user.handle}}
                </Link>
            </p>
            <p>{{ tweet.content }}</p>
            <TweetImage class="tweet-image" v-if="tweet.image" :src="tweet.image.url"/>
            <div v-if="showStats" class="stats">{{ dayjs(tweet.dates.created).fromNow() }}</div>
            <div class="interaction-icons">
                <TweetCommentButton
                    :count="tweet.children?.length"
                />
                <TweetLikeButton
                    :tweet="tweet"
                    :count="tweet.likes.length"
                />
            </div>
        </div>
    </Link>
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

    .tweet-image {
        margin: 12px 24px;
        width: 80%;
    }

    .interaction-icons {
        display: flex;
        gap: 50px;
        margin-top: 12px;
    }
}
</style>
