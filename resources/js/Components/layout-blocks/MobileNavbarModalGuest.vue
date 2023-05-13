<script setup>
import Modal from "@/Components/Modal.vue";
import {usePage} from "@inertiajs/vue3";
import NavLinkSettings from "./nav-links/NavLinkSettings.vue";
import NavLinkDirectory from "./nav-links/NavLinkDirectory.vue";

const user = usePage().props.auth.user;
</script>

<template>
    <Modal :show="true" @close="$emit('close')">
        <div
            v-show="true"
            class="mobile-navbar tweet-input-modal mb-6 bg-white overflow-hidden shadow-xl transform transition-all sm:mx-auto"
        >
            <NavLinkDirectory class="nav-link"/>
            <NavLinkSettings class="nav-link"/>
        </div>
    </Modal>
</template>

<style lang="scss" scoped>
.mobile-navbar {
    position: fixed;
    top: 0;
    left: 0;
    width: 280px;
    height: 100vh;
    padding: 16px;

    .header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        font-weight: 700;
        font-size: 17px;

        .icon {
            height: 22px;
            width: 22px;
            cursor: pointer;
        }
    }

    .nav-link {
        display: flex;
        gap: 24px;
        margin-bottom: 32px;
        font-size: 20px;
        font-weight: 700;
    }
}
</style>
