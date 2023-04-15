<script setup>
import RetweetIcon from "../icons/RetweetIcon.vue";
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    tweet: Object,
    count: Number,
})

const userRetweets = props.tweet && props.tweet.retweets
    ? props.tweet.retweets.some(retweet => String(retweet.user_id) === String(usePage().props.auth.user.id))
    : false;

let localCount = ref(props.count ?? 0)
let localRetweets = ref(userRetweets)

const unRetweet = async () => {
    localCount.value--;
    localRetweets.value = false;
    await axios.delete(`/api/retweets/1/?user=${usePage().props.auth.user.id}&tweet=${props.tweet.id}`);
}

const Retweet = async () => {
    localCount.value++;
    localRetweets.value = true;
    await axios.post(`/api/retweets?user=${usePage().props.auth.user.id}&tweet=${props.tweet.id}`)
}

const handleToggle = async () => {
    localRetweets.value
        ? unRetweet()
        : Retweet();
}
</script>

<template>
    <button
        :class="`tweet-retweet-container ${localRetweets ? 'retweeted' : ''}`"
        @click.prevent="handleToggle"
    >
        <RetweetIcon size="18px" />
        {{ localCount > 0 ? localCount : '' }}
    </button>
</template>

<style lang="scss" scoped>
.tweet-retweet-container {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #536471;
    width: min-content;

    &:hover {
        color: rgb(0, 186, 124);
    }
}

.retweeted {
        color: rgb(0, 186, 124);
}
</style>
