<template>
    <div class="mt-3 py-3 pr-6 pl-3
 border rounded">
        <a href="/my-confessions" class="mb-3 flex items-center">
            <img src="/icons/message-in-a-bottle.png" class="mr-3 w-8 h-8" />
            <h2 class="text-gray-600">My Confessions</h2>
        </a>
        <a href="/felt-confessions" class="mb-3 flex items-center">
            <img src="/icons/love-letter.png" class="mr-3 w-8 h-8" />
            <h2 class="text-gray-600">My Felt Confessions</h2>
        </a>
        <a href="/followings" class="mb-3 flex items-center">
            <img src="/icons/follower.png" class="mr-3 w-8 h-8" />
            <h2 class="text-gray-600">Following [{{ followingsCount }}]</h2>
        </a>
        <a href="/followers" class="mb-3 flex items-center">
            <img src="/icons/user.png" class="mr-3 w-8 h-8" />
            <h2 class="text-gray-600">Followers [{{ followersCount }}]</h2>
        </a>
    </div>
</template>
<script>
export default {
    props: ['followersCount', 'followingsCount'],

    // computed: {
    // followingCount() {
    // return this.$store.state.followings.length;
    // },
    // followersCount() {
    // return this.$store.state.followers.length;
    // }
    // },


    created() {
        // this.$store.dispatch('getFollowings');
        // this.$store.dispatch('getFollowers');
    }
}

</script>
