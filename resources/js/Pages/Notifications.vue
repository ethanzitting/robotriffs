<script setup>

import DefaultLayout from "../Layouts/DefaultLayout.vue";
import IconArrowLeft from "../Components/icons/IconArrowLeft.vue";
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <DefaultLayout>
        <template #header>
            <Link href="/home" class="back-arrow">
                <IconArrowLeft />
            </Link>
            <div class="header-text">
                <h1>Notifications</h1>
            </div>
        </template>
        <div class="here">
            Notifications coming soon!
        </div>
    </DefaultLayout>
</template>

<style lang="scss" scoped>
.back-arrow {
    padding: 5px;
    border-radius: 50%;
    margin-right: 30px;
    height: 30px;
    width: 30px;

    &:hover {
        background-color: #eee;
    }
}

.header-text {
    p {
        font-size: 13px;
        font-weight: 300;
        color: #536471;
    }
}

</style>
