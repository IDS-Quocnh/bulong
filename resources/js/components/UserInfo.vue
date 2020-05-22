<template>
    <div class="flex flex-col justify-center items-center">
        <img :src="user.profile_picture" class="w-10 h-10 rounded-full">
        <h1 class="mt-1 text-gray-700 text-sm">@{{ user.username }}</h1>
        <div v-if="user.id != $gate.userId()">
            <button @click.prevent="follow(user)" class="my-1 px-6 text-sm text-white bg-yellow-600 rounded" v-if="!isFollowing">Follow</button>
            <button @click.prevent="follow(user)" class="my-1 px-6 text-sm text-white bg-gray-600 rounded" v-if="isFollowing">Unfollow</button>
        </div>
        <h3 class="text-sm font-bold">{{ totalFollowers }} Followers</h3>
    </div>
</template>
<script>
export default {
    props: ['user', 'totalFollowers'],

    data() {
        return {
            isFollowing: this.user.is_following
        }
    },

    methods: {
        follow(user) {
            if (this.isFollowing) {
                this.isFollowing = false;
            } else {
                this.isFollowing = true;
            }
            axios.post('/follow-user', {
                    id: user.id
                })
                .then(() => {
                    Fire.$emit('updated')
                })
        },
    }
}

</script>
