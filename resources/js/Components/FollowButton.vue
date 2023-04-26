<script setup>
import {usePage} from "@inertiajs/vue3";
import qs from "qs";
import {ref} from "vue";

const props = defineProps({ user: Object })

const auth = usePage().props.auth;

const doesUserFollowUser = (potentialFollower, followed) => {
    return followed.followers.find(({ id }) => id === potentialFollower.id)
};

const localFollowing = ref(doesUserFollowUser(auth.user, props.user));

const followUser = async () => {
    localFollowing.value = true
    return await axios.post(`/api/user-follows`, {
        followed: props.user.id,
        follower: auth.user.id,
    });
}

const unfollowUser = async () => {
    localFollowing.value = false
    return await axios.delete(`/api/user-follows/1?` + qs.stringify({
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
    <button :class="`follow-button ${localFollowing ? 'active' : ''}`" @click.prevent="toggleFollow">
        {{ localFollowing ? 'Following' : 'Follow' }}
    </button>
</template>

<style lang="scss" scoped>
.follow-button {
    height: 32px;
    border: 1px solid #BBB;
    border-radius: 16px;
    padding: 4px 12px;
    background-color: black;
    color: white;

    &.active {
        background-color: white;
        color: black;
    }
}
</style>
