<script setup>
import UserAvatar from "../UserAvatar.vue";
import {Link, usePage} from '@inertiajs/vue3';
import IconSingleDot from "../icons/IconSingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
import TweetLikeButton from "./TweetLikeButton.vue";
import TweetCommentButton from "./TweetCommentButton.vue";
import TweetImage from "./TweetImage.vue";
import TweetOptionsButton from "./TweetOptionsButton.vue";
import {ref} from "vue";
import TweetOptionsModal from "./TweetOptionsModal.vue";
import TweetInputModal from "./TweetInputModal.vue";
dayjs.extend(relativeTime)

const props = defineProps({
    tweet: {
        type: Object,
        required: true,
    },
    showStats: {
        type: Boolean,
        default: false,
    },
    showInteractionIcons: {
        type: Boolean,
        default: true
    }
})

const showOptionsModal = ref(false);
const showReplyModal = ref(false);

const deleteTweet = async () => {
    await axios.delete('/api/tweets/' + props.tweet.id)
    showOptionsModal.value = false
}
</script>

<template>
    <Link :href="`/${tweet.user.handle}/tweet/${tweet.id}`" class="container">
        <UserAvatar
            :to="'/' + tweet.user.handle"
            :specified-user="tweet.user"
            class="avatar"
        />
        <div class="content-wrapper">
            <div class="tweet-header">
                <Link :href="'/' + tweet.user.handle" class="name">
                    {{ tweet.user.name }}
                </Link>
                <Link :href="'/' + tweet.user.handle" class="handle">
                    @{{ tweet.user.handle }}
                </Link>
                <IconSingleDot class="dot"/>
                <span>{{ dayjs(tweet.dates.created).fromNow() }}</span>
                <TweetOptionsModal
                    class-from-parent="options-modal"
                    v-if="showOptionsModal"
                    @close="showOptionsModal = false"
                    @delete-tweet="deleteTweet"
                />
                <TweetOptionsButton
                    v-if="tweet.user.id == usePage().props.auth.user.id"
                    class="options-button"
                    v-model="showOptionsModal"
                />
            </div>
            <p v-if="tweet.parent?.user">
                Replying to
                <Link :href="'/' + tweet.parent.user.handle">
                    @{{ tweet.parent.user.handle}}
                </Link>
            </p>
            <p>{{ tweet.content }}</p>
            <TweetImage class="tweet-image" v-if="tweet.image" :src="tweet.image.url"/>
            <div v-if="showStats" class="stats">
                {{ dayjs(tweet.dates.created).fromNow() }}
            </div>
            <div class="interaction-icons">
                <template v-if="showInteractionIcons">
                    <TweetCommentButton
                        :count="tweet.replyCount"
                        @click.prevent="showReplyModal = !showReplyModal"
                    />
                    <TweetInputModal
                        :show="showReplyModal"
                        @close="showReplyModal = false"
                        :user="usePage().props.auth.user"
                        :tweet="tweet"
                    />
                    <TweetLikeButton
                        :tweet="tweet"
                        :count="tweet.likeCount"
                    />
                </template>
            </div>
        </div>
    </Link>
</template>

<style lang="scss" scoped>
.container {
    position: relative;
    padding: 12px;
    display: flex;
    flex-direction: row;
    gap: 12px;

    .avatar {
        height: 44px;
        width: 44px;
    }

    .content-wrapper {
        width: 100%
    }

    .tweet-header {
        position: relative;
        width: auto;
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

        .options-modal {
            position: absolute;
            top: 0;
            right: 40px;
            width: min-content;
            height: min-content;
        }

        .options-button {
            position: absolute;
            top: 0;
            right: 0;
            min-height: 35px;
            max-height: 35px;
            min-width: 35px;
            max-width: 35px;
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
