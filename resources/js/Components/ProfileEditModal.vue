<script setup>
import Modal from './Modal.vue';
import IconXMark from "./icons/IconXMark.vue";
import {useForm} from "@inertiajs/vue3";
import UserAvatarEditable from "./tweets/UserAvatarEditable.vue";
import UserBannerEditable from "./tweets/UserBannerEditable.vue";

const emit = defineEmits(['close']);

const props = defineProps({
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
    user: {
        type: Object,
        required: true,
    }
});

const form = useForm({
    _method: 'PUT',
    name: props.user.name,
    bio: props.user.profile.bio,
    avatar: null,
    banner: null
})

const close = () => {
    form.reset();
    emit('close');
};

const submit = async () => {
    await form.post(`/profiles/${props.user.profile.id}`)
    form.reset()
    emit('close')
}

const appendAvatar = (image) => {
    form.avatar = image
}

const appendBanner = (image) => {
    form.banner = image
}

</script>

<template>
    <Modal
        :show="show"
        :max-width="maxWidth"
        :closeable="closeable"
        @close="close"
    >
        <div v-show="show" class="profile-edit-modal mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:mx-auto">
            <form enctype="multipart/form-data" @submit.prevent="submit">
                <div class="header">
                    <IconXMark class="close" @click="close"/>
                    Edit Profile
                    <button class="save" type="submit" :disabled="form.processing">
                        Save
                    </button>
                </div>
                <div class="jumbotron">
                    <UserBannerEditable class="banner" @file-uploaded="appendBanner"/>
                    <UserAvatarEditable class="avatar" @file-uploaded="appendAvatar"/>
                </div>
                <div class="inputs">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        placeholder="Name"
                        name="name"
                        v-model="form.name"
                    >
                    <label for="bio">Bio</label>
                    <input
                        type="text"
                        name="bio"
                        placeholder="Bio"
                        v-model="form.bio"
                    >
                </div>
            </form>
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

        .save {
            margin-left: auto;
            background-color: #0c1014;
            padding: 4px 12px;
            height: 32px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 700;
            color: white;
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
        margin: 0 16px 16px 16px;

        label {
            margin-top: 16px;
        }
    }
}
</style>
