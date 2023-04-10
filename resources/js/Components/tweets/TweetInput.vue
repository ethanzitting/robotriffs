<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import CurrentProfilePhoto from "../UserAvater.vue";

const props = defineProps({
    parentTweet: Number,
    placeholder: String,
})

const form = useForm({
    userId: usePage().props.auth.user.id,
    tweetContent: null,
    parentTweet: props.parentTweet,
})

const user = usePage().props.auth.user
</script>

<template>
    <div class="tweet-input-container">
        <CurrentProfilePhoto
            :to="'/' + user.handle"
            size="48px"
            class="icon"
            :user="user"
        />
        <form @submit.prevent="form.post('/api/tweets')">
            <input type="text" :placeholder="placeholder" v-model="form.tweetContent">
            <button type="submit" :disabled="form.processing">Tweet</button>
        </form>
    </div>
</template>

<style lang="scss" scoped>
.tweet-input-container {
    display: flex;
    flex-direction: row;
    gap: 8px;
    padding: 16px;

    .icon {
        width: 40px;
        height: 40px;
    }

    form {
        display: flex;
        flex-direction: column;
        width: 520px;
        gap: 16px;

        input {
            width: 400px;
            height: 50px;
            font-size: 20px;
            border: none;
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
