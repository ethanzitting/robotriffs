<script setup>
import ChatBubble from "../icons/ChatBubble.vue";

defineProps({
    tweet: Object,
    count: Number,
})
</script>

<template>
    <button
        class="tweet-like-container"
    >
        <ChatBubble size="18px" />
        {{ count > 0 ? count : '' }}
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
        color: green;
    }
}

.liked {
    color: red;
}
</style>
