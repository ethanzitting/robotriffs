<script setup>
import IconChatBubble from "../icons/IconChatBubble.vue";

defineProps({
    tweet: Object,
    count: Number,
})
</script>

<template>
    <button
        class="tweet-comment-button"
    >
        <IconChatBubble class="icon" />
        {{ count > 0 ? count : '' }}
    </button>
</template>

<style lang="scss" scoped>
.tweet-comment-button {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #536471;
    width: min-content;

    &:hover {
        color: green;
    }

    .icon {
        height: 18px;
        width: 18px;
    }
}
</style>
