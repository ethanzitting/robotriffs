<script setup>
import {usePage} from "@inertiajs/vue3";
import qs from "qs";

defineProps({ user: Object })

const { auth, user } = usePage().props;

const doesUserFollowUser = async (follower, followed) => {
    return await axios.get(`/api/user-follows?` + qs.stringify({
        followed,
        follower
    }));
};

let following = false;

const fetchFollowing = async () => {
    const res = await doesUserFollowUser(auth.user.id, user.id)
    following = res.data.data.length > 0
}

await fetchFollowing()

const followUser = () => {
    return axios.post(`/api/user-follows`, {
        followed: user.id,
        follower: auth.user.id,
    });
}

const unfollowUser = () => {
    return axios.delete(`/api/user-follows/1?` + qs.stringify({
        followed: user.id,
        follower: auth.user.id
    }));
}


const toggleFollow = () => {
    following
        ? unfollowUser(user.id)
        : followUser(user.id)

    fetchFollowing()
}

</script>

<template>
    <button @click.prevent="toggleFollow">
        {{ following ? 'Following' : 'Follow' }}
    </button>
</template>

<style lang="scss" scoped>

</style>
