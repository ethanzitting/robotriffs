<script setup>
defineProps({
    size: Number,
    color: String,
})
</script>

<template>
    <svg
        viewBox="0 0 24 24"
        aria-hidden="true"
        :width="size ?? '50px'"
        :height="size ?? '50px'"
        class="r-9uu7rm r-jwli3a r-4qtqp9 r-yyyyoo r-1x9qfqz r-n6v787 r-1xvli5t r-dnmrzs r-u8s1d r-1plcrui r-uoibet r-lrvibr r-lrsllp"
    >
        <g>
            <path
                d="M22 17H2L12 6l10 11z"
                :fill="color ?? 'currentColor'"
            />
        </g>
    </svg>
</template>
