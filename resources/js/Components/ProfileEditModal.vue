<script setup>
import Modal from './Modal.vue';
import XMark from "./icons/XMark.vue";
import UserAvater from "./UserAvater.vue";

const emit = defineEmits(['close']);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '2xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const close = () => {
    emit('close');
};
</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div v-show="show" class="profile-edit-modal mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:mx-auto">
            <div class="header">
                <XMark class="close" @click="close"/>
                Edit Profile
            </div>
            <div class="jumbotron">
                <div class="banner"/>
                <UserAvater class="avatar" size="133px"/>
            </div>
            <div class="inputs">
                <input type="text" placeholder="Name">
                <input type="text" placeholder="Bio">
            </div>
        </div>
    </Modal>
</template>

<style lang="scss" scoped>
.profile-edit-modal {
    width: 600px;
    margin: 200px auto 0 auto;

    .header {
        height: 53px;
        display: flex;
        gap: 32px;
        align-items: center;
        padding: 0 16px;

        .close {
            cursor: pointer;
            min-height: 20px;
            max-height: 20px;
            min-width: 20px;
            max-width: 20px;
        }
    }

    .jumbotron {
        height: 265px;
        position: relative;
        margin: 0 4px;

        .banner {
            position: absolute;
            left: 0;
            right: 0;
            top: 0;
            bottom: 70px;
            background-image: url("https://placehold.co/600x400");
            background-size: cover;
            overflow: hidden;
        }

        .avatar {
            position: absolute;
            bottom: 16px;
            left: 16px;
            border: 4px solid white;
        }
    }

    .inputs {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin: 0 16px 16px 16px;
    }
}
</style>
