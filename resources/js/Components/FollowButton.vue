<script setup>
import {usePage} from "@inertiajs/vue3";
import qs from "qs";
import {ref} from "vue";

const props = defineProps({ user: Object })

const auth = usePage().props.auth;

const doesUserFollowUser = async (follower, followed) => {
    const { data: { data: followers} } = await axios.get(`/api/user-follows?` + qs.stringify({
        followed,
        follower
    }));

    return followers.find(follower => follower.id === auth.user.id)
};

const localFollowing = ref(false);

localFollowing.value = await doesUserFollowUser(auth.user.id, props.user.id);

const followUser = () => {
    localFollowing.value = true
    return axios.post(`/api/user-follows`, {
        followed: props.user.id,
        follower: auth.user.id,
    });
}

const unfollowUser = () => {
    localFollowing.value = false
    return axios.delete(`/api/user-follows/1?` + qs.stringify({
        followed: props.user.id,
        follower: auth.user.id
    }));
}


const toggleFollow = () => {
    localFollowing.value
        ? unfollowUser(props.user.id)
        : followUser(props.user.id)
}

</script>

<template>
    <button class="follow-button" @click.prevent="toggleFollow">
        {{ localFollowing ? 'Following' : 'Follow' }}
    </button>
</template>

<style lang="scss" scoped>
.follow-button {
    height: 32px;
    border: 1px solid #BBB;
    border-radius: 16px;
    padding: 4px 12px;
}
</style>
