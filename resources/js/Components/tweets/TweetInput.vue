<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import CurrentProfilePhoto from "../UserAvater.vue";
import TweetImageInput from "./TweetImageInput.vue";
import TweetImagePreview from "./TweetImagePreview.vue";

const props = defineProps({
    parentTweet: Number,
    placeholder: String,
})

const user = usePage().props.auth.user

const form = useForm({
    userId: user.id,
    tweetContent: null,
    parentTweet: props.parentTweet,
    image: null,
})

const saveTweet = async () => {
    try {
        await axios.post(
            '/api/tweets',
            {
                userId: form.userId,
                tweetContent: form.tweetContent,
                parentTweet: form.parentTweet,
                image: form.image,
            }
        )
        form.reset()
    } catch (e) {
        console.log('Failed saving tweet')
        console.error(e)
    }
}
</script>

<template>
    <div class="tweet-input-container">
        <CurrentProfilePhoto
            :to="'/' + user.handle"
            size="48px"
            class="icon"
            :user="user"
        />

        <form enctype="multipart/form-data" @submit.prevent="saveTweet">
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
                    @file-uploaded="image => form.image = image"
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
