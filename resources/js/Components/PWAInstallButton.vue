<script setup>
import IconDownload from "./icons/IconDownload.vue";
import {systemStore} from "../stores/system";

const system = systemStore();
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
