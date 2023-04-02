<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "@/Components/PostFeed.vue";

const props = defineProps({
    user: Object,
})

props.user.posts = props.user.posts.map(post => {
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
        <PostFeed :posts="user.posts"></PostFeed>
    </DefaultLayout>
</template>
