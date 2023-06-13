<script setup>
import IconDownload from "./icons/IconDownload.vue";
import {systemStore} from "../stores/system";

const system = systemStore();

// TODO: Only show button on mobile devices.

// TODO: Download on android, show guide modal on IOS.

// TODO: Make sure the button never shows if we are in standalone mode.

// TODO: Use a cookie to determine if the user has installed the app previously.
</script>

<template>
    <button class="pwa-download-button"
            v-if="system.deferredPrompt"
            @click="system.installPWA()"
    >
        <IconDownload class="icon"/>
        Install
    </button>
</template>

<style lang="scss" scoped>
    .pwa-download-button {
        display: flex;
        gap: 4px;

        .icon {
            height: 26px;
            width: 26px;
        }
    }
</style>
