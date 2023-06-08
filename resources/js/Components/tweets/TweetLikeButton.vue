<script setup>
import IconHeart from "../icons/IconHeart.vue";
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    tweet: Object,
    count: Number,
})

const user = usePage().props.auth?.user

const userLikes = props.tweet.likes
    .some(like => String(like.user.id) === String(user?.id))

let localCount = ref(props.count ?? 0)
let localLikes = ref(userLikes)

const unlikeTweet = async () => {
    localCount.value--;
    localLikes.value = false;
    await axios.delete(`/api/likes/1/?tweet=${props.tweet.id}`);
}

const likeTweet = async () => {
    localCount.value++;
    localLikes.value = true;
    await axios.post(`/api/likes?tweet=${props.tweet.id}`)
}

const handleToggle = async () => {
    if (!user) {
        return
    }
    localLikes.value
        ? await unlikeTweet()
        : await likeTweet();
}
</script>

<template>
    <button
        :class="`tweet-like-container ${localLikes ? 'liked' : ''}`"
        @click.prevent="handleToggle"
    >
        <IconHeart class="icon" />
        {{ localCount > 0 ? localCount : '' }}
    </button>
</template>

<style lang="scss" scoped>
.tweet-like-container {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #536471;
    width: min-content;

    &:hover {
        color: red;
    }

    .icon {
        height: 20px;
        width: 20px;
    }

    &.liked {
        color: red;
    }
}
</style>
