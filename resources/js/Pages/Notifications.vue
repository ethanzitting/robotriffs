<script setup>

import DefaultLayout from "../Layouts/DefaultLayout.vue";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import {Link} from "@inertiajs/vue3";
import UserAvatar from "../Components/UserAvatar.vue";
import IconHeart from "../Components/icons/IconHeart.vue";
import IconPerson from "../Components/icons/IconPerson.vue";
import TweetCard from "../Components/tweets/TweetCard.vue";
import {onMounted} from "vue";
import {authStore} from "../stores/auth";

const props = defineProps({
    notifications: Object
})

const markAllNotificationsViewed = () => {
    setTimeout(() => {
        props.notifications.data
            .filter(({ viewed }) => !viewed)
            .forEach(notification => {
                axios.patch('/api/notifications/' + notification.id, {
                    viewed: true,
                })
            })

        authStore().fetchUser()
    }, 500)
}

onMounted(() => {
    markAllNotificationsViewed()
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
            <template v-for="notification in notifications.data" >
                <Link
                    v-if="notification.type === 'tweetLiked'"
                    :href="`/${notification.causedBy.handle}/tweet/${notification.tweet.id}`"
                    class="notification"
                    :class="{ unread: !notification.viewed }"
                    :ref="'notification_' + notification.id"
                >
                    <IconHeart class="icon"/>
                    <div class="content">
                        <UserAvatar
                            :to="'/'+ notification.causedBy.handle"
                            :specified-user="notification.causedBy"
                            class="avatar"
                        />
                        <p>
                            <Link :href="`${notification.causedBy.handle}`" class="handle">
                                <strong>{{ notification.causedBy.name}}</strong>
                            </Link> liked your reply
                        </p>
                        <p class="subtle">{{ notification.tweet?.content }}</p>
                    </div>
                </Link>
                <TweetCard
                    class="tweet-card notification"
                    :class="{ unread: !notification.viewed }"
                    v-else-if="notification.type === 'replyCreated'"
                    :tweet="notification.tweet"
                    :ref="'notification_' + notification.id"
                />
                <Link
                    v-else-if="notification.type === 'userFollowed'"
                    class="notification"
                    :class="{ unread: !notification.viewed }"
                    :href="`/${notification.causedBy.handle}`"
                    :ref="'notification_' + notification.id"
                >
                    <IconPerson class="icon"/>
                    <div class="content">
                        <UserAvatar
                            :specified-user="notification.causedBy"
                            class="avatar"
                        />
                        <p><strong>{{ notification.causedBy.name}}</strong> followed you</p>
                    </div>
                </Link>
            </template>
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
        border-bottom: 1px solid #EEE;

        &.unread {
            background-color: #c9e5ff;
        }

        .icon {
            height: 30px;
            min-height: 30px;
            width: 40px;
            min-width: 40px;
            padding-right: 10px;
        }

        .content {
            display: flex;
            flex-direction: column;
            gap: 8px;

            .subtle {
                color: grey;
            }

            .avatar {
                height: 32px;
                min-height: 32px;
                width: 32px;
                min-width: 32px;
            }

            .handle {
                &:hover {
                    text-decoration: underline;
                }
            }
        }
    }

    .tweet-card {
        border-bottom: 1px solid #EEE;
    }
}

</style>
