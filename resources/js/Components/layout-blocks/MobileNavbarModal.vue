<script setup>
import Modal from "@/Components/Modal.vue";
import UserAvatar from "../UserAvatar.vue";
import {Link, usePage} from "@inertiajs/vue3";
import NavLinkProfile from "./nav-links/NavLinkProfile.vue";
import NavLinkSettings from "./nav-links/NavLinkSettings.vue";
import IconXMark from "../icons/IconXMark.vue";
import NavLinkDirectory from "./nav-links/NavLinkDirectory.vue";
import NavLinkNotifications from "./nav-links/NavLinkNotifications.vue";
import NavLinkLogOut from "./nav-links/NavLinkLogOut.vue";
import {authStore} from "../../stores/auth";

const user = authStore().user
</script>

<template>
    <Modal :show="true" @close="$emit('close')">
        <div
            v-show="true"
            class="mobile-navbar tweet-input-modal mb-6 bg-white overflow-hidden shadow-xl transform transition-all sm:mx-auto"
        >
            <div class="header">
                Account Info
                <IconXMark class="icon" @click.prevent="$emit('close')"/>
            </div>
            <div class="user-stats">
                <UserAvatar :to="`/${user.handle}`" class="avatar"/>
                <Link :href="`/${user.handle}`">
                    <p class="name">{{ user.name}}</p>
                </Link>
                <Link :href="`/${user.handle}`">
                    <p class="handle">@{{ user.handle}}</p>
                </Link>
                <div class="network-links">
                    <Link :href="`/${user.handle}/following`">
                        <span class="number">{{ user.followers.length }} </span>
                        Following
                    </Link>
                    <Link :href="`/${user.handle}/followers`">
                        <span class="number">{{ user.following.length }} </span>
                        Followers
                    </Link>
                </div>
            </div>
            <NavLinkNotifications class="nav-link"/>
            <NavLinkProfile class="nav-link"/>
            <NavLinkDirectory class="nav-link"/>
            <NavLinkSettings class="nav-link"/>
            <NavLinkLogOut class="nav-link" />
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

    .user-stats {
        margin-top: 32px;
        margin-bottom: 32px;

        .avatar {
            display: inline-block;
            height: 40px;
            width: 40px;
        }

        .name {
            margin-top: 4px;
            font-size: 17px;
            font-weight: 700;
        }

        .handle {
            font-size: 15px;
            margin-bottom: 12px;
            color :#888;
        }

        .network-links {
            font-size: 14px;
            color: grey;
            display: flex;
            gap: 15px;

            .number {
                color: black;
                font-weight: bold;
            }
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
