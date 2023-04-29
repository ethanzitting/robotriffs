<script setup>
defineProps({
    size: String,
    color: String,
})
</script>

<template>
    <div
        class="dot"
        :style="`
            height: ${size ?? '2px'};
            width: ${size ?? '2px'};
            background-color: ${color ?? 'black'}
        `"
    ></div>
</template>

<style lang="scss" scoped>
.dot {
    border-radius: 50%;
}
</style>
