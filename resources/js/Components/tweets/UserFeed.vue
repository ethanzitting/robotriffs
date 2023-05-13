<script setup>
import {onMounted, ref} from "vue";
import TweetCards from "./TweetCards.vue";

const props = defineProps({
    user: Object,
    isGuest: {
        type: Boolean,
        default: false
    }
})

const tweets = ref([]);

onMounted(async () => {
    let response
    if (props.isGuest) {
        response  = await axios.get(`/api/guest-feed`)
    } else {
        response = await axios.get(`/api/feeds?user=${props.user.id}`);
    }
    tweets.value = response.data.data
});

</script>

<template>
    <TweetCards :tweets="tweets" />
</template>
