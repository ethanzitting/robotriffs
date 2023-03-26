<script setup>
import { Head } from '@inertiajs/vue3'
import {matThumbUp} from "@quasar/extras/material-icons";
import DefaultLayout from '@/Layouts/DefaultLayout.vue';

defineProps({ profile: Object })
</script>

<template>
    <DefaultLayout>
        <Head title="Welcome"></Head>
        <h1>Welcome</h1>
        <p>Hello {{ profile.user.name }}, welcome to your first Inertia app!</p>
        <p v-ripple>{{ profile.bio }}</p>
        <q-btn @click="() => $q.notify('My message')" label="Do something"></q-btn>
        <q-card>What</q-card>
        <q-chat-message :text="['How are you?']">Here</q-chat-message>
        <q-color></q-color>
        <q-icon :name="matThumbUp" style="height: 50px; width: 50px;"></q-icon>
    </DefaultLayout>
</template>
