<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    users: Array,
})
</script>

<template>
    <DefaultLayout title="Dashboard">
        <template #header>
            <h1>
                Directory
            </h1>
        </template>
        <div>
            Directory
            <div v-for="user in users" :key="user.id">
                <Link :href="'/' + user.handle">{{ user.name}}</Link>
            </div>
        </div>
    </DefaultLayout>
</template>
