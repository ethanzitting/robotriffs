<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import IconArrowLeft from "../../Components/icons/IconArrowLeft.vue";
import UserCard from "../../Components/UserCard.vue";
import {authStore} from "../../stores/auth";
import GuestLayout from "../../Layouts/GuestLayout.vue";

const props = defineProps({
    user: Object,
})

const user = props.user.data

const authUser = authStore().user;
</script>

<template>
    <DefaultLayout v-if="authUser">
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft />
            </Link>
            <div class="header-text">
                <h1>{{ user.name }}</h1>
                <p>@{{ user.handle }}</p>
            </div>
        </template>
        <div v-for="user in user.followers" :key="user.id">
            <UserCard :user="user" class="user-card"/>
        </div>
    </DefaultLayout>
    <GuestLayout v-else>
        <Head>
            <title>{{ user.name}}</title>
        </Head>
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft />
            </Link>
            <div class="header-text">
                <h1>{{ user.name }}</h1>
                <p>@{{ user.handle }}</p>
            </div>
        </template>
        <div v-for="user in user.followers" :key="user.id">
            <UserCard :user="user" class="user-card"/>
        </div>
    </GuestLayout>
</template>

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;
    height: 30px;
    width: 30px;

    &:hover {
        background-color: #eee;
    }
}

.header-text {
    p {
        font-size: 13px;
        font-weight: 300;
        color: #536471;
    }
}
</style>
