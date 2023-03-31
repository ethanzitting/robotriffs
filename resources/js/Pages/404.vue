<script setup>
import { Head } from '@inertiajs/vue3'
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({ slug: String })
</script>

<template>
    <DefaultLayout>
        <Head title="Oops!" />
        <h1>Sorry!</h1>
        <p>There is no user for the slug {{ slug }}!</p>
    </DefaultLayout>
</template>
