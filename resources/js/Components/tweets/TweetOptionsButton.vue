<script setup>
import ThreeDotsHorizontal from "../icons/ThreeDotsHorizontal.vue";

defineProps({
    modelValue: Boolean
})
</script>

<template>
    <button
        class="tweet-edit-button"
        @click.prevent="() => $emit('update:modelValue', !modelValue)"
    >
        <ThreeDotsHorizontal />
    </button>
</template>

<style lang="scss" scoped>
.tweet-edit-button {
    padding: 6px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;

    &:hover {
        background-color: #BBB
    }
}
</style>
