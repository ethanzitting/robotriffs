<script setup>
import UserFeed from "@/Components/tweets/UserFeed.vue";
import GuestLayout from "../Layouts/GuestLayout.vue";
</script>

<template>
    <GuestLayout title="Explore">
        <template #header>
            <h1>Explore</h1>
        </template>

        <div class="main">
            <suspense>
                <UserFeed :is-guest="true"/>
            </suspense>
        </div>
    </GuestLayout>
</template>

<style lang="scss" scoped>
.main {
    &>* {
        border-top: 1px solid #EEEEEE;
    }
}
</style>
