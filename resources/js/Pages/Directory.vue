<script setup>
import { Link } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({
    users: Array,
    currentUser: Object,
})
</script>

<template>
    <DefaultLayout title="Dashboard" :user="currentUser">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Directory
            </h2>
        </template>
        <div>
            Directory
            <div v-for="user in users" :key="user.id">
                <Link :href="'/' + user.handle">{{ user.name}}</Link>
            </div>
        </div>
    </DefaultLayout>
</template>
