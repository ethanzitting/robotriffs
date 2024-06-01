<script setup>
import {Head} from '@inertiajs/vue3'
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import {authStore} from "../stores/auth";
import GuestLayout from "../Layouts/GuestLayout.vue";

defineProps({
    slug: String,
})


const user = authStore().user

</script>

<template>
    <template v-if="user">
        <DefaultLayout>
            <Head title="Oops!" />
            <h1>Sorry!</h1>
            <p>There is no user for the slug {{ slug }}!</p>
        </DefaultLayout>
    </template>
    <template v-else>
        <GuestLayout>
            <Head title="Oops!" />
            <h1>Sorry!</h1>
            <p>There is no user for the slug {{ slug }}!</p>
        </GuestLayout>
    </template>
</template>
