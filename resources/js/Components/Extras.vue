<script setup>
import SearchBar from "./SearchBar.vue";
import SuggestedUsers from "./SuggestedUsers.vue";
import TrendingTopics from "./TrendingTopics.vue";
import PageCrumbs from "./PageCrumbs.vue";
</script>

<template>
    <div class="extras">
        <SearchBar />
        <SuggestedUsers />
        <TrendingTopics />
        <PageCrumbs />
    </div>
</template>

<style lang="scss" scoped>
.extras {
    display: flex;
    flex-direction: column;
    gap: 18px;
}
</style>
