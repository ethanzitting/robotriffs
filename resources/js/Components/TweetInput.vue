<script setup>
import {useForm} from "@inertiajs/vue3";
import CurrentProfilePhoto from "./CurrentProfilePhoto.vue";

defineProps({
    user: Object
})

const form = useForm({
    postContent: null,
})
</script>

<template>
    <div class="wrapper">
        <CurrentProfilePhoto class="icon" :user="user"/>
        <form @submit.prevent="form.post('/posts')">
            <input type="text" placeholder="What's happening?" v-model="form.postContent">
            <button type="submit" :disabled="form.processing">Tweet</button>
        </form>
    </div>
</template>

<style lang="scss" scoped>
.wrapper {
    display: flex;
    flex-direction: row;
    gap: 24px;
    padding: 24px;

    .icon {
        width: 40px;
        height: 40px;
    }

    form {
        margin-top: 40px;
        display: flex;
        flex-direction: column;
        gap: 16px;

        input {
            width: 400px;
            height: 50px;
        }

        button {
            align-self: flex-end;
            height: 40px;
            width: 80px;
            border-radius: 20px;
            background-color: lightblue;
        }
    }
}
</style>
