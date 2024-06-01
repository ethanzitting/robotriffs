<script setup>
import UserAvatar from "@/Components/UserAvatar.vue";
import {Link, usePage} from '@inertiajs/vue3';
import FollowButton from "./FollowButton.vue";
import {authStore} from "../stores/auth";

const props = defineProps({
    user: Object,
})

const authUser = authStore().user;
</script>

<template>
    <Link :href="`/${user.handle}`" class="container">
        <UserAvatar
            :specified-user="user"
            class="avatar"
        />
        <div class="content-wrapper">
            <div class="header">
                <Link :href="'/' + user.handle" class="name">
                    {{ user.name }}
                </Link>
                <FollowButton
                    v-if="authUser && user.id !== usePage().props.auth.user.id"
                    class="follow-button"
                    :user="user"
                />
            </div>
            <Link :href="'/' + user.handle" class="handle">
                @{{ user.handle }}
            </Link>
            <p>{{ user.profile.bio }}</p>
        </div>
    </Link>
</template>

<style lang="scss" scoped>
.container {
    position: relative;
    padding: 12px;
    display: flex;
    flex-direction: row;
    gap: 12px;

    .avatar {
        height: 48px;
        min-height: 48px;
        width: 48px;
        min-width: 48px;
    }

    .content-wrapper {
        width: 100%
    }

    .header {
        position: relative;
        width: auto;
        display: flex;
        flex-direction: row;
        gap: 4px;
        color: #536471;

        .name {
            color: black;
            font-weight: 700;
        }

        .follow-button {
            margin-left: auto;
        }
    }
}
</style>
