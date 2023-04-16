<script setup>
import UserAvater from "../UserAvater.vue";
import {Link} from '@inertiajs/vue3';
import SingleDot from "../icons/SingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
import TweetLikeButton from "./TweetLikeButton.vue";
import TweetCommentButton from "./TweetCommentButton.vue";
import RetweetButton from "./RetweetButton.vue";
import RetweetIcon from "../icons/RetweetIcon.vue";
dayjs.extend(relativeTime)
const props = defineProps({
        tweet: Object,
        showStats: Boolean
    })
const isRetweet = Boolean( props.tweet.retweet )
</script>

<template>
    <Link :href="`/${tweet.user.handle}/tweet/${tweet.id}`" class="container">
        <UserAvater
            :to="'/' + tweet.user.handle"
            :user="tweet.user"
            :size="'48px'"
        />
        <div class="content-wrapper">
            <div class="retweet-header">
                <RetweetIcon size="18px" v-if="isRetweet" />
                <Link v-if="isRetweet" :href="'/' + tweet.retweet.user.handle " class="retweet">
                    @{{tweet.retweet.user.handle}} Retweeted
                </Link>
            </div>
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
            <p v-if="tweet.parent?.user">
                Replying to
                <Link :href="'/' + tweet.parent.user.handle">
                    @{{ tweet.parent.user.handle}}
                </Link>
            </p>

            <p>{{ tweet.content }}</p>
            <div v-if="showStats" class="stats">{{ dayjs(tweet.created_at).fromNow() }}</div>
            <div class="interaction-icons">
                <TweetCommentButton
                    :count="tweet.children?.length"
                />
                <RetweetButton
                    :tweet="tweet"
                    :count="tweet.retweets?.length"
                />
                <TweetLikeButton
                    :tweet="tweet"
                    :count="tweet.likes?.length"
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
    .retweet-header {
        display: flex;
        flex-direction: row;
        gap: 4px;
        color: #536471;
        font-size: 14px;
        margin-bottom: 4px;

        .retweet {
            color: #71767B;
            font-weight: 700;
        }

        svg {
            width: 16px;
            height: 16px;
            fill: #536471;
            color: rgb(113, 118, 123);
            }
    }

    .interaction-icons {
        display: flex;
        gap: 50px;
        margin-top: 12px;
    }
}
</style>
