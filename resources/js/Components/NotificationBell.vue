<script setup>
import IconBell from "./icons/IconBell.vue";
import {authStore} from "../stores/auth";

const auth = authStore()

const notificationCount = auth.user.notifications.filter(({ viewed }) => !viewed).length
</script>

<template>
    <div class="notification-bell">
        <IconBell class="icon" />
        <div class="unread-indicator" v-if="notificationCount > 0">
            {{ notificationCount }}
        </div>
    </div>
</template>

<style lang="scss" scoped>
.notification-bell {
    position: relative;
    width: 25px;
    height: 25px;

    .icon {
        height: 25px;
        min-height: 25px;
        width: 25px;
        min-width: 25px;
    }

    .unread-indicator {
        position: absolute;
        top: -3px;
        right: -3px;
        padding: 3px;
        border: 1px solid black;
        background-color: white;
        font-size: 0.6rem;
        font-weight: 600;
        border-radius: 50%;
        height: 15px;
        width: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>
