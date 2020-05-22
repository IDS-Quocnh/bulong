<template>
    <div>
        <div v-for="reply in replies" :key="reply.id">
            <div class="border-b">
                <div class="flex justify-between items-center">
                    <div class="flex">
                        <img :src="reply.user.profile_picture" class="w-6 h-6 rounded-full">
                        <a :href="'/user/' + reply.user.username">
                            <h3 class="font-bold ml-1">{{ reply.user.username }} </h3>
                        </a>
                    </div>
                    <div>
                        <i v-if="$gate.canEdit(reply)" @click.prevent="editReply(reply)" class="fa fa-pencil text-green-500 mr-2 pull-right cursor-pointer"></i>
                        <i v-if="$gate.canDelete(reply)" @click.prevent="deleteReply(reply)" class="fa fa-trash text-red-500 mr-2 pull-right cursor-pointer"></i>
                    </div>
                    <!-- <i v-if="$gate.canDelete(reply)" @click.prevent="deleteReply(reply)" class="fa fa-trash text-red-500 mr-2 pull-right cursor-pointer"></i> -->
                    <!-- <div class="relative" v-if="$gate.canDelete(reply)">
                        <i @click="showOption()" class="fa fa-ellipsis-h mr-2 cursor-pointer"></i>
                        <button v-if="isOpen" @click="isOpen = false" tabindex="-1" class="fixed inset-0 h-full w-full bg-black opacity-50 cursor-default"></button>
                        <div v-if="isOpen" class="absolute right-0 mt-2 py-2 w-32 bg-white rounded-lg shadow-xl z-10">
                            <a @click.prevent="editReply(reply)" href="#" class="block px-2 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Edit</a>
                            <a @click.prevent="deleteReply(reply)" href="#" class="block px-2 py-1 text-gray-800 hover:bg-indigo-500 hover:text-white">Delete</a>
                        </div>
                    </div> -->
                </div>
                <input v-if="reply.id == id && editMode" @keyup.enter="updateReply()" type="text" class="border w-full mt-1" v-model="text">
                <h4 v-else class="mb-4 text-gray-600 text-sm">{{ reply.content }}</h4>
            </div>
            <div class="flex justify-between items-center">
                <div class="text-xs text-gray-600">
                    {{ reply.created_at }}
                </div>
                <div class="flex">
                    <span class="mr-2 text-xs">{{ reply.like_count }}</span>
                    <div @click.prevent="likeReply(reply)" class="cursor-pointer">
                        <img v-if="reply.is_liked" src="/public/icons/felt.png" class="mr-4 w-6 h-6" />
                        <img v-else src="/public/icons/feel.png" class="mr-4 w-6 h-6" />
                    </div>
                    <a @click.prevent="showReplyForm(reply)" class="mr-3 text-gray-700 text-sm cursor-pointer">Reply</a>
                </div>
            </div>
            <div v-if="replyingToComment == reply">
                <form @submit.prevent="addReply(reply)">
                    <input type="text" class="w-full border my-1" v-model="text">
                    <div class="flex justify-end">
                        <button type="submit" class="px-6 mb-2 bg-blue-600 text-white rounded-full">Reply</button>
                    </div>
                </form>
            </div>
            <comment-replies :replies="reply.childrens" v-if="reply.childrens"></comment-replies>
        </div>
    </div>
</template>
<script>
import CommentReplies from './CommentReplies'
export default {
    name: "comment-replies",

    props: ['replies'],

    components: {
        CommentReplies
    },

    data() {
        return {
            id: '',
            text: '',
            replyingToComment: '',
            isOpen: false,
            editMode: false,
        }
    },

    methods: {
        showReplyForm(reply) {
            if (this.replyingToComment == false) {
                this.replyingToComment = reply
            } else {
                this.replyingToComment = ''
            }
        },

        addReply(reply) {
            axios.post('/comment-confession', {
                    confessionId: reply.confession_id,
                    text: this.text,
                    parentId: reply.id
                })
                .then(() => {
                    Fire.$emit('ConfessionCommented')
                })
        },

        editReply(reply) {
            if (this.editMode) {
                this.editMode = false
                this.id = ''
                this.text = ''
            } else {
                this.editMode = true
                this.id = reply.id
                this.text = reply.content
            }
        },

        updateReply() {
            axios.patch(`/comments/${this.id}/edit`, {
                    text: this.text,
                })
                .then(() => {
                    this.text = ''
                    Fire.$emit('ConfessionCommented')
                    this.editMode = false
                })
        },

        deleteReply(reply) {
            console.log('clicked')
            this.$modal.show('dialog', {
                title: 'Alert!',
                text: 'Are you sure you want to delete?',
                buttons: [{
                        title: 'Yes',
                        handler: () => {
                            axios.delete(`/comments/${reply.id}`)
                                .then(() => {
                                    this.$modal.hide('dialog')
                                    Vue.$toast.open('Comment deleted successfully')
                                    Fire.$emit('ConfessionDeleted')
                                })
                                .catch(() => {
                                    this.$modal.hide('dialog')
                                    Vue.$toast.error('Unauthorized!')
                                })
                        }
                    },
                    {
                        title: '', // Button title
                        default: true, // Will be triggered by default if 'Enter' pressed.
                        handler: () => {} // Button click handler
                    },
                    {
                        title: 'Close'
                    }
                ]
            })
        },

        likeReply(reply) {
            axios.post('/like-comment', {
                    id: reply.id
                })
                .then(() => {
                    console.log('done')
                    Fire.$emit('ConfessionCommented')
                })
        },

        showOption() {
            this.isOpen = !this.isOpen
            Fire.$emit('ShowOption')
        }
    }
}

</script>
