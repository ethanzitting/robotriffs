<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "@/Components/PostFeed.vue";
import FollowButton from "@/Components/FollowButton.vue";
import UserAvater from "../Components/UserAvater.vue";
import dayjs from "dayjs";
import ArrowLeft from "../Components/icons/ArrowLeft.vue";

const props = defineProps({
    user: Object,
})

const posts = props.user.posts.map(post => {
    return {
        ...post,
        user: props.user,
    }
})
</script>

<template>
    <DefaultLayout>
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <div class="header">
            <Link href="/home" class="back-arrow">
                <ArrowLeft size="20px" />
            </Link>
            <div class="text-content">
                <h1>{{ user.name }}</h1>
                <p>{{ user.posts.length }} Tweet</p>
            </div>
        </div>
        <div class="jumbotron">
            <div class="banner"/>
            <UserAvater class="avatar" size="133px"/>
            <div class="profile-options">
                <button class="edit" v-if="user.id === $page.props.auth.user.id">
                    Edit Profile
                </button>
                <Suspense v-else>
                    <FollowButton :user="user"/>
                </Suspense>
            </div>
        </div>
        <div class="main-text">
            <p class="name">{{ user.name }}</p>
            <p class="handle">@{{ user.handle }}</p>
            <p>{{ user.profile.bio }}</p>
            <p class="joined">Joined {{ dayjs(user.created_at).format('MMMM YYYY') }}</p>
            <div class="connections">
                <p>
                    <span class="number">{{ user.following.length }} </span>
                    Following
                </p>
                <p>
                    <span class="number">{{ user.followers.length }} </span>
                    Followers
                </p>
            </div>
        </div>
        <div class="post-title">
            Tweets
        </div>
        <PostFeed :posts="posts" />
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.header {
    height: 53px;
    width: 100%;
    border-bottom: 1px solid #eeeeee;

    display: flex;
    flex-direction: row;
    align-items: center;

    .back-arrow {
        padding: 5px;
        margin: auto 30px auto 16px;
        border-radius: 50%;

        &:hover {
            background-color: #eee;
        }
    }

    .text-content {
        h1 {
            font-size: 20px;
            font-weight: 700;
        }

        p {
            font-size: 13px;
            color: #536471;
        }
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

.post-title {
    height: 53px;
    width: 155px;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
