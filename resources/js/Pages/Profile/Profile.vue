<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import FollowButton from "@/Components/FollowButton.vue";
import UserAvatar from "../../Components/UserAvatar.vue";
import dayjs from "dayjs";
import ArrowLeft from "../../Components/icons/ArrowLeft.vue";
import ProfileEditModal from "../../Components/ProfileEditModal.vue";
import {ref} from "vue";
import UserTweets from "@/Components/tweets/UserTweets.vue";

const props = defineProps({
    user: Object,
})

const user = props.user.data;

const showEditModal = ref(false)

const bannerUrl = props.user.data.banner
    ? props.user.data.banner.url
    : 'https://placehold.co/600x400'

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
                <h1>{{ user.name }}</h1>
                <p>{{ user.tweetCount }} Tweet</p>
            </div>
        </template>
        <div class="jumbotron">
            <div class="banner" :style="`background-image: url(${bannerUrl})`"/>
            <UserAvatar class="avatar" size="133px" :specified-user="user"/>
            <div class="profile-options">
                <button
                    class="edit"
                    v-if="user.id === $page.props.auth.user.id"
                    @click="showEditModal = true"
                >
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
            <p class="joined">Joined {{ dayjs(user.dates.created).format('MMMM YYYY') }}</p>
            <div class="connections">
                <Link :href="`/${user.handle}/following`">
                    <span class="number">{{ user.followingCount }} </span>
                    Following
                </Link>
                <Link :href="`/${user.handle}/followers`">
                    <span class="number">{{ user.followerCount }} </span>
                    Followers
                </Link>
            </div>
        </div>
        <div class="tweet-title">
            Tweets
        </div>
        <UserTweets :user="user" />
    </DefaultLayout>
    <ProfileEditModal
        :show="showEditModal"
        @close="showEditModal = false"
        :user="user"
    />
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
