<script setup>

import DefaultLayout from "../Layouts/DefaultLayout.vue";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import {Link} from "@inertiajs/vue3";
import UserAvatar from "../Components/UserAvatar.vue";

const props = defineProps({
    notifications: Array
})
</script>

<template>
    <DefaultLayout>
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft />
            </Link>
            <div class="header-text">
                <h1>Notifications</h1>
            </div>
        </template>
        <div class="here">
            <div v-for="notification in notifications.data">
                <p>Who done it: {{ notification.causedBy.name}}</p>
                <UserAvatar :specified-user="notification.causedBy" class="avatar"/>
                <p>What did they do: {{ notification.type }}</p>
                <p>Relevant tweet content?: {{ notification.tweet?.content }}</p>
                <hr>
            </div>
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;
    height: 30px;
    width: 30px;

    &:hover {
        background-color: #eee;
    }
}

.header-text {
    p {
        font-size: 13px;
        font-weight: 300;
        color: #536471;
    }
}

.avatar {
    height: 45px;
    min-height: 45px;
    width: 45px;
    min-width: 45px;
}

</style>
