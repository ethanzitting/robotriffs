<script setup>
import UserAvater from "./UserAvater.vue";
import {Link} from '@inertiajs/vue3';
import SingleDot from "./icons/SingleDot.vue";
import dayjs from "dayjs";

import relativeTime from 'dayjs/plugin/relativeTime';
dayjs.extend(relativeTime)

defineProps({
    post: Object
})
</script>

<template>
    <div class="container">
        <UserAvater
            :to="'/' + post.user.handle"
            :user="post.user"
            :size="'48px'"
        />
        <div class="content-wrapper">
            <div class="tweet-header">
                <Link :href="'/' + post.user.handle" class="name">
                    {{ post.user.name }}
                </Link>
                <Link :href="'/' + post.user.handle" class="handle">
                    @{{ post.user.handle }}
                </Link>
                <SingleDot class="dot"/>
                <span>{{ dayjs(post.created_at).fromNow() }}</span>
            </div>
            <p>{{ post.content }}</p>
        </div>
    </div>
</template>

<style lang="scss" scoped>
.container {
    padding: 12px;
    display: flex;
    flex-direction: row;
    gap: 12px;

    .tweet-header {
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
    }
}
</style>
