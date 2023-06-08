<script setup>
import TweetImageInput from "./TweetImageInput.vue";
import IconCamera from "../icons/IconCamera.vue";
import {authStore} from "../../stores/auth";

defineEmits(['file-uploaded']);

const user = authStore().user
</script>

<template>
    <div class="banner-editable">
        <div class="banner">
            <img :src="user.banner.url" :alt="user.banner.alt">
        </div>
        <TweetImageInput
            @file-uploaded="(event) => $emit('file-uploaded', event)"
            class="image-input"
        >
            <IconCamera />
        </TweetImageInput>
    </div>
</template>

<style lang="scss" scoped>
.banner-editable {
    .banner {
        height: 100%;
        width: 100%;
        overflow: hidden;

        img {
            min-width: 100%;
            min-height: 100%;
            object-fit: cover;
        }
    }

    .image-input {
        position: absolute;
        top: calc(50% - 20px);
        left: calc(50% - 20px);
        height: 40px;
        width: 40px;
        padding: 10px;
        border-radius: 50%;
        background: #33333355;
        color: white;
        cursor: pointer;
    }
}
</style>
