<script setup>
import UserAvatar from "../UserAvatar.vue";
import TweetImageInput from "./TweetImageInput.vue";
import IconCamera from "../icons/IconCamera.vue";
</script>

<template>
    <div class="avatar-editable">
        <UserAvatar class="avatar" size="133px"/>
        <TweetImageInput
            @file-uploaded="(event) => $emit('file-uploaded', event)"
            class="image-input"
        >
            <IconCamera />
        </TweetImageInput>
    </div>
</template>

<style lang="scss" scoped>
.avatar-editable {
    position: relative;
    height: min-content;
    border-radius: 50%;

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
