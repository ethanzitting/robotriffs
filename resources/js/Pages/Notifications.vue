<script setup>

import DefaultLayout from "../Layouts/DefaultLayout.vue";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import {Link} from "@inertiajs/vue3";
import UserAvatar from "../Components/UserAvatar.vue";
import IconHeart from "../Components/icons/IconHeart.vue";
import IconPerson from "../Components/icons/IconPerson.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";

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
        <div class="notifications">
            <div v-for="notification in notifications.data" class="notification">
                <template v-if="notification.type === 'tweetLiked'">
                    <IconHeart class="icon"/>
                    <div class="content">
                        <UserAvatar
                            :specified-user="notification.causedBy"
                            class="avatar"
                        />
                        <p><strong>{{ notification.causedBy.name}}</strong> liked your reply</p>
                        <p class="subtle">{{ notification.tweet?.content }}</p>
                    </div>
                </template>
                <template v-else-if="notification.type === 'replyCreated'">
                    <TweetCard :tweet="notification.tweet"/>
                </template>
                <template v-else-if="notification.type === 'userFollowed'">
                    <IconPerson class="icon"/>
                    <div class="content">
                        <UserAvatar
                            :specified-user="notification.causedBy"
                            class="avatar"
                        />
                        <p><strong>{{ notification.causedBy.name}}</strong> followed you</p>
                    </div>
                </template>
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

.notifications {
    .notification {
        padding: 12px 16px;
        display: flex;
        gap: 12px;
        border-bottom: 1px solid lightgrey;

        .icon {
            height: 30px;
            min-height: 30px;
            width: 30px;
            min-width: 30px;
        }

        .content {
            display: flex;
            flex-direction: column;
            gap: 8px;

            .subtle {
                color: grey;
            }
        }
    }
}

</style>
