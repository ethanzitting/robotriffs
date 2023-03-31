<script setup>
defineProps({
    user: Object,
    parentClasses: String
})
</script>

<template>
    <img
        :src="user.profile_photo_url"
        :alt="user.name" :class="`${parentClasses} rounded-full h-20 w-20 object-cover`"
    >
</template>

<style>

</style>
