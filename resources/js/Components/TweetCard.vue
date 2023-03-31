<script setup>
defineProps({
    post: Object
})
</script>

<template>
    <div class="wrapper">
        {{ post.content }}
    </div>
</template>
