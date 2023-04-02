<script setup>
import {usePage} from "@inertiajs/vue3";
import qs from "qs";

defineProps({ user: Object })

const { auth, user } = usePage().props;

const doesUserFollowUser = async (follower, followed) => await axios.get(
    `/api/follows/${follower}?` +
    qs.stringify({follower, followed})
);

let following = false;

const fetchFollowing = async () => {
    following = (await doesUserFollowUser(auth.user.id, user.id)).data.follows
}

await fetchFollowing()

const followUser = () => axios.post('/api/follows', {
    action: 'follow',
    follower: auth.user.id,
    followed: user.id
})

const unfollowUser = () => axios.post('/api/follows', {
    action: 'unfollow',
    follower: auth.user.id,
    followed: user.id
})


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
