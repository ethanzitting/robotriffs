<script setup>
import Modal from "../Modal.vue";
import IconTrashCan from "../icons/IconTrashCan.vue";

defineProps({
    classFromParent: String
})
</script>

<template>
    <Modal :show="true" @close="$emit('close')">
        <div
            v-show="true"
            :class="`${classFromParent} tweet-options-modal mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:mx-auto`"
        >
            <Button class="delete" @click="$emit('delete-tweet')">
                <IconTrashCan class="icon"/>
                Delete
            </Button>
        </div>
    </Modal>
</template>

<style lang="scss" scoped>
.tweet-options-modal {
    background-color: white;
    width: 200px;
    z-index: 5;

    .delete {
        color: #F4212E;
        font-weight: 500;
        display: flex;
        gap: 16px;
        width: 100%;
        padding: 8px;

        &:hover {
            background-color: #eee;
        }

        .icon {
            min-width: 20px;
            max-width: 20px;
            min-height: 20px;
            max-height: 20px;
        }
    }
}
</style>
