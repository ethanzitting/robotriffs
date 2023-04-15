<script setup>
import UserAvater from "../UserAvater.vue";
import {Link} from '@inertiajs/vue3';
import SingleDot from "../icons/SingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
import TweetLikeButton from "./TweetLikeButton.vue";
import TweetCommentButton from "./TweetCommentButton.vue";
dayjs.extend(relativeTime)
const props = defineProps({
        tweet: Object,
        showStats: Boolean
    })
const isRetweet = Boolean( props.tweet.retweet )
console.log(props.tweet)
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
                <svg v-if="isRetweet" viewBox="0 0 24 24" aria-hidden="true" class="r-1bwzh9t r-4qtqp9 r-yyyyoo r-10ptun7 r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1janqcz"><g><path d="M4.75 3.79l4.603 4.3-1.706 1.82L6 8.38v7.37c0 .97.784 1.75 1.75 1.75H13V20H7.75c-2.347 0-4.25-1.9-4.25-4.25V8.38L1.853 9.91.147 8.09l4.603-4.3zm11.5 2.71H11V4h5.25c2.347 0 4.25 1.9 4.25 4.25v7.37l1.647-1.53 1.706 1.82-4.603 4.3-4.603-4.3 1.706-1.82L18 15.62V8.25c0-.97-.784-1.75-1.75-1.75z"></path></g></svg>
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
