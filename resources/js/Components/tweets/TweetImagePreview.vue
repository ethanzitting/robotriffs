<script setup>
import {onMounted} from "vue";
import IconXMark from "../icons/IconXMark.vue";

const props = defineProps({
    image: File
})

function handleFile() {
    if (!props.image.type.startsWith("image/")) {
        return;
    }

    const img = document.createElement("img");
    img.classList.add("obj");
    img.file = props.image;
    document.querySelector('.image-preview')
        .appendChild(img);

    const reader = new FileReader();
    reader.onload = (e) => {
        img.src = e.target.result;
    };
    reader.readAsDataURL(props.image);
}

onMounted(() => {
    handleFile()
})
</script>

<template>
    <div class="image-preview">
        <IconXMark class="delete-icon" @click="$emit('clear-image')" />
    </div>
</template>

<style lang="scss" scoped>
.image-preview {
    position: relative;
    height: 500px;
    width: 500px;
    border-radius: 15px;
    overflow: hidden;
    margin-bottom: 15px;

    .delete-icon {
        position: absolute;
        top: 25px;
        left: 25px;
        height: 25px;
        width: 25px;
        cursor: pointer;
    }
}
</style>
