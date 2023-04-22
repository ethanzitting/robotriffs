<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import TweetFeed from "@/Components/tweets/TweetFeed.vue";
import FollowButton from "@/Components/FollowButton.vue";
import UserAvater from "../Components/UserAvater.vue";
import dayjs from "dayjs";
import ArrowLeft from "../Components/icons/ArrowLeft.vue";
import ProfileEditModal from "../Components/ProfileEditModal.vue";
import {ref} from "vue";

const props = defineProps({
    user: Object,
})

const tweets = props.user.data.tweets.map(tweet => {
    return {
        ...tweet,
        user: props.user.data,
    }
})

const showEditModal = ref(false)
</script>

<template>
    <DefaultLayout>
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <template #header>
            <Link href="/home" class="back-arrow">
                <ArrowLeft size="20px" />
            </Link>
            <div class="header-text">
                <h1>{{ user.data.name }}</h1>
                <p>{{ user.data.tweets.length }} Tweet</p>
            </div>
        </template>
        <div class="jumbotron">
            <div class="banner"/>
            <UserAvater class="avatar" size="133px"/>
            <div class="profile-options">
                <button
                    class="edit"
                    v-if="user.data.id === $page.props.auth.user.id"
                    @click="showEditModal = true"
                >
                    Edit Profile
                </button>
                <Suspense v-else>
                    <FollowButton :user="user.data"/>
                </Suspense>
            </div>
        </div>
        <div class="main-text">
            <p class="name">{{ user.data.name }}</p>
            <p class="handle">@{{ user.data.handle }}</p>
            <p>{{ user.data.profile.bio }}</p>
            <p class="joined">Joined {{ dayjs(user.data.dates.created).format('MMMM YYYY') }}</p>
            <div class="connections">
                <p>
                    <span class="number">{{ user.data.following.length }} </span>
                    Following
                </p>
                <p>
                    <span class="number">{{ user.data.followers.length }} </span>
                    Followers
                </p>
            </div>
        </div>
        <div class="tweet-title">
            Tweets
        </div>
        <TweetFeed :tweets="tweets" />
    </DefaultLayout>
    <ProfileEditModal :show="showEditModal" @close="showEditModal = false"/>
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

.header-text {
    p {
        font-size: 13px;
        font-weight: 300;
        color: #536471;
    }
}

.jumbotron {
    height: 265px;
    position: relative;

    .banner {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 70px;
        background-image: url("https://placehold.co/600x400");
        background-size: cover;
        overflow: hidden;
    }

    .avatar {
        position: absolute;
        bottom: 16px;
        left: 16px;
        border: 4px solid white;
    }

    .profile-options {
        position: absolute;
        right: 16px;
        bottom: 16px;

        .edit {
            height: 36px;
            width: 120px;
            border-radius: 18px;
            border: 1px solid #eee;
            font-weight: 700;
        }
    }
}

.main-text {
    padding: 16px;

    &>* {
        margin-bottom: 12px;
    }

    .name {
        font-size: 20px;
        font-weight: 700;
        line-height: 20px;
        margin-bottom: 0;
    }

    .handle {
        font-size: 15px;
        color: #536471;
    }

    .joined {
        color: #536471;
    }

    .connections {
        display: flex;
        gap: 16px;
        color: #536471;

        .number {
            font-weight: 700;
        }
    }
}

.tweet-title {
    height: 53px;
    width: 155px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
