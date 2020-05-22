<template>
    <div class="lg:flex justify-center items-center bg-gray-100 mt-4">
        <main class="lg:w-auto">
            <button @click.prevent="hideModal()" class="bg-gray-600 px-4 rounded text-white">&lt; Back</button>
            <div class="lg:flex">
                <div class="mt-6 pb-4 lg:w-8/12  bg-gray-200 px-4 rounded-lg ">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div class="ml-4 -mb-3 z-10">
                                <a :href="'/user/' + confession.username">
                                    <img src="/public/images/profile.jpg" class="h-12 w-12 mr-2 rounded-full border-2 border-white" />
                                </a>
                            </div>
                            <div class="flex items-center">
                                <a :href="'/user/' + confession.username" class="text-teal-600 font-bold mr-1">{{ confession.username }}</a>
                                <div v-if="$gate.userId() != confession.user.id">
                                    <button @click.prevent="followUser(confession)" class="px-6 text-sm text-white bg-yellow-600 rounded" v-if="!isFollowing">Follow</button>
                                    <button @click.prevent="followUser(confession)" class="px-6 text-sm text-white bg-gray-600 rounded" v-if="isFollowing">Unfollow</button>
                                </div>
                            </div>
                        </div>
                        <div @click.prevent="showOptions(confession.id, confession.user_id)" class="cursor-pointer">
                            <i class="fa fa-ellipsis-h text-gray-600 "></i>
                        </div>
                    </div>
                    <div class="p-5 h-135 py-10 flex justify-center items-center bg-blue-900 bg-cover bg-center" :style="{'background-image': `url(${confession.background.image})`}" style="width: 540px;">
                        <!-- <div class="overflow-y-auto"> -->
                        <!-- <p class="mb-8 text-lg"> -->
                        <div contenteditable="true" class="h-135 pt-4 flex justify-center items-center overflow-y-auto text-xl font-extrabold" style="font-family: HelveticaNeue;">{{ confession.text }}</div>
                        <!-- </p> -->
                        <!-- </div> -->
                    </div>
                    <div class="mt-4  text-sm ml-4 lg:flex lg:justify-between">
                        <span class="mr-2 text-gray-600">Posted {{ confession.created_at }}</span>
                        <a :href="`/confession/${confession.category.slug}`" class="mr-4 text-teal-600 font-bold">{{ confession.category.name }}</a>
                    </div>
                </div>
                <comment-section :confession="confession"></comment-section>
            </div>
        </main>
    </div>
</template>
<script>
import ConfessionOptionModal from './ConfessionOptionModal'
export default {
    props: ['confession'],

    data() {
        return {
            isFollowing: ''
        }
    },

    methods: {
        hideModal() {
            history.pushState({ foo: "bar" }, "page 2", `/`);
            this.$modal.hide(this.$parent.name)
        },

        showOptions(id, userId) {
            this.$modal.show(ConfessionOptionModal, {
                id: id,
                userId: userId
            }, {
                width: 250,
                height: 'auto'
            })
        },

        followUser(confession) {
            if (window.user == undefined) {
                this.showLoginAlertModel()
                return
            }

            this.isFollowing = !this.isFollowing
            this.$store.dispatch('followUser', confession)
        },
    },

    created() {
        this.isFollowing = this.confession.user.is_following
    }
}

</script>
