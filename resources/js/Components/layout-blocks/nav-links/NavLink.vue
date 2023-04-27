<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    linkTo: String,
    active: Boolean
});

</script>

<template>
    <Link :href="linkTo" :class="active ? ' active' : ''">
        <slot />
    </Link>
</template>

<style lang="scss" scoped>
.active {
    font-weight: 700;
    color: black;
}
</style>
