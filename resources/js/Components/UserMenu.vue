<script setup>
import UserAvater from "./UserAvater.vue";
import ThreeDotsHorizontal from "./icons/ThreeDotsHorizontal.vue";
import {router} from "@inertiajs/vue3";

const logout = () => {
    router.post(route('logout'));
}
</script>

<template>
    <div class="container">
        <button @click="logout">
            <UserAvater />
            <div class="text-content">
                <p class="name">{{ $page.props.user?.name }}</p>
                <p class="handle">@{{ $page.props.user?.handle }}</p>
            </div>
            <ThreeDotsHorizontal />
        </button>
    </div>
</template>

<style lang="scss" scoped>
.container {
    font-size: 15px;

    button {
        width: 100%;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 12px;

        .name {
            font-weight: 700;
        }

        .handle {
            color: #536471;
        }

        &>*:last-child {
            margin-left: auto;
        }
    }
}
</style>
