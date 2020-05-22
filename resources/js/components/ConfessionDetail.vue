<template>
    <div class="lg:flex justify-center bg-gray-100 h-screen" id="app">
        <main class="lg:w-auto">
            <div class="lg:flex">
                <div class="mt-6 py-4 lg:w-8/12  bg-gray-200 px-4 rounded-lg ">
                    <div class="flex justify-between">
                        <div class="flex items-center">
                            <div class="ml-4 -mb-3 z-10">
                                <a :href="'/user/' + confession.username">
                                    <img src="/public/images/profile.jpg" class="h-12 w-12 mr-2 rounded-full border-2 border-white" />
                                </a>
                            </div>
                            <div class="flex items-center">
                                <a :href="'/user/' + confession.username" class="text-teal-600 font-bold mr-1">@{{ confession.username }}</a>
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
                        <div id="confession-content" :contenteditable="true" class="h-135 pt-4 flex justify-center items-center overflow-y-auto text-xl font-extrabold" @blur="onEdit" style="font-family: HelveticaNeue;">{{ confession.text }}</div>
                        <!-- <div class="overflow-y-auto">
                            <p class="mb-8 text-lg">
                                {{ confession.text }}
                            </p>
                        </div> -->
                    </div>
                    <div class="mt-4  text-sm ml-4 lg:flex lg:justify-between">
                        <span class="mr-2 text-gray-600">Posted {{ confession.created_at }}</span>
                        <button v-if="editMode" @click.prevent="updateConfession()" class="text-blue-500">Update</button>
                        <a href="" class="mr-4 text-teal-600 font-bold">{{ confession.category.name }}</a>
                    </div>
                </div>
                <comment-section :confession="confession"></comment-section>
            </div>
        </main>
    </div>
</template>
<script>
import CommentSection from './CommentSection'
import ConfessionOptionModal from './ConfessionOptionModal'
export default {
    props: ['confession'],

    data() {
        return {
            editMode: false,
            id: '',
            text: '',
            isFollowing: '',
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
                userId: userId,
                page: 'confessionDetail',
            }, {
                width: 250,
                height: 'auto'
            })
        },

        onEdit(evt) {
            const src = evt.target.innerText
            this.text = src
        },

        updateConfession() {
            axios.patch(`/confession/${this.id}/update`, {
                    text: this.text
                })
                .then(() => {
                    Vue.$toast.open('Your confession has been updated. Click here to view it now.');
                    this.editMode = false;
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
        this.text = this.confession.text
        this.id = this.confession.id
        this.isFollowing = this.confession.user.is_following

        Fire.$on('EditConfession', () => {
            const confessionContent = document.getElementById('confession-content')
            confessionContent.focus()
            this.editMode = true
        })
    }
}

</script>
