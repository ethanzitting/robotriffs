<script setup>
import ImageIcon from "../icons/ImageIcon.vue";
</script>

<template>
    <label class="tweet-image-input">
        <input
            type="file"
            name="image"
            @change="(event) => $emit('file-uploaded', event.target.files[0])"
            accept="image/*"
        />
        <ImageIcon class="image-icon"/>
    </label>
</template>

<style lang="scss" scoped>
.tweet-image-input {
    display: inline-block;

    input[type="file"] {
        display: none;
    }

    .image-icon {
        min-height: 100%;
        min-width: 100%;
        max-height: 100%;
        max-width: 100%;
        cursor: pointer;
    }
}
</style>
