<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import IconArrowLeft from "@/Components/icons/IconArrowLeft.vue";
import UserCard from "../Components/UserCard.vue";

defineProps({
    users: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft size="20px" />
            </Link>
            <h1>
                Directory
            </h1>
        </template>
        <div>
            <div v-for="user in users.data" :key="user.id">
                <UserCard :user="user" class="user-card"/>
            </div>
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;

    &:hover {
        background-color: #eee;
    }
}

.user-card {
    &:hover {
        background-color: #EEE;
    }
}
</style>
