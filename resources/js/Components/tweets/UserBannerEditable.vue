<script setup>
import TweetImageInput from "./TweetImageInput.vue";
import IconCamera from "../icons/IconCamera.vue";
import {authStore} from "../../stores/auth";

const emit = defineEmits(['image-selected']);

const user = authStore().user
const handleFileSelected = async (event) => {
    let data = new FormData();
    data.append('image', event, event.name);

    const { data: { data: image } } = await axios.post('/api/images', data)
    user.banner = image

    emit('image-selected', image)
}
</script>

<template>
    <div class="banner-editable">
        <div class="banner">
            <img
                :src="user.banner.url"
                :alt="user.banner.alt"
                :key="user.banner.url"
            >
        </div>
        <TweetImageInput
            @file-uploaded="handleFileSelected"
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
