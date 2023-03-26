<script setup>
import Layout from './Layout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ profile: Object })
</script>

<template>
    <Layout>
        <Head title="Welcome" />
        <h1>Welcome</h1>
        <p>Hello {{ profile.user.name }}, welcome to your first Inertia app!</p>
        <p>{{ profile.bio }}</p>
    </Layout>
</template>
