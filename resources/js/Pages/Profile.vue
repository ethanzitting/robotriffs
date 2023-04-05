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
            <Link href="/home">
                <ArrowLeft size="40px"/>
            </Link>
            <div class="text-content">
                <h1>{{ user.name }}</h1>
                <p>{{ user.posts.length }} Tweet</p>
            </div>
        </div>
        <div class="">
            Banner
            <UserAvater size="133px"/>
            <button v-if="user.id === $page.props.auth.user.id">
                Edit Profile
            </button>
            <Suspense v-else>
                <FollowButton :user="user"/>
            </Suspense>
        </div>
        <p>{{ user.name }}</p>
        <p>@{{ user.handle }}</p>
        <p>{{ user.profile.bio }}</p>
        <p>Joined {{ dayjs(user.created_at).format('MMMM YYYY') }}</p>
        <p>{{ user.following.length }} Following</p>
        <p>{{ user.followers.length }} Followers</p>
        Tweets
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
}
</style>
