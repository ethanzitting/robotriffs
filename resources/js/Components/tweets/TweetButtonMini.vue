<script setup>
import {usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import TweetInputModal from "./TweetInputModal.vue";
import IconFeatherPlus from "../icons/IconFeatherPlus.vue";

const showInputModal = ref(false)
</script>

<template>
    <div class="tweet-button-mini" @click="showInputModal = !showInputModal">
        <IconFeatherPlus class="icon"/>
        <TweetInputModal
            v-if="showInputModal"
            :user="usePage().props.auth.user"
            @close="showInputModal = false"
        />
    </div>
</template>

<style lang="scss" scoped>
.tweet-button-mini {
    color: white;
    background-color: #1d9BF0;
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: rgba(101, 119, 134, 0.2) 0px 0px 8px, rgba(101, 119, 134, 0.25) 0px 1px 3px 1px;

    .icon {
        height: 25px;
        width: 25px;
    }
}
</style>
