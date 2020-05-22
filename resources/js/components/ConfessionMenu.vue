<template>
    <div class="mt-8">
        <nav class="text-gray-600">
            <a href="#" @click.prevent="getTrendingConfessions()" class="mr-4" :class="{ 'menu-active': activeMenu == 'trending' }">Trending</a>
            <a href="#" @click.prevent="getLatestConfessions()" class="mr-4" :class="{ 'menu-active': activeMenu == 'latest' }">Latest</a>
            <a href="#" @click.prevent="getFollowingPeopleConfessions()" :class="{ 'menu-active': activeMenu == 'following' }">People you Follow</a>
        </nav>
    </div>
</template>
<script>
export default {
    data() {
        return {
            activeMenu: 'trending'
        }
    },

    methods: {
        getTrendingConfessions() {
            this.activeMenu = 'trending';
            this.$store.dispatch('setActiveMenu', 'trending');
            this.$store.dispatch('getTrendingConfessions');
        },

        getLatestConfessions() {
            this.activeMenu = 'latest';
            this.$store.dispatch('setActiveMenu', 'latest');
            this.$store.dispatch('getLatestConfessions');
        },

        getFollowingPeopleConfessions() {
            this.activeMenu = 'following';
            this.$store.dispatch('setActiveMenu', 'following');
            this.$store.dispatch('getFollowingPeopleConfessions');
        }
    }
}

</script>
