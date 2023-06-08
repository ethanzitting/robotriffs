<script setup>
import UserAvatar from "../UserAvatar.vue";
import TweetImageInput from "./TweetImageInput.vue";
import IconCamera from "../icons/IconCamera.vue";
import {authStore} from "../../stores/auth";

const emit = defineEmits(['image-selected'])

const user = authStore().user

const handleFileSelected = async (event) => {
    let data = new FormData();
    data.append('image', event, event.name);

    const { data: { data: image } } = await axios.post('/api/images', data)
    user.avatar = image

    emit('image-selected', image)
}
</script>

<template>
    <div class="avatar-editable">
        <UserAvatar
            class="avatar"
            :specified-user="user"
            :key="user.avatar.url"
        />
        <TweetImageInput
            @file-uploaded="handleFileSelected"
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

    .avatar {
        width: 100%;
        height: 100%;
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
