<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import PostFeed from "@/Components/PostFeed.vue";

defineProps({
    user: Object,
    currentUser: Object,
})

</script>

<template>
    <DefaultLayout :user="currentUser">
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <p>{{ user.name }}</p>
        <PostFeed :posts="user.posts"></PostFeed>
    </DefaultLayout>
</template>
