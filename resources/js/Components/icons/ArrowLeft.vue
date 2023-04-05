<script setup>

defineProps({
    size: String,
    color: String,
})
</script>

<template>
    <svg
        :viewBox="`0 0 ${size} ${size}`"
        :height="size ?? '24px'"
        :width="size ?? '24px'"
        :stroke="color ?? 'currentColor'"
        aria-hidden="true"
        class="r-18jsvk2 r-4qtqp9 r-yyyyoo r-z80fyv r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-19wmn03"
    >
        <g>
            <path
                d="M7.414 13l5.043 5.04-1.414 1.42L3.586 12l7.457-7.46 1.414 1.42L7.414 11H21v2H7.414z"
            />
        </g>
    </svg>
</template>
