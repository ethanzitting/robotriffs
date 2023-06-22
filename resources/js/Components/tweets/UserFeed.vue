<script setup>
import {onBeforeUnmount, onMounted, ref} from "vue";
import TweetCards from "./TweetCards.vue";
import * as _ from 'lodash-es'

const props = defineProps({
    user: Object,
    isGuest: {
        type: Boolean,
        default: false
    }
})

const tweets = ref([]);

const linkForNextTweets = ref(
    props.isGuest
        ? '/api/guest-feed'
        : `/api/feeds?user=${props.user.id}`
);

const handleScroll = () => {
    const nearBottomOfScreen = (window.scrollY + window.innerHeight) >=
        (document.body.scrollHeight - 500)

    if (nearBottomOfScreen) {
        fetchChunkOfFeed()
    }
}

const endOfFeedReached = ref(false);

const fetchChunkOfFeed = async () => {
    if (endOfFeedReached.value) {
        return;
    }

    const { data: { data: newTweets, meta }} = await axios.get(linkForNextTweets.value)

    const nextLink = meta.links
        .find(({label}) => label.includes('Next'))

    if (!nextLink.url) {
        endOfFeedReached.value = true
        return
    }

    linkForNextTweets.value = '/api/' + nextLink.url.split('api/')[1]

    if (!props.isGuest) {
        linkForNextTweets.value = linkForNextTweets.value + `&user=${props.user.id}`
    }

    tweets.value = [...tweets.value, ...newTweets];
}

const watchScrollThrottled = _.throttle(handleScroll, 100)

onMounted(async () => {
    await fetchChunkOfFeed();
    window.addEventListener('scroll', watchScrollThrottled);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', watchScrollThrottled);
});

</script>

<template>
    <TweetCards :tweets="tweets" />
</template>
