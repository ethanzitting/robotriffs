<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "@/Components/PostFeed.vue";
import FollowButton from "@/Components/FollowButton.vue";

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
        <p>{{ user.name }}</p>
        <Suspense>
            <FollowButton
                v-if="user.id !== $page.props.auth.user.id"
                :user="user"
            />
        </Suspense>
        <PostFeed :posts="posts" />
    </DefaultLayout>
</template>
