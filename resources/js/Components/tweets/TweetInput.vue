<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import CurrentProfilePhoto from "../UserAvater.vue";
import TweetImageInput from "./TweetImageInput.vue";
import TweetImagePreview from "./TweetImagePreview.vue";
import {ref} from "vue";

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
const image = ref(null)
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
            <input
                type="text"
                :placeholder="placeholder"
                v-model="form.tweetContent"
            >
            <div class="preview"></div>
            <TweetImagePreview
                v-if="image"
                :image="image"
                @clear-image="image = null"
            />
            <div class="footer">
                <TweetImageInput
                    v-if="!image"
                    class="image-input"
                    @file-uploaded="(file) => (image = file)"
                />
                <button type="submit" :disabled="form.processing">
                    Tweet
                </button>
            </div>
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
        gap: 8px;

        input {
            width: 400px;
            height: 50px;
            font-size: 20px;
            border: none;
        }

        .footer {
            display: flex;
            align-items: center;
            margin-left: 12px;

            .image-input {
                height: 20px;
                width: 20px;
                max-width: 20px;
                min-width: 20px;
                max-height: 20px;
                min-height: 20px;
                cursor: pointer;
            }


            button {
                align-self: flex-end;
                height: 40px;
                width: 80px;
                border-radius: 20px;
                background-color: lightblue;
                margin-left: auto;
            }
        }
    }
}
</style>
