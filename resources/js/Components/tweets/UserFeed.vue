<script setup>
import {onMounted, ref} from "vue";
import TweetCards from "./TweetCards.vue";

const props = defineProps({
    user: Object,
})

const tweets = ref([]);

onMounted(async () => {
    const response = await axios.get(`/api/feeds?user=${props.user.id}`);

    tweets.value = response.data.data
});

</script>

<template>
    <TweetCards :tweets="tweets" />
</template>
