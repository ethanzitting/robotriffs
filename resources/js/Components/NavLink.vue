<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    parentClasses: String,
    active: Boolean
});

</script>

<template>
    <Link :href="href" :class="parentClasses + (active ? ' active' : '')">
        <slot />
    </Link>
</template>

<style lang="scss" scoped>
.active {
    font-weight: 700;
    color: black;
}
</style>
