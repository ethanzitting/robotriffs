<script setup>
import Layout from './Layout.vue'
import { Head } from '@inertiajs/vue3'

defineProps({ slug: String })
</script>

<template>
    <Layout>
        <Head title="Oops!" />
        <h1>Sorry!</h1>
        <p>There is no user for the slug {{ slug }}!</p>
    </Layout>
</template>
