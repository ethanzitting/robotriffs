<script setup>
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import TweetInputModal from "./TweetInputModal.vue";

const showInputModal = ref(false)
</script>

<template>
    <div class="tweet-button" @click="showInputModal = !showInputModal">
        Tweet
        <TweetInputModal
            v-if="showInputModal"
            :user="usePage().props.auth.user"
            @close="showInputModal = false"
        />
    </div>
</template>

<style lang="scss" scoped>
.tweet-button {
    color: white;
    background-color: #1d9BF0
}
</style>
