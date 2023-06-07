<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import TweetInput from "@/Components/tweets/TweetInput.vue";
import UserFeed from "../Components/tweets/UserFeed.vue";
import {ref} from "vue";

defineProps({ user: Object })

let feedKey = ref(0)

const reloadFeed = () => feedKey = feedKey.value + 1
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h1>Home</h1>
        </template>

        <div class="main">
            <TweetInput
                placeholder="What's Happening?"
                :user="user.data"
                @submitted="reloadFeed"
            />
            <suspense :key="feedKey">
                <UserFeed :user="user.data"/>
            </suspense>
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.main {
    &>* {
        border-top: 1px solid #EEEEEE;
    }
}
</style>
