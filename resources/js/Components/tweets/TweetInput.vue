<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import UserAvatar from "../UserAvatar.vue";
import TweetImageInput from "./TweetImageInput.vue";
import TweetImagePreview from "./TweetImagePreview.vue";

const props = defineProps({
    user: Object,
    parentTweet: Number,
    placeholder: String,
})

const user = props.user ?? usePage().props.auth.user

const emit = defineEmits([
    'submitted'
])

const appendImage = (image) => {
    form.image = image
}

const form = useForm({
    tweetContent: '',
    user: user,
    image: null,
    parentTweet: props.parentTweet,
})

const submit = async () => {
    await form.post('/tweets')
    form.reset()
    emit('submitted')
}
</script>

<template>
    <div class="tweet-input-container">
        <UserAvatar
            :to="'/' + user.handle"
            size="48px"
            class="icon"
            :specified-user="user"
        />

        <form enctype="multipart/form-data" @submit.prevent="submit">
            <input
                type="text"
                :placeholder="placeholder"
                v-model="form.tweetContent"
            >
            <div class="preview"></div>
            <TweetImagePreview
                v-if="form.image"
                :image="form.image"
                @clear-image="form.image = null"
            />
            <div class="footer">
                <TweetImageInput
                    v-if="!form.image"
                    class="image-input"
                    @file-uploaded="appendImage"
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

        @media screen and (max-width: 800px) {
            width: initial;
        }

        input {
            width: 400px;
            height: 50px;
            font-size: 20px;
            border: none;

            @media screen and (max-width: 800px) {
                width: initial;
            }
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
