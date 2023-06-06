<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import TweetInput from "@/Components/tweets/TweetInput.vue";
import UserFeed from "../Components/tweets/UserFeed.vue";
import {onMounted} from "vue";

defineProps({
    user: Object,
})

onMounted(() => {
    console.log(foo)
})

</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h1>Home</h1>
        </template>

        <div class="main">
            <TweetInput placeholder="What's Happening?" :user="user.data"/>
            <suspense>
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
