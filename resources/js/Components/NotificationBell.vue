<script setup>
import IconBell from "./icons/IconBell.vue";
import {authStore} from "../stores/auth";

const auth = authStore()

</script>

<template>
    <div class="notification-bell">
        <IconBell class="icon" />
        <div class="unread-indicator" v-if="auth.notificationCount > 0">
            {{ auth.notificationCount }}
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
        border: 1px solid white;
        color: white;
        background-color: #0C72B7;
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
