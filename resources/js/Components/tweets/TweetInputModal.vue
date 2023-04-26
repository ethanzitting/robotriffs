<script setup>
import Modal from "../Modal.vue";
import TweetInput from "./TweetInput.vue";
import TweetCard from "./TweetCard.vue";

defineProps({
    user: Object,
    classFromParent: String,
    tweet: Object,
})
</script>

<template>
    <Modal :show="true" @close="$emit('close')">
        <div
            v-show="true"
            :class="`${classFromParent} tweet-input-modal mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:mx-auto`"
        >
            <TweetCard :tweet="tweet" :show-interaction-icons="false"/>
            <TweetInput
                :user="user"
                placeholder="Whats happening?"
                :parent-tweet="tweet.id"
                @submitted="$emit('close')"
            />
        </div>
    </Modal>
</template>

<style lang="scss" scoped>
.tweet-input-modal {
    background-color: white;
    width: 600px;
    z-index: 5;
}
</style>
