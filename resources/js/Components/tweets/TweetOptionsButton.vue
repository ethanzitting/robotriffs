<script setup>
import IconThreeDotsHorizontal from "../icons/IconThreeDotsHorizontal.vue";

defineProps({
    modelValue: Boolean
})
</script>

<template>
    <button
        class="tweet-edit-button"
        @click.prevent="() => $emit('update:modelValue', !modelValue)"
    >
        <IconThreeDotsHorizontal />
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
