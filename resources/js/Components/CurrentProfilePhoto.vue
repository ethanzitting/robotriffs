<script setup>
defineProps({
    parentClasses: String
})
</script>

<template>
    <img
        :src="$page.props.auth.user.profile_photo_url"
        :alt="$page.props.auth.user.name" :class="`${parentClasses ?? ''} rounded-full h-20 w-20 object-cover`"
    >
</template>
