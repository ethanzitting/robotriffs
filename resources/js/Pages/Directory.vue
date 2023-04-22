<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import ArrowLeft from "@/Components/icons/ArrowLeft.vue";

defineProps({
    users: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <Link href="/home" class="back-arrow">
                <ArrowLeft size="20px" />
            </Link>
            <h1>
                Directory
            </h1>
        </template>
        <div>
            <div v-for="user in users.data" :key="user.id">
                <Link :href="'/' + user.handle">{{ user.name}}</Link>
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
</style>
