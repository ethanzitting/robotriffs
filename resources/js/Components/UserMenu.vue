<script setup>
import UserAvatar from "./UserAvatar.vue";
import IconThreeDotsHorizontal from "./icons/IconThreeDotsHorizontal.vue";
import {router, usePage} from "@inertiajs/vue3";
import {ref} from "vue";
import IconTriangle from "./icons/IconTriangle.vue";

let popupClass = ref('hidden');

let togglePopup = () => {
    if (popupClass.value === 'hidden') {
        popupClass.value = 'showing'
        setTimeout(() => popupClass.value = '')
        return
    }

    popupClass.value = 'hiding'
    setTimeout(() => popupClass.value = 'hidden', 150)
}
</script>

<template>
    <div class="user-menu">
        <button
            :class="`popup ${popupClass}`"
            @click="router.post(route('logout'))"
        >
            Log out @{{ usePage().props.auth.user.handle }}
            <IconTriangle class="triangle" />
        </button>
        <button class="open-menu" @click="togglePopup">
            <UserAvatar class="avatar"/>
            <div class="text-content">
                <p class="name">{{ $page.props.auth.user.name }}</p>
                <p class="handle">@{{ $page.props.auth.user.handle }}</p>
            </div>
            <IconThreeDotsHorizontal class="dots"/>
        </button>
    </div>
</template>

<style lang="scss" scoped>
.user-menu {
    position: relative;
    font-size: 15px;

    .popup {
        position: absolute;
        top: -60px;
        left: 0;
        height: 50px;
        width: 240px;
        background-color: white;
        box-shadow: rgba(101, 119, 134, 0.2) 0 0 15px, rgba(101, 119, 134, 0.15) 0 0 3px 1px;
        padding: 12px 16px;
        border-radius: 16px;
        font-weight: 700;
        font-size: 15px;
        text-align: left;
        transition: opacity 0.2s;
        opacity: 100%;

        &.showing {
            display: initial;
            opacity: 0;
        }

        &.hiding {
            opacity: 0;
        }

        &.hidden {
            display: none;
            opacity: 0;
        }

        .triangle {
            position: relative;
            bottom: -11px;
            left: calc(50% - 8px);
            transform: rotate(180deg);
            filter: drop-shadow(rgb(207, 217, 222) 1px -1px 1px);
        }
    }

    .open-menu {
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

        @media (max-width: 1250px) {
            flex-direction: column;

            .name, .handle, .dots {
                display: none;
            }
        }
    }
}
</style>
